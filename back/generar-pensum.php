<?php
session_start();

// Verificar si la sesión contiene id_carrera
if (!isset($_SESSION['id_carrera'])) {
    // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de error
    
}

$id_carrera = $_SESSION['id_carrera'];

// Crear un array que mapee los id_carrera a sus respectivos archivos PHP
$mapa_pensums = array(
    1 => 'pensum-medicina.php',
    2 => 'pensum-odontologia.php',
    3 => 'pensum-informatica.php',
    4 => 'pensum-ingenieria-civil.php',
    5 => 'pensum-administracion-comercial.php',
    6 => 'pensum-derechos.php',
    7 => 'pensum-comunicacion-social.php',

    // Añadir más mapeos según sea necesario
);

// Verificar si existe un archivo mapeado para el id_carrera
if (array_key_exists($id_carrera, $mapa_pensums)) {
    include('../pensum/' . $mapa_pensums[$id_carrera]);
} else {
    die("No existe un pensum para la carrera con ID: " . $id_carrera);
}
?>
