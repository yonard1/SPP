@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Data Siswa</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Telepon</th>
                <th>SPP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $s->nisn }}</td>
                <td>{{ $s->nis }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->kelas->nama_kelas }}</td>
                <td>{{ $s->no_telp }}</td>
                <td>{{ $s->spp->nominal }}</td>
                <td>
                    <a href="{{ route('admin.siswa.edit', $s->nisn) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.siswa.destroy', $s->nisn) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $siswa->links() }}
</div>
@endsection
