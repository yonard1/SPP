@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Kelas</h3>

    <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}">
        </div>

        <div class="mb-3">
            <label>Kompetensi Keahlian</label>
            <input type="text" name="kompetensi_keahlian" class="form-control" value="{{ $kelas->kompetensi_keahlian }}">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
