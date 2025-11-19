<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $nisn = session('nisn');
        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->first();
        
        $bulan_lunas = Pembayaran::where('nisn', $nisn)
            ->pluck('bulan_dibayar')
            ->toArray();

        $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        
        $status_pembayaran = [];
        foreach ($bulan as $bln) {
            $status_pembayaran[$bln] = in_array($bln, $bulan_lunas) ? 'Lunas' : 'Belum Bayar';
        }

        $data = [
            'siswa' => $siswa,
            'status_pembayaran' => $status_pembayaran,
            'total_bayar' => Pembayaran::where('nisn', $nisn)->sum('jumlah_bayar'),
            'history' => Pembayaran::where('nisn', $nisn)->with('petugas')->latest()->get()
        ];

        return view('siswa.dashboard', $data);
    }
}