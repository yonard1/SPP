<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $siswa = Siswa::with(['kelas', 'spp', 'pembayaran'])
        ->when($search, function($q) use($search){
            $q->where('nama', 'like', "%$search%")
              ->orWhere('nisn', 'like', "%$search%")
              ->orWhereHas('kelas', function ($k) use ($search){
                $k->where('nama_kelas', 'like', "%$search$");
            });
        })->get();

        $data_siswa = [];
        $bulan_semua = ['Juli','Agustus','September','Oktober','November','Desember','Januari','Februari','Maret','April','Mei','Juni'];

        foreach ($siswa as $s) {
            $bulan_lunas = $s->pembayaran->pluck('bulan_dibayar')->toArray();

            $status_bulan = [];
            foreach ($bulan_semua as $bulan) {
                $status_bulan[$bulan] = in_array($bulan, $bulan_lunas);
            }

            $data_siswa[] = [
                'siswa' => $s,
                'status_bulan' => $status_bulan,
                'total_lunas' => count($bulan_lunas),
                'total_belum' => 12 - count($bulan_lunas)
            ];
        }

        return view('petugas.transaksi.index', compact('data_siswa'));
    }

    public function create($nisn)
    {
        $siswa = Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->firstOrFail();

        $bulan_semua = ['Juli','Agustus','September','Oktober','November','Desember','Januari','Februari','Maret','April','Mei','Juni'];

        $bulan_lunas = Pembayaran::where('nisn', $nisn)
            ->where('tahun_dibayar', date('Y'))
            ->pluck('bulan_dibayar')
            ->toArray();

        foreach ($bulan_semua as $bulan) {
            $status_bulan[$bulan] = in_array($bulan, $bulan_lunas);
        }

        return view('petugas.transaksi.create', compact('siswa', 'status_bulan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|exists:siswas,nisn',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required|digits:4',
            'jumlah_bayar' => 'required|numeric|min:0'
        ]);

        $cek = Pembayaran::where('nisn', $request->nisn)
            ->where('bulan_dibayar', $request->bulan_dibayar)
            ->where('tahun_dibayar', $request->tahun_dibayar)
            ->first();

        if ($cek) {
            return back()->with('error', 'Pembayaran untuk bulan ini sudah ada!');
        }

        $siswa = Siswa::where('nisn', $request->nisn)->first();

        Pembayaran::create([
            'id_petugas' => session('id'),
            'nisn' => $request->nisn,
            'tgl_bayar' => now(),
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp' => $siswa->id_spp,
            'jumlah_bayar' => $request->jumlah_bayar
        ]);

        return redirect()->route('petugas.transaksi.create', $request->nisn)
            ->with('success', 'Pembayaran bulan '.$request->bulan_dibayar.' berhasil ditambahkan');
    }

    public function history()
    {
        // gunakan session('id') jika kamu menyimpan id petugas di session seperti create()
        $idPetugas = session('id');

        // kalau pakai auth: $idPetugas = auth()->id();

        $pembayaran = Pembayaran::with(['petugas', 'siswa.kelas', 'siswa.spp'])
            ->where('id_petugas', $idPetugas)
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        return view('petugas.transaksi.history', compact('pembayaran'));
    }

    public function show($id)
    {
        // ambil payment by id
        $pembayaran = Pembayaran::with(['petugas', 'siswa.kelas', 'siswa.spp'])
            ->where('id_pembayaran', $id)
            ->firstOrFail();

        // cek agar petugas hanya bisa melihat transaksi yang dia lakukan
        $idPetugas = session('id'); // atau auth()->id()
        if ($pembayaran->id_petugas != $idPetugas) {
            abort(403, 'Anda tidak berhak melihat transaksi ini.');
        }

        // kalau view membutuhkan $siswa, kirim juga
        $siswa = $pembayaran->siswa;

        return view('petugas.transaksi.show', compact('pembayaran', 'siswa'));
    }
}
