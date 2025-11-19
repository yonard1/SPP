<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Per Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>LAPORAN PEMBAYARAN SPP PER SISWA</h3>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <table class="table table-bordered">
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
                    <tr>
                        <th>SPP/Bulan</th>
                        <td>Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5>Status Pembayaran per Bulan:</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($status_pembayaran as $bulan => $status)
                        @if($status)
                            <span class="badge bg-success">{{ $bulan }} ✔️</span>
                        @else
                            <span class="badge bg-danger">{{ $bulan }} ✖️</span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <table class="table table-bordered">
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
                @foreach($pembayaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d/m/Y', strtotime($item->tgl_bayar)) }}</td>
                    <td>{{ $item->bulan_dibayar }}</td>
                    <td>{{ $item->tahun_dibayar }}</td>
                    <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ $item->petugas->nama_petugas }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="4" class="text-end">TOTAL:</th>
                    <th colspan="2">Rp {{ number_format($total, 0, ',', '.') }}</th>
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