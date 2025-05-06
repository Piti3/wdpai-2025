<?php

require_once 'AppController.php';
require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once 'DatabaseController.php';
require_once __DIR__ . '/../repository/SecurityRepository.php';

class SecurityController extends AppController {

    private SecurityRepository $repo;

    public function __construct() {
        parent::__construct();
        $this->repo = new SecurityRepository();
    }

    public function login() {
        $email    = $_POST["email"]    ?? null;
        $password = $_POST["password"] ?? null;

        if (!$email || !$password) {
            return $this->render('login', ['messages' => ['Please provide email and password!']]);
        }

        $user = $this->repo->findUserByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email']   = $user['email'];
        $_SESSION['role']    = $user['role'];

        $redirect = $_SESSION['role'] === 'admin' ? '/adminDashboard' : '/dashboard';
        header("Location: {$redirect}");
        exit();
    }

    public function register() {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email           = $_POST["email"]            ?? null;
        $password        = $_POST["password"]         ?? null;
        $confirmPassword = $_POST["confirm_password"] ?? null;
        $role            = 'user';

        if (!$email || !$password || !$confirmPassword) {
            return $this->render('register', ['messages' => ['All fields are required!']]);
        }
        if ($password !== $confirmPassword) {
            return $this->render('register', ['messages' => ['Passwords do not match!']]);
        }

        if ($this->repo->findUserByEmail($email)) {
            return $this->render('register', ['messages' => ['Email is already taken!']]);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $this->repo->insertUser($email, $hashedPassword, $role);
            return $this->render('login', ['messages' => ['Account created successfully! You can now log in.']]);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return $this->render('register', ['messages' => ['Database error!']]);
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        $this->render('login', ['messages' => ['You have been logged out.']]);
    }
}