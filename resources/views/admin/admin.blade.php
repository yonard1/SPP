@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Dashboard Admin</h2>

    <div class="row">

        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5>Total Siswa</h5>
                    <h3>{{ $data['total_siswa'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5>Total Petugas</h5>
                    <h3>{{ $data['total_petugas'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5>Total Kelas</h5>
                    <h3>{{ $data['total_kelas'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-bg-danger">
                <div class="card-body">
                    <h5>Total Pembayaran</h5>
                    <h3>Rp {{ number_format($data['total_pembayaran']) }}</h3>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
