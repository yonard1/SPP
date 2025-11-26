@extends('layouts.app')
@section('title', 'History Siswa')
@section('content')
<div class="container mt-4">

    <h3>History Pembayaran Kamu</h3>
    <p>NISN: {{ $siswa->nisn }} | Nama: {{ $siswa->nama }}</p>

    <table class="table table-hover table-bordered">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Tanggal Bayar</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->tgl_bayar }}</td>
                <td>{{ $p->bulan_dibayar }}</td>
                <td>{{ $p->tahun_dibayar }}</td>
                <td>Rp {{ number_format($p->jumlah_bayar,0,',','.') }}</td>
                <td>{{ $p->petugas->nama_petugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
