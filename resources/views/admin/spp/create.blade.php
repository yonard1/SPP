@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Data SPP</h2>

    <form action="{{ route('admin.spp.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
