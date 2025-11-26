@extends('layouts.app')

@section('title', 'Pembayaran SPP')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>📋 Data Siswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>NISN</th>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>NIS</th>
                        <td>{{ $siswa->nis }}</td>
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
                        <th>Kompetensi</th>
                        <td>{{ $siswa->kelas->kompetensi_keahlian }}</td>
                    </tr>
                    <tr>
                        <th>SPP/Bulan</th>
                        <td><strong>Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
                <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary btn-sm w-100">↩️ Kembali</a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5>💰 Pilih Bulan Pembayaran</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('petugas.transaksi.store') }}" method="POST" id="formPembayaran">
                    @csrf
                    <input type="hidden" name="nisn" value="{{ $siswa->nisn }}">
                    <input type="hidden" name="bulan_dibayar" id="bulan_dibayar" value="">
                    <input type="hidden" name="tahun_dibayar" value="{{ date('Y') }}">
                    <input type="hidden" name="jumlah_bayar" value="{{ $siswa->spp->nominal }}">
                    <div class="row g-2">
                    @foreach($status_bulan as $bulan => $status)
                    <div class="col-md-3 col-6">
                        @if($status)
                            <button type="button" class="btn btn-success w-100" disabled>
                                <strong>{{ $bulan }}</strong><br>
                                <small>✔️ Lunas</small>
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-primary w-100 btn-bayar" data-bulan="{{ $bulan }}">
                                <strong>{{ $bulan }}</strong><br>
                                <small>Bayar Sekarang</small>
                            </button>
                        @endif
                    </div>
                    @endforeach
                </div>

                <hr>

                <div class="alert alert-info">
                    <strong>ℹ️ Keterangan:</strong><br>
                    <span class="badge bg-success">Hijau</span> = Sudah Lunas<br>
                    <span class="badge bg-primary">Biru</span> = Belum Bayar (Klik untuk bayar)
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
document.querySelectorAll('.btn-bayar').forEach(button => {
    button.addEventListener('click', function() {
        const bulan = this.getAttribute('data-bulan');
        const nominal = {{ $siswa->spp->nominal }};

        if(confirm(`Konfirmasi pembayaran SPP bulan ${bulan}?\nJumlah: Rp ${nominal.toLocaleString('id-ID')}`)) {
            document.getElementById('bulan_dibayar').value = bulan;
            document.getElementById('formPembayaran').submit();
        }
    });
});
</script>
@endsection
