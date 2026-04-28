<?php

require_once __DIR__ . '/../../database/connection.php';

class Book
{
    protected $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM books");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO books (judul, kategori, penulis, status) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['judul'], $data['kategori'], $data['penulis'], $data['status'] ?? 'tersedia']);
    }

    public function update($id, $data)
    {
        $set = [];
        $params = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = ?";
            $params[] = $value;
        }
        $params[] = $id;
        $stmt = $this->pdo->prepare("UPDATE books SET " . implode(', ', $set) . " WHERE id = ?");
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>