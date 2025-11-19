@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Pembayaran SPP - {{ $siswa->nama }}</h4>
        </div>

        <div class="card-body">

            <!-- Informasi Siswa -->
            <div class="mb-4">
                <h5 class="fw-bold">Informasi Siswa</h5>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <th>Nominal SPP</th>
                        <td>Rp{{ number_format($siswa->spp->nominal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>

            <h5 class="fw-bold">Pembayaran Per Bulan</h5>

            <div class="table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Bulan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bulan as $b)
                            @php
                                $sudahBayar = $pembayaran->where('bulan_dibayar', $b)->first();
                            @endphp

                            <tr>
                                <td class="text-start ps-3">{{ $b }}</td>

                                <td>
                                    <span class="badge {{ $sudahBayar ? 'bg-success' : 'bg-danger' }}">
                                        {{ $sudahBayar ? 'Lunas' : 'Belum' }}
                                    </span>
                                </td>

                                <td>
                                    @if (!$sudahBayar)
                                        <!-- Tombol Bayar Aktif -->
                                        <form action="{{ route($storeRoute) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                                            <input type="hidden" name="bulan_dibayar" value="{{ $b }}">
                                            <input type="hidden" name="jumlah_bayar" value="{{ $siswa->spp->nominal }}">
                                            <input type="hidden" name="tgl_bayar" value="{{ now()->toDateString() }}">

                                            <button class="btn btn-primary btn-sm">
                                                Bayar {{ $b }}
                                            </button>
                                        </form>
                                    @else
                                        <!-- Tombol Mati Jika Lunas -->
                                        <button class="btn btn-success btn-sm" disabled>
                                            ✔ Lunas
                                        </button>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
