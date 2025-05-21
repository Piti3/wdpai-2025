<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

//DefaultController
Routing::get('', 'DefaultController');

// SecurityController
Routing::post('login', 'SecurityController');
Routing::get('logout', 'SecurityController');
Routing::post('register', 'SecurityController');

//SettingsController
Routing::get('settings', 'SettingsController');

// AdminController
Routing::get('adminDashboard', 'AdminController', 'adminDashboard');
Routing::post('changeRole', 'AdminController');
Routing::post('deleteUser', 'AdminController');
Routing::post('changePassword', 'AdminController');
Routing::get('exportDatabase', 'AdminController');

// DashboardController
Routing::get('dashboard', 'DashboardController');
Routing::get('form', 'DashboardController');
Routing::post('addHabit', 'DashboardController');
Routing::post('deleteHabit', 'DashboardController');
Routing::post('toggleHabitDay', 'DashboardController');

Routing::post('addTodo', 'DashboardController');
Routing::post('deleteTodo', 'DashboardController');
Routing::post('toggleTodoStatus', 'DashboardController');

//PomodoroController
Routing::get('pomodoro', 'PomodoroController');
Routing::post('startPomodoro', 'PomodoroController');
Routing::post('stopPomodoro', 'PomodoroController');
Routing::get('pomodoroStatus', 'PomodoroController');

//UserSettings
Routing::get('settings', 'SettingsController');
Routing::post('updateProfile', 'SettingsController');
Routing::post('updatePassword', 'SettingsController');
Routing::post('deleteAccount', 'SettingsController');

Routing::run($path);