<?php
require_once 'AppController.php';
require_once __DIR__ . '/../repository/HabitRepository.php';
require_once __DIR__ . '/../repository/TodoRepository.php';

class DashboardController extends AppController {
    private HabitRepository $habitsRepo;
    private TodoRepository  $todosRepo;

    public function __construct() {
        parent::__construct();
        $this->checkAuthentication();
        $this->habitsRepo = new HabitRepository();
        $this->todosRepo  = new TodoRepository();
    }

    public function dashboard() {
        $userId = $_SESSION['user_id'];

        $habits = $this->habitsRepo->findAllByUser($userId);

        $startOfYear = new DateTime(date('Y') . '-01-01');
        $today       = new DateTime();
        $daysPassed  = $startOfYear->diff($today)->days + 1;

        foreach ($habits as &$h) {
            $completedCount = count($h['completed_days']);
            $h['progress']  = $daysPassed > 0
                ? round($completedCount / $daysPassed * 100)
                : 0;
        }

        $todos = $this->todosRepo->findAllByUser($userId);

        $this->render('dashboard', [
            'habits' => $habits,
            'todos'  => $todos
        ]);
    }

    public function addHabit() {
        if ($this->isGet()) {
            return $this->render('form');
        }

        $name      = $_POST['name']      ?? null;
        $question  = $_POST['question']  ?? null;
        $frequency = $_POST['frequency'] ?? null;
        $note      = $_POST['note']      ?? null;
        $target    = isset($_POST['target']) ? (int)$_POST['target'] : null;

        if (!$name || !$question || !$frequency) {
            return $this->render('form', ['error' => 'Uzupełnij wszystkie pola']);
        }

        $userId = $_SESSION['user_id'];
        $this->habitsRepo->add(
            $userId, $name, $question, $frequency, $note, $target
        );

        header('Location: /dashboard');
        exit();
    }

    public function deleteHabit() {
        if (!$this->isPost()) {
            header('Location: /dashboard'); exit();
        }

        $habitId = $_POST['habit_id'] ?? null;
        $userId  = $_SESSION['user_id'];

        if (!$habitId) {
            $_SESSION['error'] = 'Brak identyfikatora nawyku';
        } else {
            $ok = $this->habitsRepo->delete((int)$habitId, $userId);
            $_SESSION['success'] = $ok
                ? 'Nawyk został usunięty'
                : 'Nie znaleziono nawyku';
        }

        header('Location: /dashboard');
        exit();
    }

    public function toggleHabitDay() {
        if (!$this->isPost()) {
            http_response_code(405);
            echo json_encode(['error' => 'Only POST allowed']);
            exit();
        }
        $data    = json_decode(file_get_contents("php://input"), true);
        $habitId = $data['habit_id'] ?? null;
        $date    = $data['date']     ?? null;
        $userId  = $_SESSION['user_id'];

        if (!$habitId || !$date) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing habit_id or date']);
            exit();
        }

        if ($this->habitsRepo->hasCompletion($habitId, $userId, $date)) {
            $this->habitsRepo->removeCompletion($habitId, $userId, $date);
        } else {
            $this->habitsRepo->addCompletion($habitId, $userId, $date);
        }

        echo json_encode(['success' => true]);
    }

    public function addTodo() {
        if (!$this->isPost()) {
            header('Location: /dashboard'); exit;
        }

        $content = trim($_POST['content'] ?? '');
        if ($content === '') {
            $_SESSION['error'] = 'Treść nie może być pusta';
        } else {
            $this->todosRepo->add($_SESSION['user_id'], $content);
        }
        header('Location: /dashboard');
        exit();
    }

    public function deleteTodo() {
        if (!$this->isPost()) {
            header('Location: /dashboard'); exit;
        }

        $todoId = (int)($_POST['id'] ?? 0);
        $this->todosRepo->delete($todoId, $_SESSION['user_id']);
        header('Location: /dashboard');
        exit();
    }

    public function toggleTodoStatus() {
        if (!$this->isPost()) {
            http_response_code(405);
            echo json_encode(['error' => 'Only POST allowed']);
            exit();
        }

        $todoId = (int)($_POST['id'] ?? 0);
        $isDone = !empty($_POST['is_done']);
        $this->todosRepo->updateStatus($todoId, $_SESSION['user_id'], $isDone);

        header('Location: /dashboard');
        exit();
    }
    
    public function form() { //DISPLAY form
        $this->render('form');
    } 

}

