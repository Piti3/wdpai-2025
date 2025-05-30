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
    <link href="public/styles/form.css" rel="stylesheet">
    <script src="public/scripts/menu.js" defer></script>
    
    <title>FORM</title>
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
        <section class="habit-form">
            <div class="habit-box">
                <h2>Yes or No?</h2>
                <p>Like: did you play chess? Did you workout?</p>
                <form method="POST" action="addHabit">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter name">
                    
                    <label>Question</label>
                    <input type="text" name="question" placeholder="Enter question">
                    
                    <label>Frequency</label>
                    <select name="frequency">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                    </select>
                    
                    <label>Note</label>
                    <input type="text" name="note" placeholder="Enter note">
                    
                    <button class="save-btn">SAVE</button>
                </form>
            </div>

            <div class="habit-box">
                <h2>Measurable?</h2>
                <p>Like: How many kilometers did you run?</p>
                <form method="POST" action="addHabit">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter name">
                    
                    <label>Question</label>
                    <input type="text" name="question" placeholder="Enter question">
                    
                    <label>Frequency</label>
                    <select name="frequency">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                    </select>

                    <label>Target</label>
                    <input type="number" name="target" placeholder="Enter target">
                    
                    <label>Note</label>
                    <input type="text" name="note" placeholder="Enter note">
                    
                    <button class="save-btn">SAVE</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>