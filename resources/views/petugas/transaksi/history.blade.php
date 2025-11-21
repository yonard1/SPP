@extends('layouts.app')

@section('content')
<div class="container">
    <h3>History Transaksi Saya</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pembayaran->isEmpty())
        <div class="alert alert-info">Belum ada transaksi yang Anda lakukan.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tgl Bayar</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Bulan/Tahun</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $i => $p)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_bayar)->format('d-m-Y H:i') }}</td>
                        <td>{{ $p->nisn }}</td>
                        <td>{{ optional($p->siswa)->nama ?? '-' }}</td>
                        <td>{{ number_format($p->jumlah_bayar,0,',','.') }}</td>
                        <td>{{ $p->bulan_dibayar }} / {{ $p->tahun_dibayar }}</td>
                        <td>{{ optional($p->petugas)->nama_petugas ?? 'Anda' }}</td>
                        <td>
                            <a href="{{ route('petugas.transaksi.show', ['id' => $p->id_pembayaran]) }}">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
