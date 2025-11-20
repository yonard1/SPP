<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Aplikasi SPP</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Custom Styles -->
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
        }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 14px 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
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
            height: 100vh;
            position: fixed;
            top: 60px;
            left: 0;
            border-right: 1px solid #eee;
            padding-top: 10px;
            overflow-y: auto;
        }

        .sidebar a{
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
            padding: 30px;
        }

        h2.page-title {
            font-weight: 700;
            color: #333;
        }

        /* BUTTONS */
        .btn-indigo {
            background: #5b23e7;
            color: #fff;
            border-radius: 10px;
            padding: 8px 18px;
            border: none;
        }

        .btn-indigo:hover {
            background: #4b04d9;
        }
    </style>
</head>

<body>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="top-title">Aplikasi SPP</div>

        <div class="d-flex align-items-center gap-3">
            <span class="fw-semibold">{{ session('nama') }} | {{ ucfirst(session('role')) }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                    <i data-lucide="log-out"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">

        @if(session('role') == 'admin')

            <!-- MAIN -->
            <div class="menu-section-title">Main Menu</div>

            <a href="{{ route('admin.dashboard') }}">
                <div class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="home"></i> Dashboard
                </div>
            </a>

            <!-- MASTER DATA -->
            <div class="menu-section-title">Master Data</div>

            <a href="{{ route('admin.siswa.index') }}">
                <div class="menu-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i data-lucide="users"></i> Data Siswa
                </div>
            </a>

            <a href="{{ route('admin.petugas.index') }}">
                <div class="menu-item {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
                    <i data-lucide="badge-check"></i> Data Petugas
                </div>
            </a>

            <a href="{{ route('admin.kelas.index') }}">
                <div class="menu-item {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                    <i data-lucide="school"></i> Data Kelas
                </div>
            </a>

            <a href="{{ route('admin.spp.index') }}">
                <div class="menu-item {{ request()->routeIs('admin.spp.*') ? 'active' : '' }}">
                    <i data-lucide="receipt"></i> Data SPP
                </div>
            </a>

            <!-- TRANSAKSI -->
            <div class="menu-section-title">Transaksi</div>

            <a href="{{ route('admin.transaksi.index') }}">
                <div class="menu-item {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                    <i data-lucide="wallet"></i> Pembayaran
                </div>
            </a>

            <a href="{{ route('admin.transaksi.global') }}">
                <div class="menu-item {{ request()->routeIs('admin.transaksi.historyAll') ? 'active' : '' }}">
                    <i data-lucide="history"></i> History Pembayaran
                </div>
            </a>

            <!-- LAPORAN -->
            <div class="menu-section-title">Laporan</div>

            <a href="{{ route('admin.laporan.index')  }}">
                <div class="menu-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <i data-lucide="bar-chart-3"></i> Laporan Pembayaran
                </div>
            </a>


        @elseif(session('role') == 'petugas')

            <div class="menu-section-title">Main Menu</div>

            <a href="{{ route('petugas.dashboard') }}">
                <div class="menu-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}">
                    <i data-lucide="home"></i> Dashboard
                </div>
            </a>

            <div class="menu-section-title">Transaksi</div>

            <a href="{{ route('petugas.transaksi.index') }}">
                <div class="menu-item {{ request()->routeIs('petugas.transaksi.*') ? 'active' : '' }}">
                    <i data-lucide="wallet"></i> Pembayaran
                </div>
            </a>

            {{-- <a href="{{ route('petugas.transaksi.history', session('id_petugas')) }}">
                <div class="menu-item {{ request()->routeIs('petugas.transaksi.history') ? 'active' : '' }}">
                    <i data-lucide="history"></i> History Transaksi Saya
                </div>
            </a> --}}

        @else

            <div class="menu-section-title">Main Menu</div>

            <a href="{{ route('siswa.dashboard') }}">
                <div class="menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                    <i data-lucide="home"></i> Dashboard
                </div>
            </a>

            {{-- <a href="{{ route('siswa.transaksi.index') }}">
                <div class="menu-item {{ request()->routeIs('siswa.transaksi.*') ? 'active' : '' }}">
                    <i data-lucide="history"></i> History Pembayaran
                </div>
            </a> --}}

        @endif

    </div>

    <!-- CONTENT -->
    <div class="content-wrapper">
        <h2 class="page-title mb-3">@yield('title')</h2>
        <div>@yield('content')</div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Lucide Init -->
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
