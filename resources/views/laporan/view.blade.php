@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Laporan Pembayaran SPP</h2>

    <div class="alert alert-info">
        Menampilkan laporan bulan <b>{{ $request->bulan }}</b> tahun <b>{{ $request->tahun }}</b>
    </div>

    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Petugas</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan Dibayar</th>
                        <th>Tahun Dibayar</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $p)
                    <tr>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->siswa->kelas->nama_kelas ?? '-' }}</td>
                        <td>{{ $p->petugas->nama_petugas }}</td>
                        <td>{{ date('d M Y', strtotime($p->tgl_bayar)) }}</td>
                        <td>{{ $p->bulan_dibayar }}</td>
                        <td>{{ $p->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pembayaran ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <h4 class="text-end mt-3">
                Total: <b>Rp {{ number_format($total) }}</b>
            </h4>

        </div>
    </div>

</div>
@endsection
