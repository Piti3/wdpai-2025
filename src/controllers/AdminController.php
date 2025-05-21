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

    public function exportDatabase() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
        header('HTTP/1.1 403 Forbidden');
        echo 'Access denied.';
        exit();
    }

    $host   = 'db';
    $port   = '5432';
    $dbname = 'db';
    $dbUser = 'docker';

    $cmd = sprintf(
        'pg_dump --host=%s --port=%s --username=%s --no-owner --no-privileges --format=plain %s',
        escapeshellarg($host),
        escapeshellarg($port),
        escapeshellarg($dbUser),
        escapeshellarg($dbname)
    );

    $output = [];
    $returnVar = 0;
    exec($cmd . ' 2>&1', $output, $returnVar);

    if ($returnVar !== 0) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "Error during pg_dump:\n";
        echo implode("\n", $output);
        exit();
    }

    $sqlDump = implode("\n", $output);
    $fileName = 'backup_database_' . date('Ymd_His') . '.sql';

    header('Content-Type: application/sql; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Expires: 0');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');

    echo $sqlDump;
    exit();
    }
}
