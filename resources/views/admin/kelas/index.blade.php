@extends('layouts.app')
@section('title', 'CRUD Kelas')
@section('content')
<div class="container mt-4">
    <h3>Data Kelas</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Kompetensi Keahlian</th>
                <th>Jumlah Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->kompetensi_keahlian }}</td>
                <td>{{ $k->siswa_count }}</td>
                <td>
                    <a href="{{ route('admin.kelas.edit', $k->id_kelas) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kelas.destroy', $k->id_kelas) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $kelas->links() }}
</div>
@endsection
