@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Pembayaran</h2>

    <div class="row">

        {{-- Laporan pembayaran per rentang tanggal --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Laporan Pembayaran (Rentang Tanggal)</h5>
                <form action="{{ route('admin.laporan.pembayaran') }}" method="POST">
                    @csrf
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari_tanggal" class="form-control" required>

                    <label class="mt-2">Sampai Tanggal</label>
                    <input type="date" name="sampai_tanggal" class="form-control" required>

                    <button class="btn btn-primary mt-3 w-100">Tampilkan</button>
                </form>
            </div>
        </div>

        {{-- Laporan per siswa --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Laporan Per Siswa</h5>
                <form action="{{ route('admin.laporan.siswa') }}" method="POST">
                    @csrf
                    <label>NISN</label>
                    <input type="text" name="nisn" class="form-control" required>
                    <button class="btn btn-primary mt-3 w-100">Tampilkan</button>
                </form>
            </div>
        </div>

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

    <div class="row mt-4">

        {{-- Tunggakan --}}
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Laporan Tunggakan</h5>
                <a href="{{ route('admin.laporan.tunggakan') }}" class="btn btn-warning w-100">Tampilkan</a>
            </div>
        </div>

    </div>
</div>
@endsection
