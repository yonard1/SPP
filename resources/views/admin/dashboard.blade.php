@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <!-- Total Siswa -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Siswa</h5>
                    <p class="card-text fs-3">{{ $data['total_siswa'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Petugas -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Petugas</h5>
                    <p class="card-text fs-3">{{ $data['total_petugas'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Kelas</h5>
                    <p class="card-text fs-3">{{ $data['total_kelas'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Pembayaran -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Pembayaran</h5>
                    <p class="card-text fs-3">Rp{{ number_format($data['total_pembayaran'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pembayaran Bulan Ini -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Pembayaran Bulan Ini</h5>
                    <p class="card-text fs-3">Rp{{ number_format($data['pembayaran_bulan_ini'], 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
