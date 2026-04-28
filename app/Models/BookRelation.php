<?php

namespace App\Models;
require_once __DIR__ . '/../../database/connection.php';

class BookRelation
{
    protected $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM book_relations");
        return $stmt->fetchAll();
    }

    public function findByBook($bookId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book_relations WHERE book_id = ?");
        $stmt->execute([$bookId]);
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO book_relations (book_id, next_book_id) VALUES (?, ?)");
        return $stmt->execute([$data['book_id'], $data['next_book_id']]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM book_relations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>