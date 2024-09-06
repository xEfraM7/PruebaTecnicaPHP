<?php
require "../controllers/LoanController.php";
require "../controllers/BookController.php";
require "../controllers/UserController.php";

// Configuración de la conexión a la base de datos
$dsn = 'pgsql:host=localhost;dbname=course-db';
$username = 'root';
$password = '2151';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear una instancia del controlador
    $loanController = new LoanController($pdo);
    $bookController = new BookController($pdo);
    $userController = new UserController($pdo);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['create'])) {
            $loanController->createLoan($_POST['id_book'], $_POST['id_user'], $_POST['loan_date'], $_POST['regret_date']);
        } elseif (isset($_POST['update'])) {
            $loanController->updateLoan($_POST['id_loan'], $_POST['id_book'], $_POST['id_user'], $_POST['loan_date'], $_POST['regret_date']);
        } elseif (isset($_POST['delete'])) {
            $loanController->deleteLoan($_POST['id_loan']);
        }
        // Redirigir para evitar el envío de formulario repetido
        header('Location: loanView.php');
        exit;
    }

    if (isset($_GET['edit'])) {
        $userToEdit = $loanController->getLoanById($_GET['edit']);
    }

    if (isset($_GET['delete'])) {
        $loanController->deleteLoan($_GET['delete']);
        header('Location: loanView.php');
        exit;
    }

    $loans = $loanController->getAllLoans();
    $books = $bookController->listBooks();
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
    <title>Gestión de Préstamos</title>
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
        <h1>Gestión de Préstamos</h1>

        <!-- Botón para ir al inicio -->
        <a href="index.php" class="button">Ir al Inicio</a>

        <!-- Formulario para crear préstamo -->
        <h2>Crear Préstamo</h2>
        <form method="POST">
            <label for="id_book">Libro:</label>
            <select id="id_book" name="id_book" required>
                <?php foreach ($books as $book): ?>
                <option value="<?php echo htmlspecialchars($book['id_book']); ?>"><?php echo htmlspecialchars($book['title']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="id_user">Usuario:</label>
            <select id="id_user" name="id_user" required>
                <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id_user']); ?>"><?php echo htmlspecialchars($user['user_name']) . ' ' . htmlspecialchars($user['user_lastName']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="loan_date">Fecha de Préstamo:</label>
            <input type="date" id="loan_date" name="loan_date" required><br>
            <label for="regret_date">Fecha de Devolución:</label>
            <input type="date" id="regret_date" name="regret_date"><br>
            <input type="submit" name="create" value="Crear Préstamo">
        </form>

        <!-- Tabla de préstamos -->
        <h2>Préstamos Existentes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Libro</th>
                <th>Usuario</th>
                <th>Fecha de Préstamo</th>
                <th>Fecha de Devolución</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($loans as $loan): ?>
            <tr>
                <td><?php echo htmlspecialchars($loan['id_loan']); ?></td>
                <td><?php echo htmlspecialchars($loan['id_book']); ?></td>
                <td><?php echo htmlspecialchars($loan['id_user']); ?></td>
                <td><?php echo htmlspecialchars($loan['loan_date']); ?></td>
                <td><?php echo htmlspecialchars($loan['regret_date']); ?></td>
                <td>
                    <a href="loanView.php?edit=<?php echo $loan['id_loan']; ?>">Editar</a>
                    <a href="loanView.php?delete=<?php echo $loan['id_loan']; ?>">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Formulario para editar préstamo -->
        <?php if (isset($_GET['edit'])): ?>
        <?php
        $loanToEdit = $loanController->getLoanById($_GET['edit']);
        ?>
        <h2>Editar Préstamo</h2>
        <form method="POST">
            <input type="hidden" name="id_loan" value="<?php echo htmlspecialchars($loanToEdit['id_loan']); ?>">
            <label for="id_book">Libro:</label>
            <select id="id_book" name="id_book" required>
                <?php foreach ($books as $book): ?>
                <option value="<?php echo htmlspecialchars($book['id_book']); ?>" <?php echo ($book['id_book'] == $loanToEdit['id_book']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($book['title']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="id_user">Usuario:</label>
            <select id="id_user" name="id_user" required>
                <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id_user']); ?>" <?php echo ($user['id_user'] == $loanToEdit['id_user']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($user['user_name']) . ' ' . htmlspecialchars($user['user_lastName']); ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="loan_date">Fecha de Préstamo:</label>
            <input type="date" id="loan_date" name="loan_date" value="<?php echo htmlspecialchars($loanToEdit['loan_date']); ?>" required><br>
            <label for="regret_date">Fecha de Devolución:</label>
            <input type="date" id="regret_date" name="regret_date" value="<?php echo htmlspecialchars($loanToEdit['regret_date']); ?>"><br>
            <input type="submit" name="update" value="Actualizar Préstamo">
        </form>
        <?php endif; ?>

        <!-- Eliminación de préstamo -->
        <?php if (isset($_GET['delete'])): ?>
        <?php
        $loanController->deleteLoan($_GET['delete']);
        header('Location: loanView.php');
        exit;
        ?>
        <?php endif; ?>
    </div>
</body>
</html>
