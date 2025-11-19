@extends('layouts.app')

@section('title', 'Data Pembayaran SPP Siswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>📊 Data Pembayaran SPP Siswa</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
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
                            <div class="d-flex flex-wrap gap-1">
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
                        </td>
                        <td>
                            <a href="{{ route('petugas.transaksi.create', $item['siswa']->nisn) }}" class="btn btn-primary btn-sm">
                                💰 Bayar
                            </a>
                            <a href="{{ route('petugas.transaksi.history', $item['siswa']->nisn) }}" class="btn btn-info btn-sm">
                                📜 History
                            </a>
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
</div>
@endsection