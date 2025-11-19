@extends('layouts.app')

@section('title', 'History Pembayaran')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <h5>📜 History Pembayaran - {{ $siswa->nama }}</h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th>NISN</th>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $siswa->kelas->nama_kelas }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Petugas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayaran as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($item->tgl_bayar)) }}</td>
                        <td>{{ $item->bulan_dibayar }}</td>
                        <td>{{ $item->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                        <td>{{ $item->petugas->nama_petugas }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada transaksi pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <th colspan="4" class="text-end">Total Pembayaran:</th>
                        <th colspan="2">Rp {{ number_format($pembayaran->sum('jumlah_bayar'), 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">↩️ Kembali</a>
        <a href="{{ route('admin.transaksi.create', $siswa->nisn) }}" class="btn btn-primary">💰 Bayar Lagi</a>
    </div>
</div>
@endsection