<?php

class Autor {
    private $id_author;
    private $author_name;
    private $author_lastName;
    private $birth_date;
    private $biography;
    private $id_book;

    public function __construct($id_author = null, $author_name, $author_lastName, $birth_date, $biography, $id_book = null) {
        $this->id_author = $id_author;
        $this->author_name = $author_name;
        $this->author_lastName = $author_lastName;
        $this->birth_date = $birth_date;
        $this->biography = $biography;
        $this->id_book = $id_book;
    }

    public function getIdAuthor() {
        return $this->id_author;
    }

    public function getAuthorName() {
        return $this->author_name;
    }

    public function getAuthorLastName() {
        return $this->author_lastName;
    }

    public function getBirthDate() {
        return $this->birth_date;
    }

    public function getBiography() {
        return $this->biography;
    }

    public function getIdBook() {
        return $this->id_book;
    }

    public function setIdAuthor($id_author) {
        $this->id_author = $id_author;
    }

    public function setAuthorName($author_name) {
        $this->author_name = $author_name;
    }

    public function setAuthorLastName($author_lastName) {
        $this->author_lastName = $author_lastName;
    }

    public function setBirthDate($birth_date) {
        $this->birth_date = $birth_date;
    }

    public function setBiography($biography) {
        $this->biography = $biography;
    }

    public function setIdBook($id_book) {
        $this->id_book = $id_book;
    }

    public function mostrarInformacion() {
        return "Autor: {$this->author_name} {$this->author_lastName}, Nacimiento: {$this->birth_date}, Biografía: {$this->biography}";
    }
}
