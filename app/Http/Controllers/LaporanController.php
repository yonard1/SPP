<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        $pembayaran = Pembayaran::with(['siswa', 'petugas', 'spp'])
                                ->where('bulan_dibayar', $request->bulan)
                                ->where('tahun_dibayar', $request->tahun)
                                ->get();

        $total = $pembayaran->sum('jumlah_bayar');

        return view('admin.laporan.view', compact('pembayaran', 'total', 'request'));
    }
}