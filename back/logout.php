<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalmente, destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión u otra página después de cerrar sesión
header("location: ../index.php");
exit;
?>
