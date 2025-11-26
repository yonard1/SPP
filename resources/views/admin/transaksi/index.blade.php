@extends('layouts.app')
@section('title', 'Transaksi SPP')
@section('content')
<style>
.bulan-grid {
    display: grid;
    grid-template-columns: repeat(6, auto);
    gap: 4px;
    align-items: center;
}

/* Bikin tabel lebih gede & tulisan lebih nyaman */
.table-container {
    max-width: 1200px;
    width: 100%;
    margin: auto;
}

.table td, .table th {
    padding: 10px !important; /* Perbesar padding */
    font-size: 15px; /* Perbesar tulisan */
}

.badge {
    padding: 6px 10px !important;
    font-size: 13px !important;
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
    <div class="table-container">
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead class="table-dark">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="width: 120px;">NISN</th>
                    <th style="width: 200px;">Nama</th>
                    <th style="width: 150px;">Kelas</th>
                    <th>Status Pembayaran (12 Bulan)</th>
                    <th style="width: 100px;">Aksi</th>
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

                            <small class="text-muted d-block mt-1">
                                Lunas: {{ $item['total_lunas'] }} | Belum: {{ $item['total_belum'] }}
                            </small>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.transaksi.create', $item['siswa']->nisn) }}" class="btn btn-primary btn-sm">💰 Bayar</a>
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
