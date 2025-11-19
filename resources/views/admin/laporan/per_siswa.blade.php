@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Pembayaran Siswa</h3>

    <h4>{{ $siswa->nama }} ({{ $siswa->nisn }})</h4>
    <p>Kelas: {{ $siswa->kelas->nama_kelas }}</p>

    <a href="{{ route('admin.laporan.per_siswa.pdf', ['nisn' => $siswa->nisn]) }}" 
       class="btn btn-danger mb-3">Download PDF</a>

    <h5>Status Pembayaran Tahun Ini</h5>
    <table class="table table-bordered">
        <tr>
            @foreach($status_pembayaran as $bulan => $status)
                <td>{{ $bulan }} : 
                    <b class="{{ $status ? 'text-success':'text-danger' }}">
                        {{ $status ? 'Lunas' : 'Belum' }}
                    </b>
                </td>
            @endforeach
        </tr>
    </table>

    <h5>Riwayat Pembayaran</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Bulan</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr>
                <td>{{ $p->tgl_bayar }}</td>
                <td>{{ $p->bulan_dibayar }}</td>
                <td>{{ number_format($p->jumlah_bayar) }}</td>
                <td>{{ $p->petugas->nama_petugas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Terbayar: Rp {{ number_format($total) }}</h4>
</div>
@endsection
