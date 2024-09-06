<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Gestión</title>
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

        nav {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            font-size: 1.2rem;
        }

        a:hover {
            color: #0056b3;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            a {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <h1>Gestión de Biblioteca</h1>
    <nav>
        <ul>
            <li><a href="/views/userView.php">Gestión de Usuarios</a></li>
            <li><a href="/views/authorView.php">Gestión de Autores</a></li>
            <li><a href="/views/bookView.php">Gestión de Libros</a></li>
            <li><a href="/views/loanView.php">Gestión de Préstamos</a></li>
        </ul>
    </nav>
</body>
</html>
