@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Petugas</h3>

    <form action="{{ route('admin.petugas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Username</label>
            <input name="username" class="form-control">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nama Petugas</label>
            <input name="nama_petugas" class="form-control">
        </div>

        <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
