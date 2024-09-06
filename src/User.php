<?php

class User {
    private $id_user;
    private $user_name;
    private $user_lastName;
    private $email;
    private $register_date;

    public function __construct($id_user = null, $user_name, $user_lastName, $email, $register_date) {
        $this->id_user = $id_user;
        $this->user_name = $user_name;
        $this->user_lastName = $user_lastName;
        $this->email = $email;
        $this->register_date = $register_date;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getUserLastName() {
        return $this->user_lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRegisterDate() {
        return $this->register_date;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setUserName($user_name) {
        $this->user_name = $user_name;
    }

    public function setUserLastName($user_lastName) {
        $this->user_lastName = $user_lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRegisterDate($register_date) {
        $this->register_date = $register_date;
    }

    public function mostrarInformacion() {
        return "Nombre: {$this->user_name} {$this->user_lastName}, Email: {$this->email}, Fecha de Registro: {$this->register_date}";
    }
}
