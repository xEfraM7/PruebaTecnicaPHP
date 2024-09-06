<?php

class Loan {
    private $id_loan;
    private $id_book;
    private $id_user;
    private $loan_date;
    private $regret_date;

    public function __construct($id_loan = null, $id_book, $id_user, $loan_date, $regret_date) {
        $this->id_loan = $id_loan;
        $this->id_book = $id_book;
        $this->id_user = $id_user;
        $this->loan_date = $loan_date;
        $this->regret_date = $regret_date;
    }

    public function getIdLoan() {
        return $this->id_loan;
    }

    public function getIdBook() {
        return $this->id_book;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function getLoanDate() {
        return $this->loan_date;
    }

    public function getRegretDate() {
        return $this->regret_date;
    }

    public function setIdLoan($id_loan) {
        $this->id_loan = $id_loan;
    }

    public function setIdBook($id_book) {
        $this->id_book = $id_book;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function setLoanDate($loan_date) {
        $this->loan_date = $loan_date;
    }

    public function setRegretDate($regret_date) {
        $this->regret_date = $regret_date;
    }

    public function registrarPrestamo($id_book, $id_user, $loan_date, $regret_date) {
        $this->id_book = $id_book;
        $this->id_user = $id_user;
        $this->loan_date = $loan_date;
        $this->regret_date = $regret_date;
    }

    public function extenderFechaDevolucion($newDate) {
        $this->regret_date = $newDate;
    }

    public function mostrarInformacion() {
        return "Libro ID: {$this->id_book}, Usuario ID: {$this->id_user}, Fecha de Préstamo: {$this->loan_date}, Fecha de Devolución: {$this->regret_date}";
    }
}
