@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Laporan Pembayaran Persiswa</h3>

    {{-- <a href="{{ route('admin.laporan.pembayaran.pdf') }}"
       class="btn btn-danger mb-3">Download PDF</a> --}}

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NISN</th>
                <th>Nama</th>
                <th>Petugas</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayaran as $p)
            <tr>
                <td>{{ $p['siswa']->nisn }}</td>
                <td>{{ $p['siswa']->nama }}</td>
                <td>{{ $p['petugas']->nama_petugas }}</td>
                <td>{{ $p['created_at'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
