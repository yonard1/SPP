@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Edit Petugas</h3>

    {{-- Pesan error khusus (misal: tidak boleh ubah level sendiri) --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.petugas.update', $petugas->id_petugas) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- USERNAME --}}
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input 
                name="username" 
                class="form-control @error('username') is-invalid @enderror" 
                value="{{ old('username', $petugas->username) }}">

            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- PASSWORD --}}
        <div class="mb-3">
            <label class="form-label">Password (opsional)</label>
            <input 
                name="password" 
                type="password" 
                class="form-control @error('password') is-invalid @enderror">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- NAMA PETUGAS --}}
        <div class="mb-3">
            <label class="form-label">Nama Petugas</label>
            <input 
                name="nama_petugas" 
                class="form-control @error('nama_petugas') is-invalid @enderror" 
                value="{{ old('nama_petugas', $petugas->nama_petugas) }}">

            @error('nama_petugas')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- LEVEL --}}
        <div class="mb-3">
            <label class="form-label">Level</label>
            <select 
                name="level" 
                class="form-control @error('level') is-invalid @enderror">
                
                <option value="admin" {{ old('level', $petugas->level) == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="petugas" {{ old('level', $petugas->level) == 'petugas' ? 'selected' : '' }}>
                    Petugas
                </option>
            </select>

            @error('level')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success px-4">Update</button>
    </form>
</div>
@endsection
