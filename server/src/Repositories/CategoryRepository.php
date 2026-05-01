<?php

namespace App\Repositories;

use App\Core\Database;
use App\Factories\CategoryFactory;
use App\Models\Category\Category;
use PDO;

class CategoryRepository
{
    private PDO $pdo;

    public function __construct(Database $db)
    {
        $this->pdo = $db->connect(); // Get the PDO instance
    }

    public function findIdByName(string $name): ?int
    {
        $stmt = $this->pdo->prepare('SELECT id FROM categories WHERE name = :name');
        $stmt->execute(['name' => $name]);

        $id = $stmt->fetchColumn();
        return $id ? (int)$id : null;
    }

    public function insert(string $name): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);

        return (int)$this->pdo->lastInsertId();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT id, name FROM categories");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => CategoryFactory::create($row['id'], $row['name']), $rows);
    }

    public function findById(int $id): ?Category
    {
        $stmt = $this->pdo->prepare('
            SELECT id, name
            FROM categories
            WHERE id = :id
            LIMIT 1
        ');

        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? CategoryFactory::create($row['id'], $row['name']) : null;
    }
}