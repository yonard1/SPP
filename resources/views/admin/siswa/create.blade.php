@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Siswa</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.siswa.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>NISN</label>
            <input name="nisn" class="form-control">
        </div>

        <div class="mb-3">
            <label>NIS</label>
            <input name="nis" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input name="nama" class="form-control">
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control">
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input name="no_telp" class="form-control">
        </div>

        <div class="mb-3">
            <label>SPP</label>
            <select name="id_spp" class="form-control">
                @foreach($spp as $sp)
                    <option value="{{ $sp->id_spp }}">{{ $sp->tahun }} - {{ number_format($sp->nominal) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
