@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Siswa</h5>
                <h2>{{ $total_siswa }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Total Petugas</h5>
                <h2>{{ $total_petugas }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Total Kelas</h5>
                <h2>{{ $total_kelas }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Total SPP</h5>
                <h2>{{ $total_spp }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Total Pembayaran</h5>
                <h3>Rp {{ number_format($total_pembayaran, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Pembayaran Bulan Ini</h5>
                <h3>Rp {{ number_format($pembayaran_bulan_ini, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection