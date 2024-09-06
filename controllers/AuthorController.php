<?php

class AuthorController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un nuevo autor
    public function createAuthor($authorName, $authorLastName, $birthDate, $biography) {
        $sql = "INSERT INTO \"Author\" (\"author_name\", \"author_lastName\", \"birth_date\", \"biography\")
                VALUES (:author_name, :author_lastName, :birth_date, :biography)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':author_name', $authorName);
        $stmt->bindParam(':author_lastName', $authorLastName);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':biography', $biography);
        return $stmt->execute();
    }

    // Leer todos los autores
    public function getAllAuthors() {
        $sql = "SELECT * FROM \"Author\"";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un autor por ID
    public function getAuthorById($idAuthor) {
        $sql = "SELECT * FROM \"Author\" WHERE \"id_author\" = :id_author";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_author', $idAuthor);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un autor
    public function updateAuthor($idAuthor, $authorName, $authorLastName, $birthDate, $biography) {
        $sql = "UPDATE \"Author\" 
                SET \"author_name\" = :author_name, 
                    \"author_lastName\" = :author_lastName, 
                    \"birth_date\" = :birth_date, 
                    \"biography\" = :biography
                WHERE \"id_author\" = :id_author";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_author', $idAuthor);
        $stmt->bindParam(':author_name', $authorName);
        $stmt->bindParam(':author_lastName', $authorLastName);
        $stmt->bindParam(':birth_date', $birthDate);
        $stmt->bindParam(':biography', $biography);
        return $stmt->execute();
    }

    // Eliminar un autor
    public function deleteAuthor($idAuthor) {
        $sql = "DELETE FROM \"Author\" WHERE \"id_author\" = :id_author";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_author', $idAuthor);
        return $stmt->execute();
    }
}


