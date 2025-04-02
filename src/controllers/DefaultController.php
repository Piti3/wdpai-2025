<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function login() { //DISPLAY LOGIN
        $this->render('login');
    }

    public function register() { //DISPLAY register
        $this->render('register');
    } 

    public function dashboard() { //DISPLAY DASHBOARD
        $this->render('dashboard');
    }

    public function form() { //DISPLAY form
        $this->render('form');
    } 

    public function pomodoro() { //DISPLAY pomodoro
        $this->render('pomodoro');
    } 

   
}