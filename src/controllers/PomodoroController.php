<?php
require_once 'AppController.php';

session_start();

class PomodoroController extends AppController {

    public function __construct() {
        parent::__construct(); e
        $this->checkAuthentication();
    }

    public function pomodoro() {
        $this->render('pomodoro');
    }
    
    public function startPomodoro()
    {
        $workDuration = $_POST['workDuration'] ?? 25;
        $breakDuration = $_POST['breakDuration'] ?? 5;

        $_SESSION['workDuration'] = $workDuration;
        $_SESSION['breakDuration'] = $breakDuration;
        $_SESSION['startTime'] = time();
        $_SESSION['isBreak'] = false;

        echo json_encode(['status' => 'started']);
    }

    public function stopPomodoro()
    {
        echo json_encode(['status' => 'stopped']);
    }

    public function pomodoroStatus()
    {
        if (!isset($_SESSION['startTime'])) {
            echo json_encode(['status' => 'not_started']);
            return;
        }

        $isBreak = $_SESSION['isBreak'] ?? false;
        $startTime = $_SESSION['startTime'];
        $duration = ($isBreak ? $_SESSION['breakDuration'] : $_SESSION['workDuration']) * 60;
        $elapsed = time() - $startTime;
        $remaining = max(0, $duration - $elapsed);

        if ($remaining === 0) {
            $_SESSION['isBreak'] = !$isBreak;
            $_SESSION['startTime'] = time();
            $duration = ($_SESSION['isBreak'] ? $_SESSION['breakDuration'] : $_SESSION['workDuration']) * 60;
            $remaining = $duration;
        }

        echo json_encode([
            'status' => 'running',
            'remainingTime' => $remaining,
            'isBreak' => $_SESSION['isBreak']
        ]);
    }
}
