@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Siswa</h3>

    <form action="{{ route('admin.siswa.update', $siswa->nisn) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>NISN</label>
            <input name="nisn" class="form-control" value="{{ $siswa->nisn }}">
        </div>

        <div class="mb-3">
            <label>NIS</label>
            <input name="nis" class="form-control" value="{{ $siswa->nis }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input name="nama" class="form-control" value="{{ $siswa->nama }}">
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control">
                @foreach($kelas as $k)
                    <option value="{{ $k->id_kelas }}" {{ $siswa->id_kelas==$k->id_kelas?'selected':'' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ $siswa->alamat }}</textarea>
        </div>

        <div class="mb-3">
            <label>No. Telepon</label>
            <input name="no_telp" class="form-control" value="{{ $siswa->no_telp }}">
        </div>

        <div class="mb-3">
            <label>SPP</label>
            <select name="id_spp" class="form-control">
                @foreach($spp as $sp)
                    <option value="{{ $sp->id_spp }}" {{ $siswa->id_spp==$sp->id_spp?'selected':'' }}>
                        {{ $sp->tahun }} - {{ number_format($sp->nominal) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Password (opsional)</label>
            <input name="password" type="password" class="form-control">
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
