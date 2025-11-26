@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Data Siswa</h5>
                <p><strong>NISN:</strong> {{ $siswa->nisn }}</p>
                <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                <p><strong>Kelas:</strong> {{ $siswa->kelas->nama_kelas }}</p>
                <p><strong>SPP:</strong> Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Status Pembayaran per Bulan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status_pembayaran as $bulan => $status)
                        <tr>
                            <td>{{ $bulan }}</td>
                            <td>
                                @if($status == 'Lunas')
                                    <span class="badge bg-success">✓ Lunas</span>
                                @else
                                    <span class="badge bg-danger">✗ Belum Bayar</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
