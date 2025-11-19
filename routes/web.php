<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Root route to redirect to login
Route::get('/', function () {
    return redirect('/login');
});

// ADMIN Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;

// ========================
//      HALAMAN LOGIN
// ========================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/// ADMIN
Route::middleware(['auth.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

        Route::resource('siswa', SiswaController::class);
        Route::resource('petugas', PetugasController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('spp', SppController::class);
        Route::resource('laporan', LaporanController::class);

        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/history', [PembayaranController::class, 'history'])->name('pembayaran.history');
});

// PETUGAS
Route::middleware(['auth.petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'petugas'])->name('dashboard');

        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
        Route::get('/pembayaran/history', [PembayaranController::class, 'history'])->name('pembayaran.history');
});

// SISWA
Route::middleware(['auth.siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'siswa'])->name('dashboard');
        Route::get('/history', [PembayaranController::class, 'history'])->name('history');
});

