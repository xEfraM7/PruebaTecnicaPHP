<?php

class Book {
    private $id_book;
    private $title;
    private $id_author;
    private $ISBN;
    private $date_publication;

    public function __construct($id_book = null, $title, $id_author, $ISBN, $date_publication) {
        $this->id_book = $id_book;
        $this->title = $title;
        $this->id_author = $id_author;
        $this->ISBN = $ISBN;
        $this->date_publication = $date_publication;
    }

    public function getIdBook() {
        return $this->id_book;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getIdAuthor() {
        return $this->id_author;
    }

    public function getISBN() {
        return $this->ISBN;
    }

    public function getDatePublication() {
        return $this->date_publication;
    }

    public function setIdBook($id_book) {
        $this->id_book = $id_book;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setIdAuthor($id_author) {
        $this->id_author = $id_author;
    }

    public function setISBN($ISBN) {
        $this->ISBN = $ISBN;
    }

    public function setDatePublication($date_publication) {
        $this->date_publication = $date_publication;
    }

    public function mostrarInformacion() {
        return "Título: {$this->title}, Autor: {$this->id_author}, ISBN: {$this->ISBN}, Año: {$this->date_publication}";
    }
}
