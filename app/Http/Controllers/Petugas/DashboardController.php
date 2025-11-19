<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_siswa' => Siswa::count(),
            'total_pembayaran' => Pembayaran::sum('jumlah_bayar'),
            'pembayaran_hari_ini' => Pembayaran::whereDate('tgl_bayar', date('Y-m-d'))->sum('jumlah_bayar'),
            'transaksi_hari_ini' => Pembayaran::whereDate('tgl_bayar', date('Y-m-d'))->count()
        ];

        return view('petugas.dashboard', $data);
    }
}