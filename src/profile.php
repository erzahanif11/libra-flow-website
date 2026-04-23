<?php

session_start();

include 'config_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_POST['update_username'])){
    $username=$_POST['username'];
    $id= $_SESSION['user_id'];

    $stmt= $pdo->prepare("UPDATE users SET username=:username WHERE id=:id");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $_SESSION['username']=$username;
    echo "Username berhasil diubah!";
}

if(isset($_POST['update_email'])){
    $email=$_POST['email'];
    $id= $_SESSION['user_id'];

    $stmt= $pdo->prepare("UPDATE users SET email=:email WHERE id=:id");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $_SESSION['email']=$email;
    echo "Email berhasil diubah!";
}

if(isset($_POST['update_password'])){
    $password_old=$_POST['password_old'];
    $password_new=$_POST['password_new'];
    $id=$_SESSION['user_id'];

    $stmt=$pdo->prepare("SELECT password FROM users WHERE id=:id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password_old, $user['password'])){
        $password_new_hashed=password_hash($password_new, PASSWORD_DEFAULT);
        $stmt=$pdo->prepare("UPDATE users SET password=:password WHERE id=:id");
        $stmt->bindParam(':password', $password_new_hashed);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "Password berhasil diubah!";
    }else{
        echo "Gagal ubah password!";
    }
}

if(isset($_POST['delete'])){
    header("LOCATION: delete_account.php");
}

if(isset($_POST['logout'])){
    header("LOCATION: logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <form method="POST">
        <h3>Update Username</h3>
        Ubah username: <input type="text" name="username" value="<?php echo $_SESSION['username']; ?>"><br>
        <button name="update_username">Update</button>
    </form>
    <br>

    <form method="POST">
        <h3>Update Email</h3>
        Ubah email: <input type="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"><br>
        <button name="update_email">Update</button>
    </form>
    <br>

    <form method="POST">
        <h3>Update Password</h3>
        Masukkan password lama: <input type="password" name="password_old"><br>
        Masukkan password baru: <input type="password" name="password_new"><br>
        <button name="update_password">Update</button>
    </form>
    <br>

    <form method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus akun?')">
        <button name="delete">Hapus Akun</button>
    </form>
    <br>

    <form method="POST" onsubmit="return confirm('Apakah yakin ingin logout?')">
        <button name="logout">Logout</button>
    </form>
</body>
</html>