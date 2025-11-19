<!DOCTYPE html>
<html>
<head>
    <title>Laporan Per Siswa</title>
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
        <h2>LAPORAN PEMBAYARAN SPP PER SISWA</h2>
    </div>

    <table style="margin-bottom: 20px;">
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

    <h4>Status Pembayaran per Bulan:</h4>
    <p>
        @foreach($status_pembayaran as $bulan => $status)
            {{ $bulan }}: {{ $status ? '✔️ Lunas' : '✖️ Belum' }} |
        @endforeach
    </p>

    <table>
        <thead>
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
                <td class="text-right">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                <td>{{ $item->petugas->nama_petugas }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">TOTAL:</th>
                <th colspan="2" class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <p style="margin-top: 30px;">Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
</body>
</html>