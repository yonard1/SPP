@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Laporan Tunggakan</h3>

    <a href="{{ route('admin.laporan.tunggakan.pdf') }}" 
        class="btn btn-danger mb-3">Download PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Bulan Belum Bayar</th>
                <th>Total Tunggakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_tunggakan as $dt)
            <tr>
                <td>{{ $dt['siswa']->nisn }}</td>
                <td>{{ $dt['siswa']->nama }}</td>
                <td>{{ $dt['siswa']->kelas->nama_kelas }}</td>
                <td>{{ $dt['bulan_belum'] }}</td>
                <td>Rp {{ number_format($dt['total_tunggakan']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
