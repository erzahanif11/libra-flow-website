<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/login" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Masuk</button>

            <p>Belum punya akun? <a href="/register">Register di sini</a>.</p>
        </form>
    </div>
</body>
</html>