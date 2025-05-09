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
    <link href="public/styles/pomodoro.css" rel="stylesheet">
    <script src="public/scripts/menu.js" defer></script>
    <script src="public/scripts/pomodoro.js" defer></script>

    <title>POMODORO</title>
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
        <div class="pomodoro-container">
            <div class="timer-circle">
                <span id="timer">00:25:00</span>
            </div>
            <div class="controls">
                <button class="control-btn" id="start-pause-button"><i class="fas fa-play"></i></button>
                <button class="control-btn" id="reset-button"><i class="fas fa-stop"></i></button>
            </div>
            <div class="settings">
                <i class="fa-solid fa-gear"></i> <span>Settings</span>
            </div>
            <form id="settings-form">
                <label>
                    Work Duration (min):
                    <input type="number" name="workDuration" id="work-duration" value="25" min="1">
                </label>
                <label>
                    Break Duration (min):
                    <input type="number" name="breakDuration" id="break-duration" value="5" min="1">
                </label>
                <button type="button" class="control-btn" onclick="applySettings()">Apply</button>
            </form>
        </div>
    </main>
</body>
</html>