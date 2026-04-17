<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "libra_flow";

try{
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database`");
    echo "Database libra_flow created successfully.<br>";
    
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec("USE `$database`");
    $pdo->exec($sql);
    echo "Table users created successfully.<br>";

    // Insert default admin user
    $defaultAdminPassword = password_hash("admin123", PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute(['admin', 'admin@gmail.com', $defaultAdminPassword, 'admin']);
    echo "<br>Default admin user created successfully.<br>username: admin, password: admin123";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}