<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required><br>

            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Masuk</button>
        </form>

        <p>Belum punya akun? <a href="/register">Register di sini</a>.</p>
    </div>
</body>
</html>
