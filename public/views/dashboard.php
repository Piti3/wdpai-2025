<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>

    <link href="public/styles/dashboard.css" rel="stylesheet">
    <script src="public/scripts/menu.js" defer></script>
    <script src="public/scripts/mark_days.js" defer></script>
    <script src="public/scripts/habit_popup.js" defer></script>


    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>

    <title>DASHBOARD</title>
</head>
<body>
    <header>
        <nav id="dashboard" class="flex-row-center-center">
                <div class="logo-container">
                    <img src="public/images/htrack_small_logo.png" alt="hTrack Small Logo" class="logo">
                </div>
                <ul class="desktop-icons"> 
                <li>
                    <i class="fa-regular fa-clock" onclick="window.location.href='pomodoro'"></i>
                    <span>Pomodoro</span>
                </li>
                <li>
                    <i class="fa-solid fa-house" onclick="window.location.href='dashboard'"></i>
                    <span>Home</span>
                </li>
                <li>
                    <i class="fa-solid fa-gear" onclick="window.location.href='settings'"></i>
                    <span>Settings</span>
                </li>
                <li>
                    <i class="fa-solid fa-right-from-bracket" onclick="window.location.href='logout'"></i>
                    <span>Log Out</span>
                </li>
                <button class="add-habit-button" onclick="location.href='form'">
                    <i class="fas fa-plus"></i> Add Habit
                </button>
            </ul>

            <ul class="mobile-icons">
                <li id="hamburger-menu">
                    <i class="fa-solid fa-bars"></i>
                    <span>MENU</span>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <aside class="dashboard-container">
            <section class="habits-score">
                <h2>Your habits:</h2>
                <ul>
            <?php foreach ($habits as $index => $habit): ?>
                <li>
                    <?= $index + 1 ?>
                    <strong><?= htmlspecialchars($habit['name']) ?></strong>
                    <progress value="<?= $habit['progress'] ?>" max="100"></progress>
                    <span><?= $habit['progress'] ?>%</span>
                </li>
            <?php endforeach; ?>
            </ul>
            </section>
            <section class="todo">
                <h2>To do list:</h2>
                <form method="POST" action="/addTodo" class="todo-input-container">
                    <input type="text" id="todo-input" name="content" placeholder="Write your todos...">
                    <button id="add-todo" type="submit">Dodaj</button>
                </form>

                <ul id="todo-list">
                    <?php foreach ($todos as $todo): ?>
                        <li class="todo-item <?= $todo['is_done'] ? 'done' : '' ?>">
                            <form method="POST" action="/toggleTodoStatus" style="display: flex; align-items: center; flex: 1;">
                                <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                                <input type="hidden" name="is_done" value="<?= $todo['is_done'] ? 0 : 1 ?>">
                                <input type="checkbox" class="todo-checkbox" onchange="this.form.submit()" <?= $todo['is_done'] ? 'checked' : '' ?>>
                            </form>
                            <span class="todo-text"><?= htmlspecialchars($todo['content']) ?></span>
                            <form method="POST" action="/deleteTodo">
                                <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                                <button class="delete-button">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </aside>
        <section class="habit-tracking">
            <?php foreach ($habits as $habit): ?>
                <div class="habit">
            <div class="habit-header">
                <button 
                    class="habit-name-button" 
                    data-habit='<?= json_encode([
                        'name' => $habit['name'],
                        'question' => $habit['question'],
                        'frequency' => $habit['frequency'],
                        'note' => $habit['note'],
                        'target' => $habit['target']
                    ]) ?>'>
                    <?= htmlspecialchars($habit['name']) ?>
                </button>

                <form method="POST" action="deleteHabit" onsubmit="return confirm('Are you sure?');">
                    <input type="hidden" name="habit_id" value="<?= $habit['id'] ?>">
                    <button type="submit" class="delete-button">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </form>
            </div>
            <div class="calendar">
            <?php
            $currentYear = (int)date('Y');
            $months = [];
            
            for ($i = 1; $i <= 12; $i++) {
                $monthDate = DateTime::createFromFormat('Y-n-j', "$currentYear-$i-1");
                $months[] = [
                    'obj' => $monthDate,
                    'name' => $monthDate->format('M'),
                    'year' => $monthDate->format('Y'),
                    'first_day' => (clone $monthDate)->modify('first day of this month')->setTime(0, 0),
                    'last_day' => (clone $monthDate)->modify('last day of this month')->setTime(23, 59, 59)
                ];
            }
            ?>
            <div class="calendar-wrapper">
                <div class="calendar-grid">
                    <?php foreach ($months as $m): ?>
                    <div class="calendar-month">
                        <div class="month-name"><?= $m['name'] . ' ' . $m['year'] ?></div>
                        <div class="days-grid">
                            <?php
                            $date = clone $m['first_day'];
                            while ($date <= $m['last_day']) {
                                $dayStr = $date->format('Y-m-d');
                                $isChecked = in_array($dayStr, $habit['completed_days'] ?? []);
                            ?>
                            <button 
                                class="day <?= $isChecked ? 'checked' : '' ?>" 
                                data-date="<?= $dayStr ?>" 
                                data-habit-id="<?= $habit['id'] ?>">
                                <?= $date->format('j') ?>
                            </button>
                            <?php
                            $date->modify('+1 day'); } ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</section>

</main>
<div id="habit-popup" class="popup" style="display:none;">
  <div class="popup-content">
    <span id="popup-close" class="popup-close">&times;</span>
    <h2 id="popup-name"></h2>
    <p><strong>Question:</strong> <span id="popup-question"></span></p>
    <p><strong>Frequency:</strong> <span id="popup-frequency"></span></p>
    <p><strong>Note:</strong> <span id="popup-note"></span></p>
    <p><strong>Target:</strong> <span id="popup-target"></span></p>
  </div>
</div>

</body>
</html>