# hTrack – Habit Tracker

**hTrack** is a web application that allows users to:
- register and log in,
- track habits in a calendar view,
- manage a simple to-do list,
- use a Pomodoro timer,
- access an administrative panel to manage users (roles, deletion, password changes) and export the database.

The backend is written in PHP, while the frontend uses plain HTML/CSS/JavaScript. The application runs in Docker containers: PostgreSQL, PHP, Nginx, and pgAdmin.

---

## Table of Contents

1. [Demo](#demo)
2. [Features](#features)  
3. [Technologies](#technologies)  
4. [Prerequisites](#prerequisites)  
5. [Installation & Running](#installation--running)  
6. [Project Structure](#project-structure)  
7. [Key Components](#key-components)  
8. [Usage](#usage).
9. [Diagram ERD](#diagram-erd)

---

## Demo 
![Login page](./xscreenshots/web-login-page)
![Register page](./xscreenshots/web-register-page)
![Dashboard page](./xscreenshots/web-dashboard-page)
![Admin Dashboard page](./xscreenshots/web-adminDashboard-page)
![Pomodoro page](./xscreenshots/web-pomodoro-page)
![Settings page](./xscreenshots/web-settings-page)
![Add habit page](./xscreenshots/web-addHabit-page)
![Mobile login page](./xscreenshots/mobile-login-page)
![Mobile register page](./xscreenshots/mobile-register-page)
![Mobile dashboard page](./xscreenshots/mobile-dashboard-page)
![Mobile admin Dashboard page](./xscreenshots/mobile-adminDashboard-page)
![Mobile pomodoro page](./xscreenshots/mobile-pomodoro-page)
![Mobile settings page](./xscreenshots/mobile-settings-page)
![Mobile add habit page](./xscreenshots/mobile-addHabit-page)

---

## Features

- **Registration & Login**  
- **User Session & Roles**  
- **Habit Tracker**  
- **To-Do List**  
- **Pomodoro Timer (JavaScript + Fetch API)**  
- **Admin Panel**  
- **Database Export to .sql**  
- **Responsive Design**  

---

## Technologies

- **Backend**  
  - PHP 8.x

- **Database**  
  - PostgreSQL

- **Frontend**  
  - HTML/CSS   
  - JavaScript (Fetch API)   

- **Servers & Tools**  
  - Docker + Docker Compose orchestration:  

---

## Prerequisites

1. **Docker** (v20.x or later)  
2. **Docker Compose** (v1.29.x or later)  
3. A machine with Linux/macOS/Windows (with Docker Desktop).

---

## Installation & Running

1. **Clone the repository**  
   git clone https://github.com/Piti3/wdpai-2025.git

2. **Launch with Docker Compose**
    docker-compose up -d --build

3. **Open in your browser**
    Application: http://localhost:8080
    pgAdmin: http://localhost:5050


## Key Components

### 1. Controllers (PHP)

#### AppController.php
- Base class for all controllers.
- **Helper methods**:  
  - `render($template, $variables)`  
  - `checkAuthentication()`  
  - `isGet()`  
  - `isPost()`  
- Enforces session checks and redirects unauthorized users.

#### SecurityController.php
- `login()` – Validates login form, verifies password, sets `$_SESSION['user_id']` and `$_SESSION['role']`.
- `register()` – Validates registration form, hashes password, creates new user in DB.
- `logout()` – Unsets session, destroys it, redirects to `/login`.

#### DashboardController.php
- `dashboard()` – Displays user’s habits and todos.
  - `addHabit()`  
  - `deleteHabit()`  
  - `toggleHabitDay()`  
  - `addTodo()`  
  - `deleteTodo()`  
  - `toggleTodoStatus()`  
- Each method calls its repository, processes data, and refreshes the view.

#### PomodoroController.php
- `startPomodoro()` – Stores `workDuration`, `breakDuration`, `startTime`, `isBreak` in `$_SESSION`, returns JSON.
- `stopPomodoro()` – Returns status `"stopped"`.
- `pomodoroStatus()` – Calculates elapsed time; if interval finished, switches break/work and returns `remainingTime` + `isBreak`.

#### SettingsController.php
- `settings()` – Retrieves profile data and displays the edit form.
- `updateProfile()` – Updates user’s profile (email, note, etc.).
- `updatePassword()` – Changes password (verifies old password, hashes new).
- `deleteAccount()` – Deletes user’s account and associated records.

#### AdminController.php
- `adminDashboard()` – Shows all users (email + role).
- `deleteUser()`, `changeRole()`, `changePassword()` – Manage user accounts.
- `exportDatabase()` – Calls `pg_dump` to generate and return a `.sql` dump.

---

### 2. Repositories (PHP + PDO)

#### DatabaseController.php
- Static `connect()` method returns a PDO instance connected to PostgreSQL with `ERRMODE_EXCEPTION` enabled.

#### SecurityRepository.php
- `findUserByEmail($email)` – `SELECT * FROM users WHERE email = $1`
- `createUser($email, $hashedPassword)` –  
  `INSERT INTO users(email, password, role) VALUES(?,?, 'user')`

#### DashboardRepository.php
- `getHabitsByUser($userId)`  
- `addHabit()`  
- `deleteHabit()`  
- `toggleHabitDay()`  
- `getTodosByUser($userId)`  
- `addTodo()`  
- `deleteTodo()`  
- `toggleTodoStatus()`

#### AdminRepository.php
- `getAllUsers()`  
- `deleteUser($id)`  
- `changeRole($id, $newRole)`  
- `changePassword($id, $newPass)`

---

## Usage

After bringing up containers (`docker-compose up -d`), access:

- **Login**: [http://localhost:8080](http://localhost:8080)
  - Login form (email + password).
  - Link to registration.

- **Register**: [http://localhost:8080/register](http://localhost:8080/register)
  - Fill email, password, confirm password, accept terms.
  - After registering, you are redirected to `/login`.

### User Dashboard (`/dashboard`)
- Displays habits panel (calendar).
- Lists user’s habits; clicking a day marks it as completed.
- **To-Do section**: add, delete, and mark tasks as done.

### Pomodoro (`/pomodoro`)
- Set work and break durations, then click “Start”.
- Timer counts down in real time; after break, you can restart.

### Settings (`/settings`)
- Edit profile (email, note, etc.).
- Change password.
- Delete account (removes user and associated data).

### Admin Panel (`/adminDashboard`)
- Lists all users (email + role).
- Change user role (dropdown), reset password, delete account.
- "Export Database" button generates `.sql` dump.

## Diagram ERD
![](https://github.com/Piti3/wdpai-2025/blob/main/xscreenshots/Diagram-ERD.png?raw=true)
