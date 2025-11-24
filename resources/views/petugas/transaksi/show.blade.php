@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Transaksi</h3>

    <a href="{{ route('petugas.transaksi.history.petugas') }}" class="btn btn-secondary mb-3">Kembali</a>

    <div class="card">
        <div class="card-body">
            <p><strong>ID Transaksi:</strong> {{ $pembayaran->id }}</p>
            <p><strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($pembayaran->tgl_bayar)->format('d-m-Y H:i') }}</p>
            <p><strong>Petugas:</strong> {{ optional($pembayaran->petugas)->nama_petugas ?? '—' }}</p>

            <h5>Data Siswa</h5>
            <p><strong>NISN:</strong> {{ $siswa->nisn ?? '-' }}</p>
            <p><strong>Nama:</strong> {{ $siswa->nama ?? '-' }}</p>
            <p><strong>Kelas:</strong> {{ optional($siswa->kelas)->nama_kelas ?? '-' }}</p>
            <p><strong>SPP:</strong> {{ optional($siswa->spp)->nominal ?? '-' }}</p>

            <h5>Pembayaran</h5>
            <p><strong>Bulan:</strong> {{ $pembayaran->bulan_dibayar }}</p>
            <p><strong>Tahun:</strong> {{ $pembayaran->tahun_dibayar }}</p>
            <p><strong>Jumlah Bayar:</strong> {{ number_format($pembayaran->jumlah_bayar,0,',','.') }}</p>
        </div>
    </div>
</div>
@endsection
