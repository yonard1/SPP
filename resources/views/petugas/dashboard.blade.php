@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Siswa</h5>
                <h2>{{ $total_siswa }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Transaksi Hari Ini</h5>
                <h2>{{ $transaksi_hari_ini }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Pembayaran Hari Ini</h5>
                <h3>Rp {{ number_format($pembayaran_hari_ini, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection