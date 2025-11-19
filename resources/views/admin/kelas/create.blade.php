@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Kelas</h3>

    <form action="{{ route('admin.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kompetensi Keahlian</label>
            <input type="text" name="kompetensi_keahlian" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
