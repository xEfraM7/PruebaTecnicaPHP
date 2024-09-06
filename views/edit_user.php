<?php
require_once "../controllers/UserController.php";

// Configuración de la conexión a la base de datos
$dsn = 'pgsql:host=localhost;dbname=course-db';
$username = 'root';
$password = '2151';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia del controlador
    $userController = new UserController($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        // Actualizar el usuario
        $userController->updateUser(
            $_POST['id_user'],
            $_POST['user_name'],
            $_POST['user_lastName'],
            $_POST['email'],
            $_POST['register_date']
        );
        header('Location: userView.php'); // Redirigir después de la actualización
        exit;
    }

    // Obtener el usuario a editar
    if (isset($_GET['edit'])) {
        $user = $userController->getUserById($_GET['edit']);
    } else {
        header('Location: userView.php');
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
    <title>Editar Usuario</title>
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
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
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
    <h1>Editar Usuario</h1>
    <form method="POST">
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user['id_user']); ?>">
        
        <label for="user_name">Nombre:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
        
        <label for="user_lastName">Apellido:</label>
        <input type="text" id="user_lastName" name="user_lastName" value="<?php echo htmlspecialchars($user['user_lastName']); ?>" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        
        <label for="register_date">Fecha de Registro:</label>
        <input type="date" id="register_date" name="register_date" value="<?php echo htmlspecialchars($user['register_date']); ?>" required>
        
        <input type="submit" name="update" value="Actualizar Usuario">
    </form>
    <a href="userView.php">Volver a la lista de usuarios</a>
</body>
</html>



