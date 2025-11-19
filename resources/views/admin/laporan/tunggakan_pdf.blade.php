<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tunggakan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h3>Laporan Tunggakan SPP</h3>

<table>
    <thead>
        <tr>
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Bulan Belum Bayar</th>
            <th>Total Tunggakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data_tunggakan as $dt)
        <tr>
            <td>{{ $dt['siswa']->nisn }}</td>
            <td>{{ $dt['siswa']->nama }}</td>
            <td>{{ $dt['siswa']->kelas->nama_kelas }}</td>
            <td>{{ $dt['bulan_belum'] }}</td>
            <td>Rp {{ number_format($dt['total_tunggakan']) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
