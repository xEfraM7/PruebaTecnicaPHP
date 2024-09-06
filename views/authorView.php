<?php
require_once "../controllers/AuthorController.php";

// Configuración de la conexión a la base de datos
$dsn = 'pgsql:host=localhost;dbname=course-db';
$username = 'root';
$password = '2151';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia del controlador
    $authorController = new AuthorController($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            $authorController->createAuthor($_POST['author_name'], $_POST['author_lastName'], $_POST['birth_date'], $_POST['biography']);
        } /*elseif (isset($_POST['update'])) {
            $loanController->updateLoan($_POST['id_loan'], $_POST['id_book'], $_POST['id_user'], $_POST['loan_date'], $_POST['regret_date']);
        } elseif (isset($_POST['delete'])) {
            $loanController->deleteLoan($_POST['id_loan']);
        }*/
        // Redirigir para evitar el envío de formulario repetido
        header('Location: authorView.php');
        exit;
    }

    if (isset($_GET['edit'])) {
        $userToEdit = $authorController->getAuthorById($_GET['edit']);
    }

    if (isset($_GET['delete'])) {
        $authorController->deleteAuthor($_GET['delete']);
        header('Location: authorView.php');
        exit;
    }

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
    <title>Gestión de Autores</title>
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
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
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
        <h1>Gestión de Autores</h1>

        <!-- Botón para ir al inicio -->
        <a href="index.php" class="button">Ir al Inicio</a>

        <!-- Formulario para crear autor -->
        <h2>Crear Autor</h2>
        <form method="POST">
            <label for="author_name">Nombre:</label>
            <input type="text" id="author_name" name="author_name" required><br>
            <label for="author_lastName">Apellido:</label>
            <input type="text" id="author_lastName" name="author_lastName" required><br>
            <label for="birth_date">Fecha de Nacimiento:</label>
            <input type="date" id="birth_date" name="birth_date"><br>
            <label for="biography">Biografía:</label>
            <textarea id="biography" name="biography"></textarea><br>
            <input type="submit" name="create" value="Crear Autor">
        </form>

        <!-- Tabla de autores -->
        <h2>Autores Existentes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Biografía</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($authors as $author): ?>
            <tr>
                <td><?php echo htmlspecialchars($author['id_author']); ?></td>
                <td><?php echo htmlspecialchars($author['author_name']); ?></td>
                <td><?php echo htmlspecialchars($author['author_lastName']); ?></td>
                <td><?php echo htmlspecialchars($author['birth_date']); ?></td>
                <td><?php echo htmlspecialchars($author['biography']); ?></td>
                <td>
                    <a href="edit_author.php?edit=<?php echo $author['id_author']; ?>">Editar</a>
                    <a href="authorView.php?delete=<?php echo $author['id_author']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
