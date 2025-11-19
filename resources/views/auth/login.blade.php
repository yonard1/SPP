<!DOCTYPE html>
<html>
<head>
    <title>Login Aplikasi SPP</title>
</head>
<body>
    <h2>Login</h2>

    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.attempt') }}" method="POST">
        @csrf

        <label>Username / NISN</label><br>
        <input type="text" name="identity" required><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
