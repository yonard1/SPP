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
    Route::resource('transaksi', TransaksiAdmin::class);
    Route::get('/transaksi/siswa/{nisn}', [TransaksiAdmin::class, 'getSiswaDetail'])
        ->name('transaksi.siswa');

    // LAPORAN
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});



/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware('auth.petugas')->prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

    // HANYA BISA LIHAT
    Route::resource('siswa', SiswaController::class)->only(['index', 'show']);
    Route::resource('petugas', PetugasController::class)->only(['index', 'show']);
    Route::resource('spp', SppController::class)->only(['index', 'show']);
    Route::resource('kelas', KelasController::class)->only(['index', 'show']);

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI PETUGAS (CUMA index, create, store, history)
    |--------------------------------------------------------------------------
    */
    Route::get('/transaksi', [TransaksiPetugas::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{nisn}/create', [TransaksiPetugas::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiPetugas::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{nisn}/history', [TransaksiPetugas::class, 'history'])->name('transaksi.history');
});



/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware('auth.siswa')->prefix('siswa')->name('siswa.')->group(function () {

    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    // SISWA cuma bisa lihat pembayaran dia sendiri
    Route::get('/transaksi', [TransaksiPetugas::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{nisn}', [TransaksiPetugas::class, 'show'])->name('transaksi.show');
});
