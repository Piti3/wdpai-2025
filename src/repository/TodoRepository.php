<?php

require_once __DIR__ . '/../controllers/DatabaseController.php';

class TodoRepository {
    private PDO $conn;

    public function __construct() {
        $this->conn = DatabaseController::connect();
    }

    public function findAllByUser(int $userId): array {
        $stmt = $this->conn->prepare(
            "SELECT * FROM todos WHERE user_id = :user_id ORDER BY created_at DESC"
        );
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(int $userId, string $content): void {
        $stmt = $this->conn->prepare(
            "INSERT INTO todos (user_id, content) VALUES (:user_id, :content)"
        );
        $stmt->execute([
            'user_id' => $userId,
            'content' => $content
        ]);
    }

    public function delete(int $todoId, int $userId): void {
        $stmt = $this->conn->prepare(
            "DELETE FROM todos WHERE id = :id AND user_id = :user_id"
        );
        $stmt->execute([
            'id'      => $todoId,
            'user_id' => $userId
        ]);
    }

    public function updateStatus(int $todoId, int $userId, bool $isDone): void {
        $stmt = $this->conn->prepare(
            "UPDATE todos SET is_done = :is_done WHERE id = :id AND user_id = :user_id"
        );
        $stmt->execute([
            'is_done' => $isDone ? 1 : 0,
            'id'      => $todoId,
            'user_id' => $userId
        ]);
    }
}
