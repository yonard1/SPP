@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Data Pembayaran Siswa</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>NISN</th>
                            @foreach ($bulan as $bulanItem)
                                <th>{{ $bulanItem }}</th>
                            @endforeach
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswa as $s)
                            <tr>
                                <td class="fw-semibold text-start ps-4">{{ $s->nama }}</td>
                                <td>{{ $s->nisn }}</td>

                                @php $belumBayarBulan = null; @endphp

                                @foreach ($bulan as $bulanItem)
                                    @php
                                        $status = 'X';
                                        if (isset($pembayaran[$s->nisn])) {
                                            $pembayaranSiswa = $pembayaran[$s->nisn]
                                                ->where('bulan_dibayar', $bulanItem)->first();
                                            if ($pembayaranSiswa) {
                                                $status = 'L';
                                            } elseif (!$belumBayarBulan) {
                                                $belumBayarBulan = $bulanItem;
                                            }
                                        } else {
                                            if (!$belumBayarBulan) $belumBayarBulan = $bulanItem;
                                        }
                                    @endphp

                                    <td>
                                        <span class="badge
                                            {{ $status == 'L' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                @endforeach

                                <td>
                                    @if ($belumBayarBulan)
                                        <form action="{{ route($storeRoute) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="nisn" value="{{ $s->nisn }}">
                                            <input type="hidden" name="bulan_dibayar" value="{{ $belumBayarBulan }}">
                                            <input type="hidden" name="jumlah_bayar" value="{{ $s->spp->nominal }}">
                                            <input type="hidden" name="tgl_bayar" value="{{ now()->toDateString() }}">

                                            <button class="btn btn-primary btn-sm">
                                                Bayar {{ $belumBayarBulan }}
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Lunas</span>
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
