<!DOCTYPE html>
<html>
<head>
    <title>Laporan Per Kelas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h3>Laporan Pembayaran Per Kelas</h3>
<p>Kelas: {{ $kelas->nama_kelas }}</p>

<table>
    <thead>
        <tr>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Bulan Lunas</th>
            <th>Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_siswa as $ds)
        <tr>
            <td>{{ $ds['siswa']->nisn }}</td>
            <td>{{ $ds['siswa']->nama }}</td>
            <td>{{ $ds['bulan_lunas'] }}/12</td>
            <td>Rp {{ number_format($ds['total_bayar']) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
