<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "saiunerg";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
