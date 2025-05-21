<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class SettingsController extends AppController
{
    private $userRepo;

    public function __construct() {
        parent::__construct();
        $this->userRepo = new UserRepository();
        $this->checkAuthentication(); 
    }

    public function settings() {
        $user = $this->userRepo->getById($_SESSION['user_id']);
        return $this->render('settings', ['user' => $user]);
    }

    public function updateProfile() {

        if (!$this->isPost()) {
            header('Location: /settings');
            exit();
        }

        $name = $_POST['name'] ?? '';
        $surname = $_POST['surname'] ?? '';

        $this->userRepo->updateNameSurname($_SESSION['user_id'], $name, $surname);

        header('Location: /settings');
        exit();
    }

    public function updatePassword() {

        if (!$this->isPost()) {
            header('Location: /settings');
            exit();
        }

        $password = $_POST['password'] ?? '';
        $passwordRepeat = $_POST['password_repeat'] ?? '';

        if ($password !== $passwordRepeat || strlen($password) < 6) {
            header('Location: /settings?error=password_mismatch');
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepo->updatePassword($_SESSION['user_id'], $hashedPassword);

        header('Location: /settings?success=password_updated');
        exit();
    }

    public function deleteAccount() {

        if (!$this->isPost()) {
            header('Location: /settings');
            exit();
        }

        $deleted = $this->userRepo->deleteById($_SESSION['user_id']);
        if ($deleted) {
            session_destroy();
            header('Location: /login?account_deleted=1');
        } else {
            header('Location: /settings?error=deletion_failed');
        }
        exit();
    }
}
