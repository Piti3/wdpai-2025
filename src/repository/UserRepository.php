<?php

require_once __DIR__ .'/../controllers/DatabaseController.php';

class UserRepository {
    public function getById($userId) {
        try {
            $conn = DatabaseController::connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute(['id' => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Database error: ".$e->getMessage());
            return null;
        }
    }

    public function updateNameSurname($userId, $name, $surname) {
        try {
            $conn = DatabaseController::connect();
            $stmt = $conn->prepare("UPDATE users SET name = :name, surname = :surname WHERE id = :id");
            return $stmt->execute([
                'id' => $userId,
                'name' => $name,
                'surname' => $surname
            ]);
        } catch (PDOException $e) {
            error_log("Database error: ".$e->getMessage());
            return false;
        }
    }
    
    public function updatePassword($userId, $newPasswordHash) {
        try {
            $conn = DatabaseController::connect();
            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            return $stmt->execute([
                'id' => $userId,
                'password' => $newPasswordHash
            ]);
        } catch (PDOException $e) {
            error_log("Database error: ".$e->getMessage());
            return false;
        }
    }

    public function deleteById($userId) {
        try {
            $conn = DatabaseController::connect();
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            return $stmt->execute(['id' => $userId]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }
    

}