<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi SPP</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .sidebar { min-height: calc(100vh - 56px); background-color: #f8f9fa; }
        .list-group-item { border-radius: 0; border-left: 3px solid transparent; }
        .list-group-item:hover { background-color: #e9ecef; border-left-color: #0d6efd; }
        .list-group-item.active { background-color: #0d6efd; color: white; border-left-color: #0a58ca; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🏫 Aplikasi SPP</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">
                    {{ session('nama') }} | <strong>{{ ucfirst(session('role')) }}</strong>
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">🚪 Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar p-0">
                <div class="list-group list-group-flush">
                    @if(session('role') == 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            🏠 Dashboard
                        </a>

                        <a href="{{ route('admin.transaksi.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                            💰 Transaksi Pembayaran
                        </a>

                        <a href="{{ route('admin.laporan.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            📊 Laporan
                        </a>

                        <a href="{{ route('admin.siswa.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                            👥 Data Siswa
                        </a>

                        <a href="{{ route('admin.petugas.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                            👔 Data Petugas
                        </a>

                        <a href="{{ route('admin.kelas.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                            🏫 Data Kelas
                        </a>

                        <a href="{{ route('admin.spp.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('admin.spp.*') ? 'active' : '' }}">
                            💵 Data SPP
                        </a>

                    @elseif(session('role') == 'petugas')

                        <a href="{{ route('petugas.dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                            🏠 Dashboard
                        </a>

                        <a href="{{ route('petugas.transaksi.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                            💰 Transaksi Pembayaran
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                            🏠 Dashboard
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-10 p-4">
                <h2 class="mb-3">@yield('title')</h2>
                <hr>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>