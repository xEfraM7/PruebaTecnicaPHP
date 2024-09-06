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



    // Obtener el autor a editar
    if (isset($_GET['edit'])) {
        $author = $authorController->getAuthorById($_GET['edit']);
    } else {
        header('Location: authorView.php');
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
    <title>Editar Autor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007BFF;
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
    <h1>Editar Autor</h1>
    <form method="POST">
        <input type="hidden" name="id_author" value="<?php echo htmlspecialchars($author['id_author']); ?>">
        
        <label for="author_name">Nombre:</label>
        <input type="text" id="author_name" name="author_name" value="<?php echo htmlspecialchars($author['author_name']); ?>" required>
        
        <label for="author_lastName">Apellido:</label>
        <input type="text" id="author_lastName" name="author_lastName" value="<?php echo htmlspecialchars($author['author_lastName']); ?>" required>
        
        <label for="birth_date">Fecha de Nacimiento:</label>
        <input type="date" id="birth_date" name="birth_date" value="<?php echo htmlspecialchars($author['birth_date']); ?>" required>
        
        <label for="biography">Biografía:</label>
        <textarea id="biography" name="biography" required><?php echo htmlspecialchars($author['biography']); ?></textarea>
        
        <input type="submit" name="update" value="Actualizar Autor">
    </form>
    <a href="authorView.php">Volver a la lista de autores</a>
</body>
</html>
