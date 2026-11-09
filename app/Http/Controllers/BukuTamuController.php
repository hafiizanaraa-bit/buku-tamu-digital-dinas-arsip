<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pegawai;
use App\Models\JanjiTemu;

class BukuTamuController extends Controller
{
    // HALAMAN 1: BERANDA
    public function index()
    {
        return view('buku-tamu.index');
    }

    // HALAMAN 2: INFORMASI LOKASI
    public function lokasi()
    {
        return view('buku-tamu.lokasi');
    }

    // HALAMAN 3: SURVEI KEPUASAN
    public function survei()
    {
        return view('buku-tamu.survei');
    }

    // HALAMAN 4: FORMULIR IDENTITAS TAMU
    public function formulir()
    {
        return view('buku-tamu.formulir');
    }

    // PROSES SIMPAN IDENTITAS TAMU
    public function simpanIdentitas(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'instansi' => 'nullable|string|max:150',
        ]);

        session([
            'identitas_tamu' => $validated
        ]);

        return redirect()->route('buku-tamu.tujuan');
    }

    // HALAMAN 5: TUJUAN KUNJUNGAN DAN PILIH PEGAWAI
    public function tujuan()
    {
        if (!session()->has('identitas_tamu')) {
            return redirect()->route('buku-tamu.formulir')
                ->with('error', 'Silakan isi identitas terlebih dahulu.');
        }

        $pegawais = Pegawai::orderBy('nama_lengkap', 'asc')->get();

        return view('buku-tamu.tujuan', compact('pegawais'));
    }

    // PROSES CEK KETERSEDIAAN PEGAWAI
    public function cekKetersediaan(Request $request)
    {
        $validated = $request->validate([
            'tujuan' => 'required|string|max:150',
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        $pegawai = Pegawai::findOrFail($validated['pegawai_id']);

        session([
            'tujuan_kunjungan' => $validated['tujuan'],
            'pegawai_dipilih' => $pegawai->id,
        ]);

        return redirect()->route('buku-tamu.hasil-pencarian');
    }

    // HALAMAN 6: HASIL PENCARIAN PEGAWAI
    public function hasilPencarian()
    {
        if (!session()->has('identitas_tamu')) {
            return redirect()->route('buku-tamu.formulir');
        }

        if (!session()->has('pegawai_dipilih')) {
            return redirect()->route('buku-tamu.tujuan');
        }

        $pegawai = Pegawai::find(session('pegawai_dipilih'));

        if (!$pegawai) {
            return redirect()->route('buku-tamu.tujuan')
                ->with('error', 'Data pegawai tidak ditemukan.');
        }

        $tujuan = session('tujuan_kunjungan', '-');

        return view('buku-tamu.hasil-pencarian', compact(
            'pegawai',
            'tujuan'
        ));
    }

    // HALAMAN 7: AJUKAN JANJI TEMU
    public function ajukanJanji()
    {
        if (!session()->has('identitas_tamu')) {
            return redirect()->route('buku-tamu.formulir');
        }

        if (!session()->has('pegawai_dipilih')) {
            return redirect()->route('buku-tamu.tujuan');
        }

        $pegawai = Pegawai::find(session('pegawai_dipilih'));

        if (!$pegawai) {
            return redirect()->route('buku-tamu.tujuan')
                ->with('error', 'Data pegawai tidak ditemukan.');
        }

        $tujuan = session('tujuan_kunjungan', '-');

        return view('buku-tamu.ajukan-janji', compact(
            'pegawai',
            'tujuan'
        ));
    }

    // PROSES SIMPAN PERMOHONAN JANJI TEMU KE DATABASE
    public function simpanJanji(Request $request)
    {
        if (!session()->has('identitas_tamu')) {
            return redirect()->route('buku-tamu.formulir');
        }

        if (!session()->has('pegawai_dipilih')) {
            return redirect()->route('buku-tamu.tujuan');
        }

        // Validasi data pengajuan janji temu
        $validated = $request->validate([
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => [
                'required',
                'in:08:00 - 09:00,09:00 - 10:00,10:00 - 11:00,11:00 - 12:00',
            ],
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Mengambil identitas pengunjung dari session
        $identitas = session('identitas_tamu');

        // Mengambil data pegawai yang dipilih
        $pegawai = Pegawai::find(session('pegawai_dipilih'));

        if (!$pegawai) {
            return redirect()->route('buku-tamu.tujuan')
                ->with('error', 'Data pegawai tidak ditemukan.');
        }

        // Membuat kode kunjungan unik
        do {
            $kodeKunjungan = 'KJN-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        } while (
            JanjiTemu::where('kode_kunjungan', $kodeKunjungan)->exists()
        );

        // Menyimpan permohonan ke database
        $janjiTemu = JanjiTemu::create([
            'kode_kunjungan' => $kodeKunjungan,

            'nama_tamu' => $identitas['nama'],
            'telepon' => $identitas['telepon'],
            'alamat' => $identitas['alamat'],
            'instansi' => $identitas['instansi'] ?? null,

            'pegawai_id' => $pegawai->id,
            'tujuan' => session('tujuan_kunjungan', '-'),

            'tanggal_kunjungan' => $validated['tanggal'],
            'waktu_kunjungan' => $validated['waktu'],
            'catatan' => $validated['catatan'] ?? null,

            'status' => 'Menunggu Konfirmasi',
        ]);

        // Simpan ID permohonan terakhir di session
        session([
            'janji_temu_id' => $janjiTemu->id
        ]);

        // Arahkan pengunjung ke halaman 8
        return redirect()->route('buku-tamu.konfirmasi', [
            'kode' => $janjiTemu->kode_kunjungan
        ]);
    }

    // HALAMAN 8: KONFIRMASI / STATUS KUNJUNGAN
    public function konfirmasi($kode)
    {
        // Mengambil data janji temu beserta data pegawai
        $janjiTemu = JanjiTemu::with('pegawai')
            ->where('kode_kunjungan', $kode)
            ->firstOrFail();

        return view('buku-tamu.konfirmasi', compact('janjiTemu'));
    }
}