@extends('layouts.app')
@section('title', 'Laporan Pembayaran')
@section('content')
<div class="container">
    <div class="row">

        {{-- Laporan per kelas --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Laporan Per Kelas</h5>
                <form action="{{ route('admin.laporan.kelas') }}" method="POST">
                    @csrf
                    <label>Pilih Kelas</label>
                    <select name="id_kelas" class="form-control" required>
                        @foreach(App\Models\Kelas::all() as $kelas)
                            <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary mt-3 w-100">Tampilkan</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
