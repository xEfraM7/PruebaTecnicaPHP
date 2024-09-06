

<?php

class LoanController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    

    // Crear un nuevo préstamo
    public function createLoan($idBook, $idUser, $loanDate, $regretDate) {
        $sql = "INSERT INTO \"Loan\" (\"id_book\", \"id_user\", \"loan_date\", \"regret_date\")
                VALUES (:id_book, :id_user, :loan_date, :regret_date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_book', $idBook);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':loan_date', $loanDate);
        $stmt->bindParam(':regret_date', $regretDate);
        return $stmt->execute();
    }

    // Leer todos los préstamos
    public function getAllLoans() {
        $sql = "SELECT * FROM \"Loan\"";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un préstamo por ID
    public function getLoanById($idLoan) {
        $sql = "SELECT * FROM \"Loan\" WHERE \"id_loan\" = :id_loan";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_loan', $idLoan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un préstamo
    public function updateLoan($idLoan, $idBook, $idUser, $loanDate, $regretDate) {
        $sql = "UPDATE \"Loan\" 
                SET \"id_book\" = :id_book, 
                    \"id_user\" = :id_user, 
                    \"loan_date\" = :loan_date, 
                    \"regret_date\" = :regret_date
                WHERE \"id_loan\" = :id_loan";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_loan', $idLoan);
        $stmt->bindParam(':id_book', $idBook);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':loan_date', $loanDate);
        $stmt->bindParam(':regret_date', $regretDate);
        return $stmt->execute();
    }

    // Eliminar un préstamo
    public function deleteLoan($idLoan) {
        $sql = "DELETE FROM \"Loan\" WHERE \"id_loan\" = :id_loan";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_loan', $idLoan);
        return $stmt->execute();
    }

    // Extender la fecha de devolución de un préstamo
    public function extendReturnDate($idLoan, $newReturnDate) {
        $sql = "UPDATE \"Loan\" 
                SET \"regret_date\" = :regret_date
                WHERE \"id_loan\" = :id_loan";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_loan', $idLoan);
        $stmt->bindParam(':regret_date', $newReturnDate);
        return $stmt->execute();
    }

    // Obtener todos los préstamos actuales de un usuario
    public function getLoansByUser($idUser) {
        $sql = "SELECT * FROM \"Loan\" WHERE \"id_user\" = :id_user AND \"regret_date\" IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
