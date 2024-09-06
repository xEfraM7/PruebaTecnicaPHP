<?php
class BookController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new book
    public function createBook($title, $ISBN, $date_publication, $id_author) {
        $sql = "INSERT INTO \"Book\" (\"title\", \"ISBN\", \"date_publication\", \"id_author\") VALUES (:title, :ISBN, :date_publication, :id_author)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':ISBN', $ISBN);
        $stmt->bindParam(':date_publication', $date_publication);
        $stmt->bindParam(':id_author', $id_author);
        return $stmt->execute();
    }

    // Read a book by its ID
    public function getBookById($id_book) {
        $sql = "SELECT * FROM \"Book\" WHERE \"id_book\" = :id_book";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_book', $id_book);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a book's details
    public function updateBook($id_book, $title, $ISBN, $date_publication, $id_author) {
        $sql = "UPDATE \"Book\" SET \"title\" = :title, \"ISBN\" = :ISBN, \"date_publication\" = :date_publication, \"id_author\" = :id_author WHERE \"id_book\" = :id_book";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_book', $id_book);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':ISBN', $ISBN);
        $stmt->bindParam(':date_publication', $date_publication);
        $stmt->bindParam(':id_author', $id_author);
        return $stmt->execute();
    }

    // Delete a book by its ID
    public function deleteBook($id_book) {
        $sql = "DELETE FROM \"Book\" WHERE \"id_book\" = :id_book";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_book', $id_book);
        return $stmt->execute();
    }

    // List all books
    public function listBooks() {
        $sql = "SELECT * FROM \"Book\"";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
