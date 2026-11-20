<?php

namespace App\Http\Controllers;

use App\Models\KehadiranPegawai;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KehadiranAdminController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');

        try {
            $tanggal = $request->filled('tanggal')
                ? Carbon::parse($request->tanggal)->startOfDay()
                : Carbon::today();
        } catch (\Throwable $e) {
            $tanggal = Carbon::today();
        }

        $pegawais = Pegawai::orderBy('nama_lengkap')->get();

        $kehadiran = KehadiranPegawai::whereDate('tanggal', $tanggal->toDateString())
            ->get()
            ->keyBy('pegawai_id');

        return view('admin.kehadiran.index', compact('pegawais', 'kehadiran', 'tanggal'));
    }

    /**
     * Simpan kehadiran satu hari (hasil input manual dan/atau deteksi foto).
     * - Baris dengan status kosong ("Belum diisi") dilewati.
     * - Foto/PDF absen (opsional) disimpan sebagai bukti untuk pegawai
     *   yang berstatus "Ada di ruangan".
     */
    public function simpan(Request $request)
    {
        $request->validate([
            'tanggal'           => 'required|date',
            'bukti_harian'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:8192',
            'data'              => 'required|array',
            'data.*.status'     => ['nullable', Rule::in(array_keys(KehadiranPegawai::STATUS))],
            'data.*.jam_masuk'  => 'nullable|date_format:H:i',
            'data.*.jam_pulang' => 'nullable|date_format:H:i',
            'data.*.keterangan' => 'nullable|string|max:150',
        ], [
            'bukti_harian.max'   => 'Ukuran foto/dokumen maksimal 8 MB.',
            'bukti_harian.mimes' => 'Bukti absen harus berformat JPG, PNG, atau PDF.',
        ]);

        $tanggal = Carbon::parse($request->tanggal)->toDateString();

        $bukti = $request->hasFile('bukti_harian')
            ? $request->file('bukti_harian')->store('absensi', 'public')
            : null;

        $jumlah = 0;

        foreach ($request->data as $pegawaiId => $row) {

            if (empty($row['status'])) {
                continue;
            }

            if (!Pegawai::whereKey($pegawaiId)->exists()) {
                continue;
            }

            $hadir = $row['status'] === 'hadir';

            $nilai = [
                'status'     => $row['status'],
                'jam_masuk'  => $hadir ? ($row['jam_masuk'] ?? null) : null,
                'jam_pulang' => $hadir ? ($row['jam_pulang'] ?? null) : null,
                'keterangan' => $row['keterangan'] ?? null,
            ];

            if ($bukti && $hadir) {
                $nilai['bukti'] = $bukti;
            }

            KehadiranPegawai::updateOrCreate(
                ['pegawai_id' => $pegawaiId, 'tanggal' => $tanggal],
                $nilai
            );

            $jumlah++;
        }

        return redirect()
            ->route('admin.kehadiran.index', ['tanggal' => $tanggal])
            ->with('sukses', "Kehadiran {$jumlah} pegawai berhasil disimpan.");
    }

    /**
     * Impor absen dari file CSV (hasil ekspor mesin absen / Excel).
     * Header wajib: nama, tanggal, jam_masuk. Opsional: jam_pulang.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file_absen' => 'required|file|mimes:csv,txt|max:2048',
            'bukti'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:8192',
        ], [
            'file_absen.mimes' => 'File absen harus berformat CSV. Di Excel: Save As > CSV.',
        ]);

        $bukti = $request->file('bukti')
            ? $request->file('bukti')->store('absensi', 'public')
            : null;

        $handle = fopen($request->file('file_absen')->getRealPath(), 'r');

        if ($handle === false) {
            return back()->with('error', 'File absen tidak dapat dibaca.');
        }

        $baris1 = (string) fgets($handle);
        rewind($handle);

        $pemisah = substr_count($baris1, ';') > substr_count($baris1, ',') ? ';' : ',';

        $header = fgetcsv($handle, 0, $pemisah) ?: [];
        $header = array_map(
            fn ($h) => strtolower(trim(preg_replace('/^\xEF\xBB\xBF/', '', (string) $h))),
            $header
        );

        foreach (['nama', 'tanggal', 'jam_masuk'] as $wajib) {
            if (!in_array($wajib, $header, true)) {
                fclose($handle);

                return back()->with(
                    'error',
                    "Kolom '{$wajib}' tidak ditemukan. Header wajib: nama, tanggal, jam_masuk, jam_pulang."
                );
            }
        }

        $petaPegawai = Pegawai::get()->mapWithKeys(
            fn ($p) => [mb_strtolower(trim($p->nama_lengkap)) => $p->id]
        );

        $berhasil   = 0;
        $tidakCocok = [];

        while (($kolom = fgetcsv($handle, 0, $pemisah)) !== false) {

            if (count($kolom) < count($header)) {
                continue;
            }

            $row = array_combine($header, array_slice($kolom, 0, count($header)));

            $namaAsli = trim((string) ($row['nama'] ?? ''));
            $nama     = mb_strtolower($namaAsli);
            $tanggal  = $this->parseTanggal((string) ($row['tanggal'] ?? ''));
            $masuk    = $this->parseJam($row['jam_masuk'] ?? '');
            $pulang   = $this->parseJam($row['jam_pulang'] ?? '');

            if ($nama === '' || !$tanggal) {
                continue;
            }

            if (!isset($petaPegawai[$nama])) {
                $tidakCocok[$namaAsli] = true;
                continue;
            }

            $data = [
                'status'     => $masuk ? 'hadir' : 'tidak_hadir',
                'jam_masuk'  => $masuk,
                'jam_pulang' => $pulang,
            ];

            if ($bukti) {
                $data['bukti'] = $bukti;
            }

            KehadiranPegawai::updateOrCreate(
                ['pegawai_id' => $petaPegawai[$nama], 'tanggal' => $tanggal],
                $data
            );

            $berhasil++;
        }

        fclose($handle);

        $pesan = "{$berhasil} data absen berhasil diimpor.";

        if ($tidakCocok) {
            $pesan .= ' Nama tidak cocok dengan data pegawai: '
                . implode(', ', array_keys($tidakCocok)) . '.';
        }

        return back()->with('sukses', $pesan);
    }

    private function parseTanggal(string $nilai): ?string
    {
        $nilai = trim($nilai);

        foreach (['Y-m-d', 'd/m/Y', 'd-m-Y', 'd.m.Y'] as $format) {
            try {
                $c = Carbon::createFromFormat($format, $nilai);

                if ($c && $c->format($format) === $nilai) {
                    return $c->toDateString();
                }
            } catch (\Throwable $e) {
                // coba format berikutnya
            }
        }

        return null;
    }

    private function parseJam($nilai): ?string
    {
        if (!preg_match('/^(\d{1,2})[:.](\d{2})/', trim((string) $nilai), $m)) {
            return null;
        }

        $jam   = (int) $m[1];
        $menit = (int) $m[2];

        if ($jam > 23 || $menit > 59) {
            return null;
        }

        return sprintf('%02d:%02d', $jam, $menit);
    }
}
