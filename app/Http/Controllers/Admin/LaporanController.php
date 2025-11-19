<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PDF; // Jika pakai barryvdh/laravel-dompdf

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function laporanPembayaran(Request $request)
    {
        $request->validate([
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal'
        ]);

        $dari = $request->dari_tanggal;
        $sampai = $request->sampai_tanggal;

        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->whereBetween('tgl_bayar', [$dari, $sampai])
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        $total = $pembayaran->sum('jumlah_bayar');

        return view('admin.laporan.pembayaran', compact('pembayaran', 'total', 'dari', 'sampai'));
    }

    public function laporanPembayaranPdf(Request $request)
    {
        $dari = $request->dari_tanggal;
        $sampai = $request->sampai_tanggal;

        $pembayaran = Pembayaran::with(['siswa.kelas', 'petugas', 'spp'])
            ->whereBetween('tgl_bayar', [$dari, $sampai])
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        $total = $pembayaran->sum('jumlah_bayar');

        $pdf = PDF::loadView('admin.laporan.pembayaran_pdf', compact('pembayaran', 'total', 'dari', 'sampai'));
        return $pdf->download('laporan-pembayaran-'.$dari.'-'.$sampai.'.pdf');
    }

    public function laporanPerSiswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswas,nisn'
        ]);

        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $request->nisn)->first();
        $pembayaran = Pembayaran::with(['petugas'])
            ->where('nisn', $request->nisn)
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        $total = $pembayaran->sum('jumlah_bayar');

        $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        $bulan_lunas = $pembayaran->pluck('bulan_dibayar')->toArray();
        
        $status_pembayaran = [];
        foreach ($bulan as $bln) {
            $status_pembayaran[$bln] = in_array($bln, $bulan_lunas);
        }

        return view('admin.laporan.per_siswa', compact('siswa', 'pembayaran', 'total', 'status_pembayaran'));
    }

    public function laporanPerSiswaPdf(Request $request)
    {
        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $request->nisn)->first();
        $pembayaran = Pembayaran::with(['petugas'])
            ->where('nisn', $request->nisn)
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        $total = $pembayaran->sum('jumlah_bayar');

        $bulan = ['Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'];
        $bulan_lunas = $pembayaran->pluck('bulan_dibayar')->toArray();
        
        $status_pembayaran = [];
        foreach ($bulan as $bln) {
            $status_pembayaran[$bln] = in_array($bln, $bulan_lunas);
        }

        $pdf = PDF::loadView('admin.laporan.per_siswa_pdf', compact('siswa', 'pembayaran', 'total', 'status_pembayaran'));
        return $pdf->download('laporan-siswa-'.$siswa->nisn.'.pdf');
    }

    public function laporanPerKelas(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas'
        ]);

        $kelas = Kelas::findOrFail($request->id_kelas);
        $siswa = Siswa::with(['spp', 'pembayaran'])
            ->where('id_kelas', $request->id_kelas)
            ->get();

        $data_siswa = [];
        foreach ($siswa as $s) {
            $total_bayar = $s->pembayaran->sum('jumlah_bayar');
            $bulan_lunas = $s->pembayaran->count();
            $data_siswa[] = [
                'siswa' => $s,
                'total_bayar' => $total_bayar,
                'bulan_lunas' => $bulan_lunas
            ];
        }

        return view('admin.laporan.per_kelas', compact('kelas', 'data_siswa'));
    }

    public function laporanPerKelasPdf(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id_kelas);
        $siswa = Siswa::with(['spp', 'pembayaran'])
            ->where('id_kelas', $request->id_kelas)
            ->get();

        $data_siswa = [];
        foreach ($siswa as $s) {
            $total_bayar = $s->pembayaran->sum('jumlah_bayar');
            $bulan_lunas = $s->pembayaran->count();
            $data_siswa[] = [
                'siswa' => $s,
                'total_bayar' => $total_bayar,
                'bulan_lunas' => $bulan_lunas
            ];
        }

        $pdf = PDF::loadView('admin.laporan.per_kelas_pdf', compact('kelas', 'data_siswa'));
        return $pdf->download('laporan-kelas-'.$kelas->nama_kelas.'.pdf');
    }

    public function laporanTunggakan()
    {
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran'])->get();

        $data_tunggakan = [];
        foreach ($siswa as $s) {
            $bulan_lunas = $s->pembayaran->count();
            $bulan_belum = 12 - $bulan_lunas;
            $total_tunggakan = $bulan_belum * $s->spp->nominal;

            if ($bulan_belum > 0) {
                $data_tunggakan[] = [
                    'siswa' => $s,
                    'bulan_lunas' => $bulan_lunas,
                    'bulan_belum' => $bulan_belum,
                    'total_tunggakan' => $total_tunggakan
                ];
            }
        }

        return view('admin.laporan.tunggakan', compact('data_tunggakan'));
    }

    public function laporanTunggakanPdf()
    {
        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran'])->get();

        $data_tunggakan = [];
        foreach ($siswa as $s) {
            $bulan_lunas = $s->pembayaran->count();
            $bulan_belum = 12 - $bulan_lunas;
            $total_tunggakan = $bulan_belum * $s->spp->nominal;

            if ($bulan_belum > 0) {
                $data_tunggakan[] = [
                    'siswa' => $s,
                    'bulan_lunas' => $bulan_lunas,
                    'bulan_belum' => $bulan_belum,
                    'total_tunggakan' => $total_tunggakan
                ];
            }
        }

        $pdf = PDF::loadView('admin.laporan.tunggakan_pdf', compact('data_tunggakan'));
        return $pdf->download('laporan-tunggakan.pdf');
    }
}