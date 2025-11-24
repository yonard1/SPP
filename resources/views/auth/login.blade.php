<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi SPP</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
        }
        .login-card {
            border-radius: 15px;
            overflow: hidden;
        }
        .logo-box {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-box img {
            width: 90px;
            opacity: 0.9;
        }
        .title {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

            <div class="col-md-5">
                <div class="card shadow login-card">
                    <div class="card-body p-5">

                        {{-- LOGO --}}
                        <div class="logo-box">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        </div>

                        <h3 class="text-center mb-4 title">Aplikasi Pembayaran SPP</h3>

                        {{-- ALERTS --}}
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- FORM LOGIN --}}
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Username / NISN / NIS</label>
                                <input 
                                    type="text"
                                    name="username"
                                    class="form-control form-control-lg"
                                    placeholder="Masukkan username / nisn..."
                                    required autofocus
                                >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input 
                                    type="password"
                                    name="password"
                                    class="form-control form-control-lg"
                                    placeholder="Masukkan password..."
                                    required
                                >
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg mt-2">
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
