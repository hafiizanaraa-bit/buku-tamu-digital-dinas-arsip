<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JanjiTemu;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan laporan kunjungan.
     */
    public function index(Request $request)
    {
        // Validasi filter laporan
        $validated = $request->validate([
            'jenis_laporan' => 'nullable|in:bulanan,tahunan',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2000|max:2100',
        ]);

        // Menentukan filter default
        $jenisLaporan = $validated['jenis_laporan'] ?? 'bulanan';
        $bulan = $validated['bulan'] ?? now()->month;
        $tahun = $validated['tahun'] ?? now()->year;

        // Query dasar data kunjungan
        $query = JanjiTemu::with('pegawai');

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
        }

        // Filter laporan tahunan
        if ($jenisLaporan === 'tahunan') {
            $query->whereYear('tanggal_kunjungan', $tahun);
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

        // Mengirim data ke halaman laporan
        return view('admin.laporan.index', compact(
            'laporans',
            'totalKunjungan',
            'diterima',
            'ditolak',
            'menunggu',
            'jenisLaporan',
            'bulan',
            'tahun'
        ));
    }
}