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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            $userController->createUser($_POST['user_name'], $_POST['user_lastName'], $_POST['email'], $_POST['register_date']);
        } elseif (isset($_POST['update'])) {
            $userController->updateUser($_POST['id_user'], $_POST['user_name'], $_POST['user_lastName'], $_POST['email'], $_POST['register_date']);
        } elseif (isset($_POST['delete'])) {
            $userController->deleteUser($_POST['id_user']);
        }
        // Redirigir para evitar el envío de formulario repetido
        header('Location: userView.php');
        exit;
    }

    if (isset($_GET['edit'])) {
        $userToEdit = $userController->getUserById($_GET['edit']);
    }

    if (isset($_GET['delete'])) {
        $userController->deleteUser($_GET['delete']);
        header('Location: userView.php');
        exit;
    }

    $users = $userController->getAllUsers();
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
        input[type="text"], input[type="email"], input[type="date"] {
            width: 100%;
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
        <h1>Gestión de Usuarios</h1>

        <!-- Botón para ir al inicio -->
        <a href="index.php" class="button">Ir al Inicio</a>

        <!-- Formulario para crear usuario -->
        <h2>Crear Usuario</h2>
        <form method="POST">
            <label for="user_name">Nombre:</label>
            <input type="text" id="user_name" name="user_name" required><br>
            <label for="user_lastName">Apellido:</label>
            <input type="text" id="user_lastName" name="user_lastName" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="register_date">Fecha de Registro:</label>
            <input type="date" id="register_date" name="register_date" required><br>
            <input type="submit" name="create" value="Crear Usuario">
        </form>

        <!-- Tabla de usuarios -->
        <h2>Usuarios Existentes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id_user']); ?></td>
                <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                <td><?php echo htmlspecialchars($user['user_lastName']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['register_date']); ?></td>
                <td>
                    <a href="edit_user.php?edit=<?php echo $user['id_user']; ?>">Editar</a>
                    <a href="userView.php?delete=<?php echo $user['id_user']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Formulario para editar usuario -->

    </div>
</body>
</html>
