<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title')</title>

    <!-- Local Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <style>
        body {
            background: #f5f6fa;
        }
        .sidebar {
            height: 100vh;
            width: 230px;
            background: #2c3e50;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover, .sidebar .active {
            background: #1abc9c;
            color: #fff;
        }
        .content {
            margin-left: 230px;
            padding: 20px;
        }
        .navbar-custom {
            background: #34495e;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center text-white">ADMIN PANEL</h4>
        <hr class="text-white">

        <a href="{{ route('admin.kelas.index') }}" class="{{ request()->is('admin/kelas*') ? 'active' : '' }}">📚 Kelas</a>
        <a href="{{ route('admin.petugas.index') }}" class="{{ request()->is('admin/petugas*') ? 'active' : '' }}">👮 Petugas</a>
        <a href="{{ route('admin.siswa.index') }}" class="{{ request()->is('admin/siswa*') ? 'active' : '' }}">👨‍🎓 Siswa</a>
        <a href="{{ route('admin.spp.index') }}" class="{{ request()->is('admin/spp*') ? 'active' : '' }}">💸 SPP</a>

        <hr class="text-white">

        <a href="/logout" onclick="return confirm('Yakin ingin logout?')">🚪 Logout</a>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">Dashboard Admin</span>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Local JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
