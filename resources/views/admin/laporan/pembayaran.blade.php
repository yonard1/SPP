@extends('layouts.app')
@section('title', 'Pembayaran')
@section('content')
<div class="container">
    <h3>Laporan Pembayaran</h3>

    <p>Periode: <b>{{ $dari }}</b> sampai <b>{{ $sampai }}</b></p>

    <a href="{{ route('admin.laporan.pembayaran.pdf', ['dari_tanggal' => $dari, 'sampai_tanggal' => $sampai]) }}" target="_blank" class="btn btn-danger mb-3">Download PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tgl Bayar</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>SPP</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr>
                <td>{{ $p->tgl_bayar }}</td>
                <td>{{ $p->nisn }}</td>
                <td>{{ $p->siswa->nama }}</td>
                <td>{{ $p->siswa->kelas->nama_kelas }}</td>
                <td>{{ $p->spp->nominal }}</td>
                <td>{{ number_format($p->jumlah_bayar) }}</td>
                <td>{{ $p->petugas->nama_petugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Pembayaran: Rp {{ number_format($total) }}</h4>
</div>
@endsection
