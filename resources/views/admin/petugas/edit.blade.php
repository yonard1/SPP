@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Petugas</h3>

    <form action="{{ route('admin.petugas.update', $petugas->id_petugas) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Username</label>
            <input name="username" class="form-control" value="{{ $petugas->username }}">
        </div>

        <div class="mb-3">
            <label>Password (opsional)</label>
            <input name="password" type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nama Petugas</label>
            <input name="nama_petugas" class="form-control" value="{{ $petugas->nama_petugas }}">
        </div>

        <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control">
                <option value="admin" {{ $petugas->level=='admin'?'selected':'' }}>Admin</option>
                <option value="petugas" {{ $petugas->level=='petugas'?'selected':'' }}>Petugas</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
