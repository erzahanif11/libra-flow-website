<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Register</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required><br>

            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="password_confirmation">Confirm Password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>

            <button type="submit">Daftar</button>
        </form>

        <p>Sudah punya akun? <a href="/login">Login di sini</a>.</p>
    </div>
</body>
</html>
