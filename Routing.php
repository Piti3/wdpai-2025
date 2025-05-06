<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/DashboardController.php';
require_once 'src/controllers/PomodoroController.php';
require_once 'src/controllers/SettingsController.php';

class Routing {
    public static $routes;

    public static function get($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function run($url) {
        $action = explode("/", $url)[0];

        if(!array_key_exists($action, self::$routes)) {
            die("WRONG URL!");
        }

         $controller = self::$routes[$action];
         $object = new $controller;
         $action = $action ?: 'login';

         $object->$action();
    }
}