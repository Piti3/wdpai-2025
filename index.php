<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

//DefaultController
Routing::get('', 'DefaultController');  // po chuj to jest?

// SecurityController
Routing::post('login', 'SecurityController');
Routing::get('logout', 'SecurityController');
Routing::post('register', 'SecurityController');

//DASHBOARD NAVIGATION
Routing::get('pomodoro', 'DefaultController');
Routing::get('form', 'DefaultController');
Routing::get('settings', 'DefaultController');


// AdminController
Routing::get('adminDashboard', 'AdminController', 'adminDashboard');
Routing::post('changeRole', 'AdminController');
Routing::post('deleteUser', 'AdminController');
Routing::post('changePassword', 'AdminController');

// DashboardController -> SecurityController -----?
Routing::get('dashboard', 'DashboardController');
Routing::post('addHabit', 'DashboardController');
Routing::post('deleteHabit', 'DashboardController');
Routing::post('toggleHabitDay', 'DashboardController');

Routing::post('addTodo', 'DashboardController');
Routing::post('deleteTodo', 'DashboardController');
Routing::post('toggleTodoStatus', 'DashboardController');

//PomodoroController
Routing::post('startPomodoro', 'PomodoroController');
Routing::post('stopPomodoro', 'PomodoroController');
Routing::get('pomodoroStatus', 'PomodoroController');

//UserSettings
Routing::get('settings', 'SettingsController');
Routing::post('updateProfile', 'SettingsController');
Routing::post('updatePassword', 'SettingsController');
Routing::post('deleteAccount', 'SettingsController');

Routing::run($path);