@extends('layouts.app')
@section('content')

<h2 class="title">Riwayat Pembayaran</h2>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Petugas</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($history as $h)
            <tr>
                <td>{{ $h->siswa->nisn }}</td>
                <td>{{ $h->siswa->nama }}</td>
                <td>{{ $h->bulan }}</td>
                <td>Rp {{ number_format($h->nominal, 0, ',', '.') }}</td>
                <td>{{ $h->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ $h->petugas->nama ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;">Belum ada riwayat pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
