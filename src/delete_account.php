<?php

session_start();

include 'config_db.php';

$id = $_SESSION['user_id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id=:id");
$stmt->bindParam(':id', $id);
if($stmt->execute()){
    session_destroy();
    echo "Akun berhasil dihapus! <a href='register.php'>Daftar</a>";
} else {
    echo "Gagal menghapus akun.";
}