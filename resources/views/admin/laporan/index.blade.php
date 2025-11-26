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

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Laporan Pertanggal</h5>
                <form action="{{ route('admin.laporan.pembayaran') }}" method="POST">
                    @csrf
                    <label>Pilih Tanggal</label>
                    <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}">
                    <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}">
                    <button class="btn btn-primary mt-3 w-100">Tampilkan</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
