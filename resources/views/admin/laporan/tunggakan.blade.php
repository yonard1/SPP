<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Tunggakan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>LAPORAN TUNGGAKAN PEMBAYARAN SPP</h3>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>SPP/Bulan</th>
                    <th>Bulan Lunas</th>
                    <th>Bulan Belum</th>
                    <th>Total Tunggakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_tunggakan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['siswa']->nisn }}</td>
                    <td>{{ $item['siswa']->nama }}</td>
                    <td>{{ $item['siswa']->kelas->nama_kelas }}</td>
                    <td>Rp {{ number_format($item['siswa']->spp->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item['bulan_lunas'] }} Bulan</td>
                    <td>{{ $item['bulan_belum'] }} Bulan</td>
                    <td><strong>Rp {{ number_format($item['total_tunggakan'], 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-danger">
                    <th colspan="7" class="text-end">TOTAL TUNGGAKAN:</th>
                    <th>Rp {{ number_format(collect($data_tunggakan)->sum('total_tunggakan'), 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4">
            <button onclick="window.print()" class="btn btn-primary">🖨️ Print</button>
            <button onclick="window.close()" class="btn btn-secondary">✖️ Tutup</button>
        </div>
    </div>
</div>
</body>
</html>