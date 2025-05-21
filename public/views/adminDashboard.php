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
    <link href="public/styles/adminDashboard.css" rel="stylesheet">
    <script src="public/scripts/menu.js" defer></script>

    <title>AdminDashboard</title>
</head>
<body>
    <header>
        <nav id="dashboard" class="flex-row-center-center">
                <div class="logo-container">
                    <img src="public/images/htrack_small_logo.png" alt="hTrack Small Logo" class="logo">
                </div>
                <ul class="desktop-icons"> 
                <li>
                    <i class="fa-solid fa-house" onclick="window.location.href='adminDashboard'"></i>
                    <span>Home</span>
                </li>
                <li>
                    <i class="fa-solid fa-right-from-bracket" onclick="window.location.href='logout'"></i>
                    <span>Log Out</span>
                </li>
            </ul>

            <ul class="mobile-icons">
                <li id="hamburger-menu">
                    <i class="fa-solid fa-bars"></i>
                    <span>MENU</span>
                </li>
            </ul>
        </nav>
    </header>
    <main class="two-column-container">
        <section class="left-column">
            <h2>Users Section</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Change Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td>
                                        <form method="POST" action="changeRole" class="inline-form">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <select name="new_role">
                                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                            </select>
                                            <button type="submit">Change</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="deleteUser" onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No users found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="right-column">
            <h2>Settings Section</h2>
            <div class="settings-content">
                <form action="/exportDatabase" method="GET">
                    <button type="submit" class="export-button">
                        Eksportuj bazę (.sql)
                    </button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>