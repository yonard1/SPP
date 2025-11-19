<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Per Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h3>LAPORAN PEMBAYARAN SPP PER KELAS</h3>
            <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }} - {{ $kelas->kompetensi_keahlian }}</p>
        </div>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>SPP/Bulan</th>
                    <th>Bulan Lunas</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_siswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['siswa']->nisn }}</td>
                    <td>{{ $item['siswa']->nama }}</td>
                    <td>Rp {{ number_format($item['siswa']->spp->nominal, 0, ',', '.') }}</td>
                    <td>{{ $item['bulan_lunas'] }} / 12 Bulan</td>
                    <td>Rp {{ number_format($item['total_bayar'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-secondary">
                    <th colspan="5" class="text-end">TOTAL:</th>
                    <th>Rp {{ number_format(collect($data_siswa)->sum('total_bayar'), 0, ',', '.') }}</th>
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
```

### `resources/views/admin/laporan/per_kelas_pdf.blade.php`
```blade
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Per Kelas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="text-center">
        <h2>LAPORAN PEMBAYARAN SPP PER KELAS</h2>
        <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }} - {{ $kelas->kompetensi_keahlian }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>SPP/Bulan</th>
                <th>Bulan Lunas</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_siswa as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['siswa']->nisn }}</td>
                <td>{{ $item['siswa']->nama }}</td>
                <td class="text-right">Rp {{ number_format($item['siswa']->spp->nominal, 0, ',', '.') }}</td>
                <td>{{ $item['bulan_lunas'] }} / 12 Bulan</td>
                <td class="text-right">Rp {{ number_format($item['total_bayar'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL:</th>
                <th class="text-right">Rp {{ number_format(collect($data_siswa)->sum('total_bayar'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 30px;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
</body>
</html>