@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Data Petugas</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Petugas</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($petugas as $p)
            <tr>
                <td>{{ $loop->iteration + $petugas->firstItem() - 1 }}</td>
                <td>{{ $p->username }}</td>
                <td>{{ $p->nama_petugas }}</td>
                <td>{{ ucfirst($p->level) }}</td>
                <td>
                    <a href="{{ route('admin.petugas.edit', $p->id_petugas) }}" class="btn btn-warning btn-sm">Edit</a>
                    @if(auth()->guard('petugas')->check() && auth()->guard('petugas')->user()->id_petugas != $p->id_petugas)
                        <form action="{{ route('admin.petugas.destroy', $p->id_petugas) }}" 
                            method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Yakin mau hapus petugas ini?')">
                                Hapus
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $petugas->links() }}
</div>
@endsection
