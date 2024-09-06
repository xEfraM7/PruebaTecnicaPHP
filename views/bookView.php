<?php
require_once "../controllers/BookController.php";
require_once "../controllers/AuthorController.php";

// Configuración de la conexión a la base de datos
$dsn = 'pgsql:host=localhost;dbname=course-db';
$username = 'root';
$password = '2151';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia del controlador
    $bookController = new BookController($pdo);
    $authorController = new AuthorController($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            $bookController->createBook($_POST['title'], $_POST['ISBN'], $_POST['date_publication'], $_POST['id_author']);
        } /*elseif (isset($_POST['update'])) {
            $loanController->updateLoan($_POST['id_loan'], $_POST['id_book'], $_POST['id_user'], $_POST['loan_date'], $_POST['regret_date']);
        } elseif (isset($_POST['delete'])) {
            $loanController->deleteLoan($_POST['id_loan']);
        }*/
        // Redirigir para evitar el envío de formulario repetido
        header('Location: bookView.php');
        exit;
    }

    if (isset($_GET['delete'])) {
        $authorController->deleteAuthor($_GET['delete']);
        header('Location: bookView.php');
        exit;
    }

    $books = $bookController->listBooks();
    $authors = $authorController->getAllAuthors();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 5px 0;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            width: 100%;
            height: 100px;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Libros</h1>

        <!-- Botón para ir al inicio -->
        <a href="index.php" class="button">Ir al Inicio</a>

        <!-- Formulario para crear libro -->
        <h2>Crear Libro</h2>
        <form method="POST">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required><br>
            <label for="ISBN">ISBN:</label>
            <input type="text" id="ISBN" name="ISBN" required><br>
            <label for="date_publication">Fecha de Publicación:</label>
            <input type="date" id="date_publication" name="date_publication" required><br>
            <label for="id_author">Autor:</label>
            <select id="id_author" name="id_author" required>
                <?php foreach ($authors as $author): ?>
                <option value="<?php echo htmlspecialchars($author['id_author']); ?>"><?php echo htmlspecialchars($author['author_name']) . ' ' . htmlspecialchars($author['author_lastName']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <input type="submit" name="create" value="Crear Libro">
        </form>

        <!-- Tabla de libros -->
        <h2>Libros Existentes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>ISBN</th>
                <th>Fecha de Publicación</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo htmlspecialchars($book['id_book']); ?></td>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['ISBN']); ?></td>
                <td><?php echo htmlspecialchars($book['date_publication']); ?></td>
                <td><?php echo htmlspecialchars($book['id_author']); ?></td>
                <td>
                    <a href="edit_book.php?edit=<?php echo htmlspecialchars($book['id_book']); ?>">Editar</a>
                    <a href="bookView.php?delete=<?php echo $book['id_book']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
