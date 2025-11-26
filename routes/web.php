<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Dashboard
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;

// Transaksi
use App\Http\Controllers\Admin\TransaksiController as TransaksiAdmin;
use App\Http\Controllers\Petugas\TransaksiController as TransaksiPetugas;
use App\Http\Controllers\Siswa\TransaksiController as TransaksiSiswa;

// Admin CRUD
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\SppController;
use App\Http\Controllers\Admin\SiswaController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth.admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // FULL CRUD
    Route::resource('siswa', SiswaController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('spp', SppController::class);
    Route::resource('kelas', KelasController::class);

    // TRANSAKSI ADMIN (FULL)
    Route::resource('transaksi', TransaksiAdmin::class)->except(['create','show']);

    // Create transaksi dengan NISN (wajib)
    Route::get('/transaksi', [TransaksiAdmin::class, 'index'])->name('transaksi.index');

    // Form pembayaran (HARUS pakai NISN)
    Route::get('/transaksi/{nisn}/create', [TransaksiAdmin::class, 'create'])->name('transaksi.create');

    // Proses simpan pembayaran
    Route::post('/transaksi', [TransaksiAdmin::class, 'store'])->name('transaksi.store');

    // History pembayaran
    Route::get('/transaksi/{nisn}/history', [TransaksiAdmin::class, 'history'])->name('transaksi.history');

    Route::get('/transaksi/global', [TransaksiAdmin::class, 'globalHistory'])
    ->name('transaksi.global');

    // =======================
    // ADMIN LAPORAN ROUTES
    // =======================
    Route::prefix('laporan')->name('laporan.')->group(function () {

        // Halaman utama laporan
        Route::get('/', [LaporanController::class, 'index'])->name('index');

        // --------------------- PER KELAS ---------------------
        Route::get('/kelas', [LaporanController::class, 'laporanPerKelas'])
            ->name('kelas.get');

        Route::post('/kelas', [LaporanController::class, 'laporanPerKelas'])
            ->name('kelas');

        Route::get('/kelas/pdf', [LaporanController::class, 'laporanPerKelasPdf'])
            ->name('per_kelas.pdf');

        Route::get('/pembayaran', [LaporanController::class,'LaporanPembayaran'])
        ->name('pembayaran.get');

        Route::post('/pembayaran', [LaporanController::class, 'LaporanPembayaran'])
        ->name('pembayaran');
    });
});



/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware('auth.petugas')->prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI PETUGAS (CUMA index, create, store, history)
    |--------------------------------------------------------------------------
    */
    Route::get('/transaksi', [TransaksiPetugas::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{nisn}/create', [TransaksiPetugas::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiPetugas::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{nisn}/history', [TransaksiPetugas::class, 'history'])->name('transaksi.history');

    // baru: history khusus petugas (list semua pembayaran yg dibuat petugas)
    Route::get('/transaksi/petugas/history', [TransaksiPetugas::class, 'historyPetugas'])
        ->name('transaksi.history.petugas');

    // baru: detail satu pembayaran (lihat detail transaksi)
    Route::get('/transaksi/{id}/show', [TransaksiPetugas::class, 'show'])
    ->name('transaksi.show');
});



/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware('auth.siswa')->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    // SISWA cuma bisa lihat pembayaran dia sendiri
    Route::get('/transaksi', [TransaksiSiswa::class, 'historySiswa'])->name('transaksi.history');
    // Route::get('/transaksi/{nisn}', [TransaksiSiswa::class, 'show'])->name('transaksi.show');
    // Route::get('/transaksi/history', [TransaksiSiswa::class, 'historySiswa'])->name('transaksi.history');
});
