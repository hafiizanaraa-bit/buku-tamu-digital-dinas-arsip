<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PermohonanKunjunganController;
use App\Http\Controllers\LaporanController;

// [BARU] Kehadiran pegawai
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KehadiranAdminController;


// ==================================================
// HALAMAN PENGUNJUNG
// ==================================================

// 1. BERANDA PENGUNJUNG
Route::get('/', [BukuTamuController::class, 'index'])
    ->name('home');

// [BARU] KEHADIRAN PEGAWAI (tampil sebelum lokasi)
Route::get('/kehadiran', [KehadiranController::class, 'index'])
    ->name('buku-tamu.kehadiran');

// 2. INFORMASI LOKASI
Route::get('/lokasi', [BukuTamuController::class, 'lokasi'])
    ->name('buku-tamu.lokasi');

// 3. SURVEI KEPUASAN
Route::get('/survei', [BukuTamuController::class, 'survei'])
    ->name('buku-tamu.survei');

// 4. FORMULIR IDENTITAS TAMU
Route::get('/formulir', [BukuTamuController::class, 'formulir'])
    ->name('buku-tamu.formulir');

Route::post('/formulir', [BukuTamuController::class, 'simpanIdentitas'])
    ->name('buku-tamu.identitas.simpan');

// 5. TUJUAN KUNJUNGAN
Route::get('/tujuan', [BukuTamuController::class, 'tujuan'])
    ->name('buku-tamu.tujuan');

// CEK KETERSEDIAAN PEGAWAI
Route::post('/cek-ketersediaan', [BukuTamuController::class, 'cekKetersediaan'])
    ->name('buku-tamu.cek-ketersediaan');

// 6. HASIL PENCARIAN PEGAWAI
Route::get('/hasil-pencarian', [BukuTamuController::class, 'hasilPencarian'])
    ->name('buku-tamu.hasil-pencarian');

// 7. AJUKAN JANJI TEMU
Route::get('/ajukan-janji', [BukuTamuController::class, 'ajukanJanji'])
    ->name('buku-tamu.ajukan-janji');

Route::post('/ajukan-janji', [BukuTamuController::class, 'simpanJanji'])
    ->name('buku-tamu.simpan-janji');

// 8. KONFIRMASI KUNJUNGAN
Route::get('/konfirmasi/{kode}', [BukuTamuController::class, 'konfirmasi'])
    ->name('buku-tamu.konfirmasi');


// ==================================================
// LOGIN ADMIN
// ==================================================

// HALAMAN LOGIN ADMIN
// Controller akan mengarahkan admin yang sudah login ke dashboard.
Route::get('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');

// PROSES LOGIN ADMIN
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])
    ->middleware('guest')
    ->name('admin.authenticate');

// LOGOUT ADMIN
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');


// ==================================================
// PENGARAH HALAMAN ADMIN
// ==================================================

// Jika belum login, arahkan ke halaman login admin.
// Jika sudah login, arahkan ke dashboard admin.
Route::get('/admin', function () {

    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login');

});


// ==================================================
// HALAMAN ADMIN
// ==================================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        // ==================================================
        // DATA PEGAWAI
        // ==================================================

        Route::resource('pegawai', PegawaiController::class)
            ->except(['show']);


        // ==================================================
        // [BARU] KEHADIRAN PEGAWAI
        // ==================================================

        Route::get('/kehadiran', [KehadiranAdminController::class, 'index'])
            ->name('kehadiran.index');

        Route::post('/kehadiran', [KehadiranAdminController::class, 'simpan'])
            ->name('kehadiran.simpan');

        Route::post('/kehadiran/import', [KehadiranAdminController::class, 'import'])
            ->name('kehadiran.import');


        // ==================================================
        // PERMOHONAN KUNJUNGAN
        // ==================================================

        // DAFTAR PERMOHONAN
        Route::get('/permohonan-kunjungan', [PermohonanKunjunganController::class, 'index'])
            ->name('permohonan.index');

        // DETAIL PERMOHONAN
        Route::get('/permohonan-kunjungan/{id}', [PermohonanKunjunganController::class, 'show'])
            ->whereNumber('id')
            ->name('permohonan.show');

        // UPDATE STATUS
        Route::patch('/permohonan-kunjungan/{id}/status', [PermohonanKunjunganController::class, 'updateStatus'])
            ->whereNumber('id')
            ->name('permohonan.update-status');


        // ==================================================
        // RIWAYAT KUNJUNGAN
        // ==================================================

        Route::get('/riwayat-kunjungan', [PermohonanKunjunganController::class, 'riwayat'])
            ->name('riwayat.index');


        // ==================================================
        // LAPORAN KUNJUNGAN
        // ==================================================

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        // Laporan mingguan sekarang menyatu di halaman Laporan.
        // Rute lama dipertahankan agar tautan/bookmark lama tetap berfungsi.
        Route::get('/laporan/mingguan', function () {
            return redirect()->route('admin.laporan.index', ['jenis_laporan' => 'mingguan']);
        })->name('laporan.mingguan');

    });


// ==================================================
// FALLBACK / 404
// ==================================================

// Tidak perlu menambahkan route fallback khusus.
// Laravel akan otomatis menampilkan halaman 404
// jika URL tidak ditemukan.