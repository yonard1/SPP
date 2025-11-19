@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Dashboard Petugas</h3>

    <div class="alert alert-info">
        Selamat datang, <strong>{{ $petugas->nama_petugas }}</strong>!
    </div>

    <h5>Riwayat Pembayaran Terbaru</h5>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Siswa</th>
                <th>SPP</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr>
                <td>{{ $p->siswa->nama }}</td>
                <td>{{ $p->spp->nominal }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
                <td>{{ $p->tgl_bayar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pembayaran->links() }}
</div>
@endsection
