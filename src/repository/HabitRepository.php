<?php

require_once __DIR__ . '/../controllers/DatabaseController.php';

class HabitRepository {
    private PDO $conn;

    public function __construct() {
        $this->conn = DatabaseController::connect();
    }

    public function findAllByUser(int $userId): array {
        $stmt = $this->conn->prepare("SELECT * FROM habits WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $habits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($habits as &$h) {
            $stmt2 = $this->conn->prepare(
                "SELECT date FROM habit_completions 
                 WHERE habit_id = :id AND user_id = :user_id"
            );
            $stmt2->execute([
                'id'      => $h['id'],
                'user_id'=> $userId
            ]);
            $h['completed_days'] = array_column($stmt2->fetchAll(PDO::FETCH_ASSOC), 'date');
        }
        return $habits;
    }

    public function add(
        int $userId,
        string $name,
        string $question,
        string $frequency,
        ?string $note,
        ?int $target
    ): void {
        $stmt = $this->conn->prepare("
            INSERT INTO habits 
              (user_id, name, question, frequency, note, target)
            VALUES 
              (:user_id, :name, :question, :frequency, :note, :target)
        ");
        $stmt->execute([
            'user_id'   => $userId,
            'name'      => $name,
            'question'  => $question,
            'frequency' => $frequency,
            'note'      => $note,
            'target'    => $target
        ]);
    }

    public function delete(int $habitId, int $userId): bool {
        $stmt = $this->conn->prepare(
            "DELETE FROM habits WHERE id = :id AND user_id = :user_id"
        );
        $stmt->execute([
            'id'       => $habitId,
            'user_id' => $userId
        ]);
        return $stmt->rowCount() > 0;
    }

    public function hasCompletion(int $habitId, int $userId, string $date): bool {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM habit_completions 
               WHERE habit_id = :habit_id 
                 AND user_id   = :user_id 
                 AND date      = :date"
        );
        $stmt->execute([
            'habit_id' => $habitId,
            'user_id'  => $userId,
            'date'     => $date
        ]);
        return (bool)$stmt->fetchColumn();
    }

    public function addCompletion(int $habitId, int $userId, string $date): void {
        $stmt = $this->conn->prepare(
            "INSERT INTO habit_completions (habit_id, user_id, date) 
             VALUES (:habit_id, :user_id, :date)"
        );
        $stmt->execute([
            'habit_id' => $habitId,
            'user_id'  => $userId,
            'date'     => $date
        ]);
    }

    public function removeCompletion(int $habitId, int $userId, string $date): void {
        $stmt = $this->conn->prepare(
            "DELETE FROM habit_completions 
               WHERE habit_id = :habit_id 
                 AND user_id   = :user_id 
                 AND date      = :date"
        );
        $stmt->execute([
            'habit_id' => $habitId,
            'user_id'  => $userId,
            'date'     => $date
        ]);
    }
}
