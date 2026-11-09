<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JanjiTemu;

class PermohonanKunjunganController extends Controller
{
    // ==================================================
    // MENAMPILKAN DAFTAR PERMOHONAN KUNJUNGAN
    // ==================================================

    public function index()
    {
        // Mengambil seluruh data permohonan kunjungan
        // sekaligus mengambil data pegawai yang terkait
        $permohonans = JanjiTemu::with('pegawai')
            ->latest()
            ->get();

        // Menghitung jumlah seluruh permohonan
        $totalPermohonan = JanjiTemu::count();

        // Menghitung jumlah permohonan yang menunggu konfirmasi
        $menunggu = JanjiTemu::where(
            'status',
            'Menunggu Konfirmasi'
        )->count();

        // Menghitung jumlah permohonan yang diterima
        $diterima = JanjiTemu::where(
            'status',
            'Diterima'
        )->count();

        // Menghitung jumlah permohonan yang ditolak
        $ditolak = JanjiTemu::where(
            'status',
            'Ditolak'
        )->count();

        // Mengirim data ke halaman daftar permohonan
        return view('admin.permohonan.index', compact(
            'permohonans',
            'totalPermohonan',
            'menunggu',
            'diterima',
            'ditolak'
        ));
    }


    // ==================================================
    // MENAMPILKAN DETAIL PERMOHONAN KUNJUNGAN
    // ==================================================

    public function show($id)
    {
        // Mencari data permohonan berdasarkan ID
        // sekaligus mengambil data pegawai yang terkait
        $permohonan = JanjiTemu::with('pegawai')
            ->findOrFail($id);

        // Mengirim data ke halaman detail permohonan
        return view('admin.permohonan.show', compact(
            'permohonan'
        ));
    }


    // ==================================================
    // MENGUBAH STATUS PERMOHONAN KUNJUNGAN
    // ==================================================

    public function updateStatus(Request $request, $id)
    {
        // Memvalidasi status yang dikirim dari halaman admin
        $validated = $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ], [
            'status.required' => 'Status permohonan harus dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ]);

        // Mencari data permohonan berdasarkan ID
        // Jika data tidak ditemukan, Laravel akan menampilkan error 404
        $permohonan = JanjiTemu::findOrFail($id);

        // Memperbarui status permohonan di database
        $permohonan->update([
            'status' => $validated['status'],
        ]);

        // Kembali ke halaman permohonan dengan pesan berhasil
        return redirect()
            ->route('admin.permohonan.index')
            ->with('success', 'Status permohonan kunjungan berhasil diperbarui.');
    }


    // ==================================================
    // MENAMPILKAN RIWAYAT KUNJUNGAN
    // ==================================================

    public function riwayat()
    {
        // Mengambil data kunjungan yang sudah diterima atau ditolak
        // sekaligus mengambil data pegawai yang terkait
        $riwayat = JanjiTemu::with('pegawai')
            ->whereIn('status', [
                'Diterima',
                'Ditolak'
            ])
            ->latest()
            ->get();

        // Mengirim data ke halaman riwayat kunjungan
        return view('admin.riwayat.index', compact(
            'riwayat'
        ));
    }
}