<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Pembayaran;
use App\Models\Kelas;

class DashboardController extends Controller
{
    // === DASHBOARD ADMIN ===
    public function admin()
    {
        $data = [
            'total_siswa' => Siswa::count(),
            'total_petugas' => Petugas::where('level', 'petugas')->count(),
            'total_kelas' => Kelas::count(),
            'total_pembayaran' => Pembayaran::sum('jumlah_bayar'),
            'pembayaran_bulan_ini' => Pembayaran::whereMonth('tgl_bayar', date('m'))
                                                ->whereYear('tgl_bayar', date('Y'))
                                                ->sum('jumlah_bayar')
        ];

        return view('admin.dashboard', compact('data'));
    }

    // === DASHBOARD PETUGAS ===
    public function petugas()
    {
        $petugas = Auth::guard('petugas')->user();

        $pembayaran = Pembayaran::with(['siswa', 'spp'])
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        return view('dashboard.petugas', compact('petugas', 'pembayaran'));
    }

    // === DASHBOARD SISWA ===
    public function siswa()
    {
        $siswa = Auth::guard('siswa')->user();

        $pembayaran = Pembayaran::where('nisn', $siswa->nisn)
                                ->with(['petugas', 'spp'])
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        $total_dibayar = Pembayaran::where('nisn', $siswa->nisn)->sum('jumlah_bayar');

        return view('dashboard.siswa', compact('siswa', 'pembayaran', 'total_dibayar'));
    }

    // === HISTORY SISWA ===
    public function Siswahistory()
    {
        $siswa = Auth::guard('siswa')->user();
        $pembayaran = Pembayaran::where('nisn', $siswa->nisn)
                                ->with(['petugas', 'spp'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('siswa.history', compact('pembayaran', 'siswa'));
    }
}
