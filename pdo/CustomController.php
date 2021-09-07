<?php

namespace Zeroyukiy\Prova;

use PDO;

class CustomController
{
    private PDO $pdo;

    public function __construct(PDO $db)
    {
        $this->pdo = $db;
    }

    public function create(string $name): void
    {
        $sql = 'INSERT INTO publishers(name) VALUES (:name)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => $name]);

        $publisher_id = $this->pdo->lastInsertId();

        echo 'The publisher id ' . $publisher_id . ' was inserted.';
    }

    public function show(int $id): array
    {
        $sql = 'SELECT * FROM publishers WHERE publisher_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all(): array
    {
        $sql = 'SELECT * FROM publishers';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function edit(int $id, array $request): void
    {
        $sql = 'UPDATE publishers SET name = :name WHERE publisher_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $request['name']);
        if ($stmt->execute()) {
            echo 'The publisher has been updated successfully';
        }
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM publishers WHERE publisher_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo 'publisher id ' . $id . ' was deleted successfully';
        }
    }

    public function multipleSelect(array $list): array
    {
        $placeholder = str_repeat('?,', count($list) - 1) . '?';
        $sql = "SELECT name FROM publishers WHERE publisher_id IN ($placeholder)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($list);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUsernameByRo(string $str): array
    {
        $pattern = '%' . $str . '%';
        $sql = 'SELECT * FROM publishers WHERE name LIKE :pattern';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':pattern', $pattern);
        $stmt->execute();

         return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchObject(int $id): Publisher
    {
        $sql = 'SELECT * FROM publishers WHERE publisher_id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchObject('Zeroyukiy\Prova\Publisher');
    }
}

class Publisher
{
    private int $publisher_id;
    private string $name;
}