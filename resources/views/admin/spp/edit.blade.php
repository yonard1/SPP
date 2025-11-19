@extends('layouts.app')

@section('title', 'Edit SPP')

@section('content')
<div class="container mt-4">
    <h2>Edit Data SPP</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.spp.update', $spp->id_spp) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" id="tahun" class="form-control" value="{{ old('tahun', $spp->tahun) }}" required>
        </div>

        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal</label>
            <input type="number" name="nominal" id="nominal" class="form-control" value="{{ old('nominal', $spp->nominal) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.spp.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
