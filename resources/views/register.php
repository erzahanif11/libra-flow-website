<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form action="/register" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <label for="confirm_password">Konfirmasi Password:</label><br>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <button type="submit">Daftar</button>

            <p>Sudah punya akun? <a href="/login">Login di sini</a>.</p>
        </form>
    </div>
</body>
</html>