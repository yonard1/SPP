@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-3">Daftar Transaksi</h3>

    {{-- Filter --}}
    <form method="GET" class="mb-4 d-flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama siswa / kasir...">
        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control">

        <button class="btn btn-primary">Cari</button>
        <a href="{{ route('admin.transaksi.global') }}" class="btn btn-secondary">Reset</a>
    </form>

    {{-- Table --}}
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Siswa</th>
                        <th>Bulan Dibayar</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pembayaran as $i => $p)
                    <tr>
                        <td>{{ $pembayaran->firstItem() + $i }}</td>
                        <td>{{ date('Y-m-d', strtotime($p->tgl_bayar)) }}</td>
                        <td>{{ $p->petugas->nama_petugas ?? '-' }}</td>
                        <td>{{ $p->siswa->nama }}</td>
                        <td>{{ $p->bulan_dibayar }} {{ $p->tahun_dibayar }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                        <td><a href="{{ route('admin.transaksi.history', $p->nisn) }}" class="btn btn-info btn-sm">Detail</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-3">Tidak ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pembayaran->links() }}
    </div>

</div>
@endsection
