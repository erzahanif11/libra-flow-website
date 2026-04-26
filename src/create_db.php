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
    
    // Tabel Users
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

    // Tabel Books
    $sql = "CREATE TABLE IF NOT EXISTS books (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        judul VARCHAR(255) NOT NULL,
        kategori VARCHAR(100),
        penulis VARCHAR(100),
        status ENUM('tersedia', 'dipinjam') DEFAULT 'tersedia',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table books created successfully.<br>";

    // Tabel Book_Relations (Flow Linear)
    $sql = "CREATE TABLE IF NOT EXISTS book_relations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    book_id INT UNSIGNED NOT NULL,
    next_book_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (next_book_id) REFERENCES books(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Table book_relations created successfully.<br>";

    // Tabel Borrowing
    $sql = "CREATE TABLE IF NOT EXISTS borrowing (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        book_id INT UNSIGNED NOT NULL,
        tanggal_pinjam DATE NOT NULL,
        tanggal_kembali DATE NOT NULL,
        status ENUM('dipinjam', 'dikembalikan') DEFAULT 'dipinjam',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Table borrowing created successfully.<br>";

    // Tabel Wishlist
    $sql = "CREATE TABLE IF NOT EXISTS wishlist (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        book_id INT UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE (user_id, book_id),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Table wishlist created successfully.<br>";

    // Tabel Denda
    $sql = "CREATE TABLE IF NOT EXISTS denda (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        borrowing_id INT UNSIGNED NOT NULL,
        jumlah_denda INT NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (borrowing_id) REFERENCES borrowing(id) ON DELETE CASCADE
    )";
    $pdo->exec($sql);
    echo "Table denda created successfully.<br>";

    // Insert default admin user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute(['admin']);

    if ($stmt->rowCount() == 0) {
        $defaultAdminPassword = password_hash("admin123", PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute(['admin', 'admin@gmail.com', $defaultAdminPassword, 'admin']);
         echo "<br>Default admin user created successfully.<br>username: admin, password: admin123";
    }
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}