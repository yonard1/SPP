@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Data SPP</h2>

    <a href="{{ route('admin.spp.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Nominal</th>
                <th>Total Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spp as $row)
            <tr>
                <td>{{ $row->tahun }}</td>
                <td>Rp {{ number_format($row->nominal) }}</td>
                <td>{{ $row->siswa_count }}</td>
                <td>
                    <a href="{{ route('admin.spp.edit', ['spp' => $row->id_spp]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.spp.destroy', ['spp' => $row->id_spp]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin?')" class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $spp->links() }}

</div>
@endsection
