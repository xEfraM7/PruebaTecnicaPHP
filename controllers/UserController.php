<?php

class UserController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Crear un nuevo usuario
    public function createUser($userName, $userLastName, $email, $registerDate) {
        $sql = "INSERT INTO \"User\" (\"user_name\", \"user_lastName\", \"email\", \"register_date\")
                VALUES (:user_name, :user_lastName, :email, :register_date)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':user_lastName', $userLastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':register_date', $registerDate);
        return $stmt->execute();
    }

    // Leer todos los usuarios
    public function getAllUsers() {
        $sql = "SELECT * FROM \"User\"";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un usuario por ID
    public function getUserById($idUser) {
        $sql = "SELECT * FROM \"User\" WHERE \"id_user\" = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un usuario
    public function updateUser($idUser, $userName, $userLastName, $email, $registerDate) {
        $sql = "UPDATE \"User\" 
                SET \"user_name\" = :user_name, 
                    \"user_lastName\" = :user_lastName, 
                    \"email\" = :email, 
                    \"register_date\" = :register_date
                WHERE \"id_user\" = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':user_lastName', $userLastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':register_date', $registerDate);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function deleteUser($idUser) {
        $sql = "DELETE FROM \"User\" WHERE \"id_user\" = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $idUser);
        return $stmt->execute();
    }

    // Obtener un usuario por nombre
    public function getUserByName($userName) {
        $sql = "SELECT * FROM \"User\" WHERE \"user_name\" = :user_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_name', $userName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
