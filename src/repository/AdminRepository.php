<?php

require_once __DIR__ .'/../controllers/DatabaseController.php';

class AdminRepository {
    private PDO $conn;

    public function __construct() {
        $this->conn = DatabaseController::connect();
    }

    /** Pobierz wszystkich użytkowników (id, email, role) */
    public function getAllUsers(): array {
        $stmt = $this->conn->query("SELECT id, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** Usuń użytkownika po id */
    public function deleteUser(int $userId): void {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
    }

    /** Zmień hasło użytkownika (podane już zahashowane) */
    public function changePassword(int $userId, string $hashedPassword): void {
        $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $hashedPassword,
            'id'       => $userId
        ]);
    }

    /** Zmień rolę użytkownika */
    public function changeRole(int $userId, string $newRole): void {
        $stmt = $this->conn->prepare("UPDATE users SET role = :role WHERE id = :id");
        $stmt->execute([
            'role' => $newRole,
            'id'   => $userId
        ]);
    }
}
