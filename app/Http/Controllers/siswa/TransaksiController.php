<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Pembayaran;

class TransaksiController extends Controller{

    public function historySiswa()
    {
        $nisn = session('nisn');

        $siswa = Siswa::with(['kelas', 'spp'])
            ->where('nisn', $nisn)
            ->firstOrFail();

        $pembayaran = Pembayaran::with('petugas')
            ->where('nisn', $nisn)
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        return view('siswa.transaksi.history', compact('siswa', 'pembayaran'));
    }
}
