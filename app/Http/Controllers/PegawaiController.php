<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // Menampilkan seluruh data pegawai
    public function index()
    {
        $pegawais = Pegawai::latest()->get();

        return view('admin.pegawai.index', compact('pegawais'));
    }

    // Menampilkan formulir tambah pegawai
    public function create()
    {
        return view('admin.pegawai.create');
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'nip' => 'nullable|string|max:30|unique:pegawais,nip',
            'jabatan' => 'nullable|string|max:100',
            'bidang' => 'required|string|max:100',
            'status_kepegawaian' => 'nullable|in:PNS,PPPK,Non-ASN,Lainnya',
        ]);

        Pegawai::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'nip' => !empty($validated['nip']) ? $validated['nip'] : null,
            'jabatan' => $validated['jabatan'] ?? null,
            'bidang' => $validated['bidang'],
            'status_kepegawaian' => $validated['status_kepegawaian'] ?? null,
            'status_ketersediaan' => 'belum_diatur',
        ]);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    // Menampilkan formulir edit pegawai
    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawai.edit', compact('pegawai'));
    }

    // Memperbarui data pegawai
    public function update(Request $request, Pegawai $pegawai)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'nip' => 'nullable|string|max:30|unique:pegawais,nip,' . $pegawai->id,
            'jabatan' => 'nullable|string|max:100',
            'bidang' => 'required|string|max:100',
            'status_kepegawaian' => 'nullable|in:PNS,PPPK,Non-ASN,Lainnya',
            'status_ketersediaan' => 'required|in:belum_diatur,tersedia,sedang_bertugas,di_luar_kantor,tidak_tersedia',
        ]);

        $pegawai->update([
            'nama_lengkap' => $validated['nama_lengkap'],
            'nip' => !empty($validated['nip']) ? $validated['nip'] : null,
            'jabatan' => $validated['jabatan'] ?? null,
            'bidang' => $validated['bidang'],
            'status_kepegawaian' => $validated['status_kepegawaian'] ?? null,
            'status_ketersediaan' => $validated['status_ketersediaan'],
        ]);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    // Mengubah status ketersediaan pegawai menjadi tidak tersedia
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->update([
            'status_ketersediaan' => 'tidak_tersedia',
        ]);

        return redirect()
            ->route('admin.pegawai.index')
            ->with('success', 'Status ketersediaan pegawai berhasil diperbarui.');
    }
}