<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    // ==============================
    //   CREATE — Admin & Petugas
    // ==============================
    public function index()
    {
        // Mendapatkan semua siswa
        $siswa = Siswa::all();

        // Daftar bulan dari Juli hingga Juni (12 bulan)
        $bulan = [
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
        ];

        // Mengambil data pembayaran siswa untuk 12 bulan terakhir
        $pembayaran = Pembayaran::select('nisn', 'bulan_dibayar')
            ->whereBetween('bulan_dibayar', ['2023-07', '2024-06'])  // Sesuaikan dengan tahun yang relevan
            ->get()
            ->groupBy('nisn');

        // Tentukan route prefix berdasarkan guard
        $prefix = Auth::guard('admin')->check() ? 'admin' : 'petugas';
        $storeRoute = $prefix . '.pembayaran.store';

        return view('pembayaran.index', compact('siswa', 'bulan', 'pembayaran', 'storeRoute'));
    }

    // ==============================
    //   STORE — Admin & Petugas
    // ==============================
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nisn' => 'required|exists:siswa,nisn',
            'bulan_dibayar' => 'required',
            'jumlah_bayar' => 'required|integer',
            'tgl_bayar' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $siswa = Siswa::where('nisn', $request->nisn)->first();

            // Membuat pembayaran baru
            Pembayaran::create([
                'id_petugas'   => Auth::user()->id_petugas ?? null,
                'nisn'         => $request->nisn,
                'tgl_bayar'    => $request->tgl_bayar,
                'bulan_dibayar'=> $request->bulan_dibayar,
                'id_spp'       => $siswa->id_spp,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            DB::commit();
            return back()->with('success', 'Pembayaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error: ' . $e->getMessage());
        }
    }

    // ==============================
    //   HISTORY — berbeda tiap Role
    // ==============================
    public function history()
    {
        // ADMIN – semua data
        if (Auth::guard('admin')->check()) {
            $pembayaran = Pembayaran::with(['siswa', 'petugas', 'spp'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return view('pembayaran.history_admin', compact('pembayaran'));
        }

        // PETUGAS – hanya transaksi miliknya
        if (Auth::guard('petugas')->check()) {
            $id = Auth::guard('petugas')->user()->id_petugas;

            $pembayaran = Pembayaran::with(['siswa', 'petugas', 'spp'])
                ->where('id_petugas', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return view('pembayaran.history_petugas', compact('pembayaran'));
        }

        // SISWA – hanya pembayaran dirinya
        if (Auth::guard('siswa')->check()) {
            $nisn = Auth::guard('siswa')->user()->nisn;

            $pembayaran = Pembayaran::with(['siswa', 'petugas', 'spp'])
                ->where('nisn', $nisn)
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return view('pembayaran.history_siswa', compact('pembayaran'));
        }
    }
}
