<?php

declare(strict_types=1);

class Task
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function add(string $text): bool
    {
        $status = false;
        $stmt   = $this->pdo->prepare("INSERT INTO todo_app (text, status) VALUES (:text, :status)");
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM todo_app")->fetchAll();
    }

    public function complete(int $id): bool
    {
        $status = true;
        $stmt   = $this->pdo->prepare("UPDATE todo_app  SET status=:status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function uncompleted(int $id): bool
    {
        $status = false;
        $stmt   = $this->pdo->prepare("UPDATE todo_app  SET status=:status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM todo_app WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}