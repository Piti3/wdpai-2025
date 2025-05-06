<?php

class user {

    private $email;
    private $password;
    private $name;
    private $surname;

    public function __construct(string $email, string $password, string $name, string $surname) {
   
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(): string {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(): string {
        $this->password = $password;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(): string {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname(): string {
        $this->surname = $surname;
    }


}