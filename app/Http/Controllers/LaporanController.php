<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\JanjiTemu;
use App\Models\KehadiranPegawai;
use App\Models\Pegawai;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan laporan kunjungan (mingguan, bulanan, tahunan).
     */
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        // Validasi filter laporan
        $validated = $request->validate([
            'jenis_laporan' => 'nullable|in:mingguan,bulanan,tahunan',
            'tanggal' => 'nullable|date_format:Y-m-d',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2000|max:2100',
        ]);

        // Menentukan filter default
        // (ubah 'mingguan' menjadi 'bulanan' jika ingin tampilan awal bulanan)
        $jenisLaporan = $validated['jenis_laporan'] ?? 'mingguan';
        $bulan = $validated['bulan'] ?? now()->month;
        $tahun = $validated['tahun'] ?? now()->year;

        // Tanggal acuan untuk laporan mingguan (hari apa pun di dalam minggu tersebut)
        $tanggalAcuan = isset($validated['tanggal'])
            ? Carbon::createFromFormat('Y-m-d', $validated['tanggal'])->startOfDay()
            : Carbon::today();

        // Minggu berjalan: Senin - Minggu
        $mingguAwal = $tanggalAcuan->copy()->startOfWeek(Carbon::MONDAY);
        $mingguAkhir = $mingguAwal->copy()->addDays(6);

        // Query dasar data kunjungan
        $query = JanjiTemu::with('pegawai');

        // Filter laporan mingguan
        if ($jenisLaporan === 'mingguan') {
            $query->whereBetween('tanggal_kunjungan', [
                $mingguAwal->toDateString(),
                $mingguAkhir->toDateString()
            ]);

            $labelPeriode = $mingguAwal->translatedFormat('d F Y')
                . ' - '
                . $mingguAkhir->translatedFormat('d F Y');
        }

        // Filter laporan bulanan
        if ($jenisLaporan === 'bulanan') {
            $tanggalAwal = Carbon::createFromDate($tahun, $bulan, 1)
                ->startOfMonth();

            $tanggalAkhir = Carbon::createFromDate($tahun, $bulan, 1)
                ->endOfMonth();

            $query->whereBetween('tanggal_kunjungan', [
                $tanggalAwal->toDateString(),
                $tanggalAkhir->toDateString()
            ]);

            $labelPeriode = $tanggalAwal->translatedFormat('F') . ' ' . $tahun;
        }

        // Filter laporan tahunan
        if ($jenisLaporan === 'tahunan') {
            $query->whereYear('tanggal_kunjungan', $tahun);

            $labelPeriode = 'Tahun ' . $tahun;
        }

        // Mengambil seluruh data sesuai filter
        // Tidak menggunakan paginate agar ekspor tidak terpotong
        $laporans = $query
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // Menghitung jumlah seluruh kunjungan
        $totalKunjungan = $laporans->count();

        // Menghitung berdasarkan status
        $diterima = $laporans
            ->where('status', 'Diterima')
            ->count();

        $ditolak = $laporans
            ->where('status', 'Ditolak')
            ->count();

        $menunggu = $laporans
            ->where('status', 'Menunggu Konfirmasi')
            ->count();

        // Rekap per hari (hanya untuk laporan mingguan)
        $rekapHarian = collect();

        // Rekap tambahan khusus laporan mingguan
        $rekapTujuan = collect();
        $rekapKehadiran = collect();

        if ($jenisLaporan === 'mingguan') {
            for ($i = 0; $i < 7; $i++) {
                $hari = $mingguAwal->copy()->addDays($i);

                $dataHari = $laporans->filter(function ($item) use ($hari) {
                    return $item->tanggal_kunjungan
                        && $item->tanggal_kunjungan->isSameDay($hari);
                });

                $rekapHarian->push([
                    'hari'     => $hari,
                    'total'    => $dataHari->count(),
                    'diterima' => $dataHari->where('status', 'Diterima')->count(),
                    'ditolak'  => $dataHari->where('status', 'Ditolak')->count(),
                    'menunggu' => $dataHari->where('status', 'Menunggu Konfirmasi')->count(),
                ]);
            }

            // Sabtu dan Minggu hanya ditampilkan jika ada kunjungan
            $rekapHarian = $rekapHarian
                ->filter(fn ($baris) => $baris['hari']->isWeekday() || $baris['total'] > 0)
                ->values();

            // Rekap per tujuan kunjungan
            // (tujuan disimpan "Konsultasi: rincian", yang dihitung nama tujuannya saja)
            $rekapTujuan = $laporans
                ->groupBy(fn ($item) => trim(Str::before((string) $item->tujuan, ':')) ?: '-')
                ->map->count()
                ->sortDesc();

            // Rekap kehadiran pegawai pada minggu yang sama
            $kehadiranMinggu = KehadiranPegawai::whereBetween('tanggal', [
                    $mingguAwal->toDateString(),
                    $mingguAkhir->toDateString()
                ])
                ->get()
                ->groupBy('pegawai_id');

            $rekapKehadiran = Pegawai::orderBy('nama_lengkap')
                ->get()
                ->map(function ($pegawai) use ($kehadiranMinggu) {
                    $data = $kehadiranMinggu->get($pegawai->id, collect());

                    return [
                        'nama'        => $pegawai->nama_lengkap,
                        'jabatan'     => $pegawai->jabatan,
                        'hadir'       => $data->where('status', 'hadir')->count(),
                        'tidak_hadir' => $data->where('status', 'tidak_hadir')->count(),
                        'lainnya'     => $data->whereIn('status', ['dinas_luar', 'izin', 'cuti'])->count(),
                    ];
                });
        }

        // Navigasi minggu sebelumnya / berikutnya
        $mingguSebelumnya = $mingguAwal->copy()->subWeek()->toDateString();
        $mingguBerikutnya = $mingguAwal->copy()->addWeek()->toDateString();
        $tanggalFilter = $tanggalAcuan->toDateString();
        $mingguAwalTanggal = $mingguAwal->toDateString();

        // Mengirim data ke halaman laporan
        return view('admin.laporan.index', compact(
            'laporans',
            'totalKunjungan',
            'diterima',
            'ditolak',
            'menunggu',
            'jenisLaporan',
            'bulan',
            'tahun',
            'labelPeriode',
            'rekapHarian',
            'rekapTujuan',
            'rekapKehadiran',
            'mingguSebelumnya',
            'mingguBerikutnya',
            'tanggalFilter',
            'mingguAwalTanggal'
        ));
    }
}