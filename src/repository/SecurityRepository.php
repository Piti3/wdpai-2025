<?php

require_once __DIR__ . '/../controllers/DatabaseController.php';
require_once __DIR__ . '/../models/User.php';

class SecurityRepository {
    private PDO $conn;

    public function __construct() {
        $this->conn = DatabaseController::connect();
    }

    public function findUserByEmail(string $email): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }


    public function insertUser(string $email, string $hashedPassword, string $role): void {
        $stmt = $this->conn->prepare("
            INSERT INTO users (email, password, role)
            VALUES (:email, :password, :role)
        ");
        $stmt->execute([
            'email'    => $email,
            'password' => $hashedPassword,
            'role'     => $role
        ]);
    }
}
