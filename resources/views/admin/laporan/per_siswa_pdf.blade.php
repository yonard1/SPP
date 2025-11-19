<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran Per Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h3>Laporan Pembayaran - {{ $siswa->nama }} ({{ $siswa->nisn }})</h3>
<p>Kelas: {{ $siswa->kelas->nama_kelas }}</p>

<h4>Status Pembayaran</h4>
<table>
    <thead>
        <tr>
            @foreach($status_pembayaran as $bulan => $status)
                <th>{{ $bulan }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($status_pembayaran as $bulan => $status)
                <td>{{ $status ? 'Lunas' : 'Belum' }}</td>
            @endforeach
        </tr>
    </tbody>
</table>

<h4>Riwayat Pembayaran</h4>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Bulan</th>
            <th>Jumlah</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pembayaran as $p)
        <tr>
            <td>{{ $p->tgl_bayar }}</td>
            <td>{{ $p->bulan_dibayar }}</td>
            <td>Rp {{ number_format($p->jumlah_bayar) }}</td>
            <td>{{ $p->petugas->nama_petugas }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Total Terbayar: Rp {{ number_format($total) }}</h4>

</body>
</html>
