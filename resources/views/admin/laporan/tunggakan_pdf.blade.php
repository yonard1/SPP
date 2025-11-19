<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tunggakan</title>
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
        <h2>LAPORAN TUNGGAKAN PEMBAYARAN SPP</h2>
    </div>

    <table>
        <thead>
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
                <td class="text-right">Rp {{ number_format($item['siswa']->spp->nominal, 0, ',', '.') }}</td>
                <td>{{ $item['bulan_lunas'] }} Bulan</td>
                <td>{{ $item['bulan_belum'] }} Bulan</td>
                <td class="text-right"><strong>Rp {{ number_format($item['total_tunggakan'], 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="text-right">TOTAL TUNGGAKAN:</th>
                <th class="text-right">Rp {{ number_format(collect($data_tunggakan)->sum('total_tunggakan'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 30px;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
</body>
</html>