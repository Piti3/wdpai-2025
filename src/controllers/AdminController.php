<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/AdminRepository.php';

class AdminController extends AppController {
    private AdminRepository $repo;

    public function __construct() {
        parent::__construct();
        $this->repo = new AdminRepository();
    }

    public function adminDashboard() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['role'] !== 'admin') {
            return $this->render('login', ['messages' => ['Access denied']]);
        }

        $users = $this->repo->getAllUsers();
        return $this->render('adminDashboard', ['users' => $users]);
    }

    public function deleteUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['role'] !== 'admin' || empty($_POST['user_id'])) {
            header("Location: login");
            exit();
        }

        $this->repo->deleteUser((int)$_POST['user_id']);
        header("Location: adminDashboard");
        exit();
    }

    public function changePassword() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['role'] !== 'admin' 
            || empty($_POST['user_id']) 
            || empty($_POST['new_password'])) 
        {
            header("Location: login");
            exit();
        }

        $hashed = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $this->repo->changePassword((int)$_POST['user_id'], $hashed);

        header("Location: adminDashboard");
        exit();
    }

    public function changeRole() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['role'] !== 'admin' 
            || empty($_POST['user_id']) 
            || empty($_POST['new_role'])) 
        {
            header("Location: login");
            exit();
        }

        $this->repo->changeRole((int)$_POST['user_id'], $_POST['new_role']);
        header("Location: adminDashboard");
        exit();
    }
}
