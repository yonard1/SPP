@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3>Dashboard Siswa</h3>

    <div class="alert alert-info">
        Selamat datang, <strong>{{ $siswa->nama }}</strong> (NISN: {{ $siswa->nisn }})
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5>Total Pembayaran Masuk</h5>
            <h3 class="text-success">Rp {{ number_format($total_dibayar, 0, ',', '.') }}</h3>
        </div>
    </div>

    <h5>Pembayaran Terbaru</h5>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Petugas</th>
                <th>Nominal</th>
                <th>SPP</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayaran as $p)
            <tr>
                <td>{{ $p->petugas->nama_petugas }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                <td>{{ $p->spp->nominal }}</td>
                <td>{{ $p->tgl_bayar }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pembayaran->links() }}

</div>
@endsection
