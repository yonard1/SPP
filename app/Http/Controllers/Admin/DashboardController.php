<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_siswa' => Siswa::count(),
            'total_petugas' => Petugas::count(),
            'total_kelas' => Kelas::count(),
            'total_spp' => Spp::count(),
            'pembayaran_bulan_ini' => Pembayaran::whereMonth('tgl_bayar', date('m'))->sum('jumlah_bayar')
        ];

        return view('admin.dashboard', $data);
    }
}