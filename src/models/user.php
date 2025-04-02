<?php

class user {

    private $email;
    private $password;
    private $name;
    private $surname;
}

public function __construct(string $email, string $password, string $name, string $surname) {
    $this->email = $email;
    $this->password = $password;
    $this->name = $name;
    $this->surname = $surname;
}