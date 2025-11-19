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

        <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary">↩️ Kembali</a>
        <a href="{{ route('petugas.transaksi.create', $siswa->nisn) }}" class="btn btn-primary">💰 Bayar Lagi</a>
    </div>
</div>
@endsection
```

---

## 📁 5. VIEWS LAPORAN ADMIN

### `resources/views/admin/laporan/index.blade.php`
```blade
@extends('layouts.app')

@section('title', 'Generate Laporan')

@section('content')
<div class="row">
    <!-- Laporan Pembayaran Per Periode -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>📅 Laporan Pembayaran Per Periode</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.laporan.pembayaran') }}" method="POST" target="_blank">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">🖥️ Lihat Laporan</button>
                    <button type="submit" formaction="{{ route('admin.laporan.pembayaran.pdf') }}" class="btn btn-danger w-100 mt-2">📄 Download PDF</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Laporan Per Siswa -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5>👤 Laporan Per Siswa</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.laporan.per_siswa') }}" method="POST" target="_blank">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Siswa</label>
                        <select name="nisn" class="form-select" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswa as $s)
                                <option value="{{ $s->nisn }}">{{ $s->nisn }} - {{ $s->nama }} ({{ $s->kelas->nama_kelas }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">🖥️ Lihat Laporan</button>
                    <button type="submit" formaction="{{ route('admin.laporan.per_siswa.pdf') }}" class="btn btn-danger w-100 mt-2">📄 Download PDF</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Laporan Per Kelas -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h5>🏫 Laporan Per Kelas</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.laporan.per_kelas') }}" method="POST" target="_blank">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Pilih Kelas</label>
                        <select name="id_kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id_kelas }}">{{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">🖥️ Lihat Laporan</button>
                    <button type="submit" formaction="{{ route('admin.laporan.per_kelas.pdf') }}" class="btn btn-danger w-100 mt-2">📄 Download PDF</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Laporan Tunggakan -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5>⚠️ Laporan Tunggakan</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Laporan siswa yang memiliki tunggakan pembayaran SPP</p>
                <a href="{{ route('admin.laporan.tunggakan') }}" target="_blank" class="btn btn-danger w-100">🖥️ Lihat Laporan</a>
                <a href="{{ route('admin.laporan.tunggakan.pdf') }}" class="btn btn-dark w-100 mt-2">📄 Download PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection
```

### `resources/views/admin/laporan/pembayaran.blade.php`
```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>LAPORAN PEMBAYARAN SPP</h3>
            <p>Periode: {{ date('d/m/Y', strtotime($dari)) }} - {{ date('d/m/Y', strtotime($sampai)) }}</p>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Bulan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembayaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->tgl_bayar)) }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->siswa->kelas->nama_kelas }}</td>
                    <td>{{ $item->bulan_dibayar }}</td>
                    <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="6" class="text-end">TOTAL:</th>
                    <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4">
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
            <button onclick="window.close()" class="btn btn-secondary">✖️ Tutup</button>
        </div>
    </div>
</body>
</html>