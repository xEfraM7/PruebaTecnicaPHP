<?php
require_once "../controllers/BookController.php";
require_once "../controllers/AuthorController.php"; // Para obtener la lista de autores

// Configuración de la conexión a la base de datos
$dsn = 'pgsql:host=localhost;dbname=course-db';
$username = 'root';
$password = '2151';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia de los controladores
    $bookController = new BookController($pdo);
    $authorController = new AuthorController($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Actualizar el libro
        $bookController->updateBook(
            $_POST['id_book'],
            $_POST['title'],
            $_POST['ISBN'],
            $_POST['date_publication'],
            $_POST['id_author']
        );
        header('Location: bookView.php'); // Redirigir después de la actualización
        exit;
    }

    // Obtener el libro a editar
    if (isset($_GET['edit'])) {
        $book = $bookController->getBookById($_GET['edit']);
        $authors = $authorController->getAllAuthors(); // Obtener autores para el dropdown
    } else {
        header('Location: bookView.php');
        exit;
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            color: #0056b3;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            form {
                padding: 15px;
            }

            input[type="submit"] {
                font-size: 0.9rem;
            }

            a {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <h1>Editar Libro</h1>
    <form method="POST">
        <input type="hidden" name="id_book" value="<?php echo htmlspecialchars($book['id_book']); ?>">
        
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        
        <label for="ISBN">ISBN:</label>
        <input type="text" id="ISBN" name="ISBN" value="<?php echo htmlspecialchars($book['ISBN']); ?>" required>
        
        <label for="date_publication">Fecha de Publicación:</label>
        <input type="date" id="date_publication" name="date_publication" value="<?php echo htmlspecialchars($book['date_publication']); ?>" required>
        
        <label for="id_author">Autor:</label>
        <select id="id_author" name="id_author" required>
            <?php foreach ($authors as $author): ?>
            <option value="<?php echo htmlspecialchars($author['id_author']); ?>" <?php echo ($author['id_author'] == $book['id_author']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($author['author_name']) . ' ' . htmlspecialchars($author['author_lastName']); ?>
            </option>
            <?php endforeach; ?>
        </select>
        
        <input type="submit" name="update" value="Actualizar Libro">
    </form>
    <a href="bookView.php">Volver a la lista de libros</a

