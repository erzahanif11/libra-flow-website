<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <form method="POST" action="/profile">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <h3>Update Username</h3>
        Ubah username: <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>"><br>
        <button name="update_username">Update</button>
    </form>
    <br>

    <form method="POST" action="/profile">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <h3>Update Email</h3>
        Ubah email: <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br>
        <button name="update_email">Update</button>
    </form>
    <br>

    <form method="POST" action="/profile">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <h3>Update Password</h3>
        Masukkan password lama: <input type="password" name="password_old"><br>
        Masukkan password baru: <input type="password" name="password_new"><br>
        <button name="update_password">Update</button>
    </form>
    <br>

    <form method="POST" action="/profile">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <button name="logout">Logout</button>
    </form>
    <br>

    <form method="POST" action="/profile">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <button name="delete">Delete Account</button>
    </form>
</body>
</html>