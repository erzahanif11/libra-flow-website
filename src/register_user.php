<?php
include 'config_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']) ?? '';
    $email = trim($_POST['email']) ?? '';
    $password = trim($_POST['password']) ?? '';
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Semua field harus diisi!";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid!";
        exit;
    }
    
    if ($password !== $confirm_password) {
        echo "Password dan konfirmasi password tidak cocok!";
        exit;
    }
    
    if (strlen($password) < 8) {
        echo "Password minimal 8 karakter!";
        exit;
    }

    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            echo "Username atau email sudah digunakan!";
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashed_password]);

        echo "  Registrasi berhasil! Anda akan diarahkan ke halaman login.";
        header("Refresh: 2; url=login.php");
        exit();
    } catch(PDOException $e) {
        die("Error: " . $e->getMessage());
        exit();
    }
}