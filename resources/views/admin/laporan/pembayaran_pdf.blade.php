<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h3>Laporan Pembayaran</h3>
<p>Periode: {{ $dari }} - {{ $sampai }}</p>

<table>
    <thead>
        <tr>
            <th>Tgl Bayar</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayaran as $p)
        <tr>
            <td>{{ $p->tgl_bayar }}</td>
            <td>{{ $p->nisn }}</td>
            <td>{{ $p->siswa->nama }}</td>
            <td>{{ $p->siswa->kelas->nama_kelas }}</td>
            <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Total Pemasukan: Rp {{ number_format($total) }}</h4>

</body>
</html>
