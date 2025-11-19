<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi SPP' }}</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background: #f4f6f9;
        }

        /* NAVBAR */
        nav.navbar-custom {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            height: 60px;
            background: #007bff;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 18px;
            z-index: 10;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 230px;
            height: calc(100vh - 60px);
            background: #1f2937;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #374151;
        }

        /* CONTENT */
        .content {
            margin-left: 230px;
            margin-top: 60px;
            padding: 25px;
            width: calc(100% - 230px);
        }

        .logout-btn {
            display: block;
            margin: 20px;
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            width: 85%;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
        }
        
        .logout-btn:hover {
            opacity: 0.8;
        }
    </style>

</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar-custom">
        <span class="fw-bold">Aplikasi SPP</span>
    </nav>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        {{-- ===================== --}}
        {{-- ADMIN MENU --}}
        {{-- ===================== --}}
        @if(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level === 'admin')

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.siswa.index') }}">Data Siswa</a>
            <a href="{{ route('admin.petugas.index') }}">Data Petugas</a>
            <a href="{{ route('admin.kelas.index') }}">Data Kelas</a>
            <a href="{{ route('admin.spp.index') }}">Data SPP</a>
            <a href="{{ route('admin.pembayaran.index') }}">Entri Pembayaran</a>
            <a href="{{ route('admin.pembayaran.history') }}">History Pembayaran</a>
            <a href="{{ route('admin.laporan.index') }}">Laporan</a>

        {{-- ===================== --}}
        {{-- PETUGAS MENU --}}
        {{-- ===================== --}}
        @elseif(Auth::guard('petugas')->check() && Auth::guard('petugas')->user()->level === 'petugas')

            <a href="{{ route('petugas.dashboard') }}">Dashboard</a>
            <a href="{{ route('petugas.pembayaran.index') }}">Entri Pembayaran</a>
            <a href="{{ route('petugas.pembayaran.history') }}">History Pembayaran</a>

        {{-- ===================== --}}
        {{-- SISWA MENU --}}
        {{-- ===================== --}}
        @elseif(Auth::guard('siswa')->check())

            <a href="{{ route('siswa.dashboard') }}">Dashboard</a>
            <a href="{{ route('siswa.history') }}">History Pembayaran</a>

        {{-- ===================== --}}
        {{-- GUEST MENU --}}
        {{-- ===================== --}}
        @else

            <a href="{{ route('login') }}">Login</a>

        @endif

        {{-- Logout --}}
        @if (Auth::guard('petugas')->check() || Auth::guard('siswa')->check())
            <form action="{{ route('logout') }}" method="GET">
                <button class="logout-btn">Logout</button>
            </form>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
