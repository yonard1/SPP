@extends('layouts.app')

@section('content')
<style>
.bulan-grid {
        display: grid;
        grid-template-columns: repeat(6, auto); /* 6 kolom */
        gap: 4px;
        align-items: center;
    }
</style>

<h3 class="mb-4">📊 Data Pembayaran SPP Siswa</h3>

{{-- Search --}}
<form method="GET" class="mb-3">
    <div class="input-group" style="max-width: 350px;">
        <input type="text" name="search" value="{{ request('search') }}"
            class="form-control" placeholder="Cari nama, NISN, atau kelas...">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

{{-- Tabel --}}
<div class="table-responsive d-flex justify-content-center">
    <div style="max-width: 900px; width: 100%;"> 
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Status Pembayaran (12 Bulan)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data_siswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['siswa']->nisn }}</td>
                    <td>{{ $item['siswa']->nama }}</td>
                    <td>{{ $item['siswa']->kelas->nama_kelas }}</td>
                    <td>
                        <div>
                            <div class="bulan-grid">
                                @foreach($item['status_bulan'] as $bulan => $status)
                                    @if($status)
                                        <span class="badge bg-success" title="{{ $bulan }}">{{ substr($bulan, 0, 3) }}</span>
                                    @else
                                        <span class="badge bg-danger" title="{{ $bulan }}">{{ substr($bulan, 0, 3) }}</span>
                                    @endif
                                @endforeach
                            </div>

                            <small class="text-muted">
                                Lunas: {{ $item['total_lunas'] }} | Belum: {{ $item['total_belum'] }}
                            </small>
                        </div>
                        <small class="text-muted">
                            Lunas: {{ $item['total_lunas'] }} | Belum: {{ $item['total_belum'] }}
                        </small>
                    </td>
                    <td>
                        <a href="{{ route('admin.transaksi.create', $item['siswa']->nisn) }}" class="btn btn-primary btn-sm">💰 Bayar</a>

                        <a href="{{ route('admin.transaksi.history', $item['siswa']->nisn) }}" class="btn btn-info btn-sm">📜 History</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Tidak ada data siswa</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
