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
    <link href="public/styles/settings.css" rel="stylesheet">
    <script src="public/scripts/menu.js" defer></script>

    <title>UserSettings</title>
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
    <section class="settings-section">
        <h2>Update Profile</h2>
        <form action="updateProfile" method="POST">
            <label>Email (not editable):</label>
            <input type="email" value="<?= $user['email'] ?>" disabled>
            <label>Name:</label>
            <input type="text" name="name" value="<?= $user['name'] ?? '' ?>" required>
            <label>Surname:</label>
            <input type="text" name="surname" value="<?= $user['surname'] ?? '' ?>" required>
            <button type="submit">Save</button>
        </form>
    </section>

    <section class="settings-section">
        <h2>Change Password</h2>
        <form action="updatePassword" method="POST">
            <label>New Password:</label>
            <input type="password" name="password" required minlength="6">
            <label>Repeat Password:</label>
            <input type="password" name="password_repeat" required minlength="6">
            <button type="submit">Change Password</button>
        </form>
    </section>

    <section class="settings-section delete-section">
        <h2>Delete Account</h2>
        <form action="deleteAccount" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            <p class="warning-text">Warning: This will permanently delete your account and all associated data!</p>
            <button type="submit" class="delete-btn">Delete My Account</button>
        </form>
    </section>
</main>
</body>
</html>