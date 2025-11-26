@extends('layouts.admin')
@section('title', 'Laporan SPP')
@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Laporan Pembayaran SPP</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.laporan.generate') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Bulan Dibayar</label>
                    <select name="bulan" class="form-control">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Tahun Dibayar</label>
                    <input type="number" name="tahun" class="form-control" placeholder="contoh: 2024">
                </div>

                <button class="btn btn-primary">Tampilkan Laporan</button>
            </form>

        </div>
    </div>

</div>
@endsection
