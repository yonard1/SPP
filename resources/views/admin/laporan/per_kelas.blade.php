@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Pembayaran Per Kelas</h3>

    <h4>{{ $kelas->nama_kelas }}</h4>

    <a href="{{ route('admin.laporan.per_kelas.pdf', ['id_kelas' => $kelas->id_kelas]) }}"
       class="btn btn-danger mb-3">Download PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Bulan Lunas</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_siswa as $ds)
            <tr>
                <td>{{ $ds['siswa']->nisn }}</td>
                <td>{{ $ds['siswa']->nama }}</td>
                <td>{{ $ds['bulan_lunas'] }}/12</td>
                <td>{{ number_format($ds['total_bayar']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
