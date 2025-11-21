<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi SPP</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- STYLE -->
    <style>
        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins/Poppins-Regular.ttf') format('truetype');
            font-weight: 400;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins/Poppins-SemiBold.ttf') format('truetype');
            font-weight: 600;
        }

        body {
            background: #f7f7fb;
            font-family: "Poppins", sans-serif;
            margin: 0; /* penting */
            padding: 0; /* penting */
        }

        /* ICON AUTO COLOR */
        .icon-sm {
            width: 18px;
            height: 18px;
            filter: brightness(0) saturate(100%);
            transition: .25s;
        }

        .menu-item:hover .icon-sm,
        .menu-item.active .icon-sm {
            filter: invert(22%) sepia(95%) saturate(7500%) hue-rotate(258deg) brightness(88%) contrast(102%);
        }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 14px 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 240px; /* topbar dimulai setelah sidebar */
            width: calc(100% - 240px); /* sisanya layar */
            height: 60px;
            z-index: 50;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-title {
            font-weight: 700;
            font-size: 20px;
            color: #4b04d9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #fff;
            position: fixed;
            top: 0; /* sekarang mentok atas */
            left: 0;
            height: 100vh; /* full height */
            border-right: 1px solid #eee;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            height: 90px;
            min-height: 90px;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .logo-img {
            max-height: 55px;
            width: auto;
            object-fit: contain;
        }

        .sidebar-menu {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            display: block;
        }

        .menu-section-title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            color: #888;
            margin: 18px 24px 6px;
            letter-spacing: .5px;
        }

        .menu-item {
            padding: 13px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555;
            font-weight: 500;
            transition: .25s;
        }

        .menu-item:hover {
            background: #f1efff;
            color: #4b04d9;
            transform: translateX(5px);
        }

        .menu-item.active {
            background: #ece8ff;
            color: #4b04d9 !important;
            font-weight: 600;
        }

        /* CONTENT */
        .content-wrapper {
            margin-left: 260px;
            margin-top: 80px;
            padding: 30px;
        }

        h2.page-title {
            font-weight: 700;
            color: #333;
        }

        .btn-indigo {
            background: #5b23e7;
            color: #fff;
            border-radius: 10px;
            padding: 8px 18px;
        }

        .btn-indigo:hover {
            background: #4b04d9;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo.png') }}" class="logo-img">
        </div>

        <div class="sidebar-menu">
            @if(session('role') === 'admin')
                <div class="menu-section-title">Main Menu</div>

                <a href="{{ route('admin.dashboard') }}">
                    <div class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <img src="{{ asset('icons/home.svg') }}" class="icon-sm"> Dashboard
                    </div>
                </a>

                <div class="menu-section-title">Master Data</div>

                <a href="{{ route('admin.siswa.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/users.svg') }}" class="icon-sm"> Data Siswa
                    </div>
                </a>

                <a href="{{ route('admin.petugas.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/badge-check.svg') }}" class="icon-sm"> Data Petugas
                    </div>
                </a>

                <a href="{{ route('admin.kelas.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/school.svg') }}" class="icon-sm"> Data Kelas
                    </div>
                </a>

                <a href="{{ route('admin.spp.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.spp.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/receipt.svg') }}" class="icon-sm"> Data SPP
                    </div>
                </a>

                <div class="menu-section-title">Transaksi</div>

                <a href="{{ route('admin.transaksi.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/wallet.svg') }}" class="icon-sm"> Pembayaran
                    </div>
                </a>

                <a href="{{ route('admin.transaksi.global') }}">
                    <div class="menu-item {{ request()->routeIs('admin.transaksi.global') ? 'active' : '' }}">
                        <img src="{{ asset('icons/history.svg') }}" class="icon-sm"> History Pembayaran
                    </div>
                </a>

                <div class="menu-section-title">Laporan</div>

                <a href="{{ route('admin.laporan.index') }}">
                    <div class="menu-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/bar-chart-3.svg') }}" class="icon-sm"> Laporan Pembayaran
                    </div>
                </a>
            @endif

            @if(session('role') === 'petugas')
                <div class="menu-section-title">Menu Petugas</div>

                <a href="{{ route('petugas.dashboard') }}">
                    <div class="menu-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                        <img src="{{ asset('icons/home.svg') }}" class="icon-sm"> Dashboard
                    </div>
                </a>

                <a href="{{ route('petugas.transaksi.index') }}">
                    <div class="menu-item {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/wallet.svg') }}" class="icon-sm"> Pembayaran
                    </div>
                </a>

                <a href="{{ route('petugas.transaksi.history.petugas') }}">
                    <div class="menu-item {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                        <img src="{{ asset('icons/history.svg') }}" class="icon-sm"> History
                    </div>
                </a>
            @endif

            @if(session('role') === 'siswa')
                <div class="menu-section-title">Menu Siswa</div>

                <a href="{{ route('siswa.dashboard') }}">
                    <div class="menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        <img src="{{ asset('icons/home.svg') }}" class="icon-sm"> Dashboard
                    </div>
                </a>

                <a href="{{ route('siswa.transaksi.history') }}">
                    <div class="menu-item {{ request()->routeIs('siswa.history') ? 'active' : '' }}">
                        <img src="{{ asset('icons/history.svg') }}" class="icon-sm"> History Pembayaran
                    </div>
                </a>
            @endif

        </div>
    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="top-title">Aplikasi SPP</div>

        <div class="d-flex align-items-center gap-3">
            <span class="fw-semibold">{{ session('nama') }} | {{ ucfirst(session('role')) }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                    <img src="{{ asset('icons/log-out.svg') }}" class="icon-sm"> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">
        <h2 class="page-title mb-3">@yield('title')</h2>
        <div>@yield('content')</div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
