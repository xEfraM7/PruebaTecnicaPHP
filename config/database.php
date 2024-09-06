<?php
$host = 'localhost';       // O la dirección de tu servidor PostgreSQL
$db   = 'course-db'; // El nombre de tu base de datos
$user = 'root';         // Tu usuario de PostgreSQL
$pass = '2151';     // Tu contraseña de PostgreSQL
$port = '5432';           // El puerto por defecto de PostgreSQL

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO($dsn, $user, $pass);
    // Configurar el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa.";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
