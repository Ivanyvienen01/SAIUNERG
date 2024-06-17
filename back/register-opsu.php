<?php
// Incluir archivo de conexión
include 'conection.php';

// Consulta SQL para obtener los nombres de las carreras
$sql = "SELECT id_carrera, nombre_carrera FROM carreras";
$result = $conn->query($sql);

// Verificar si se han enviado datos por el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_register_opsu'])) {
    // Obtener datos del formulario
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $CI = $_POST['CI'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $tipo_ingreso = $_POST['tipo_ingreso'];
    $nombre_carrera = $_POST['carrera']; // Obtener el nombre de la carrera seleccionada

    // Verificar que las contraseñas coinciden y tienen entre 8 y 12 caracteres
    if ($password !== $confirm_password) {
        $error_message = "Las contraseñas no coinciden. Por favor, inténtalo de nuevo.";
    } elseif (strlen($password) < 8 || strlen($password) > 12) {
        $error_message = "La contraseña debe tener entre 8 y 12 caracteres.";
    } else {
        // Verificar si el usuario ya está registrado por correo electrónico o cédula en alguna de las tablas
        $sql_check = "(SELECT correo FROM preinscripciones WHERE correo = ?)
                      UNION
                      (SELECT correo FROM estudiantes WHERE correo = ?)
                      UNION
                      (SELECT cedula FROM preinscripciones WHERE cedula = ?)
                      UNION
                      (SELECT cedula FROM estudiantes WHERE cedula = ?)";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('ssss', $email, $email, $CI, $CI);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        
        if ($result_check->num_rows > 0) {
            $error_message = "El correo electrónico o la cédula ya están registrados.";
        } else {
            // Obtener id_carrera basado en nombre_carrera
            $stmt_carrera = $conn->prepare("SELECT id_carrera FROM carreras WHERE nombre_carrera = ?");
            $stmt_carrera->bind_param('s', $nombre_carrera);
            $stmt_carrera->execute();
            $result_carrera = $stmt_carrera->get_result();
            if ($result_carrera->num_rows > 0) {
                $row_carrera = $result_carrera->fetch_assoc();
                $id_carrera = $row_carrera['id_carrera'];
                
                // Preparar la consulta SQL para insertar los datos en la primera tabla
                $sql_insert = "INSERT INTO preinscripciones (nombres, apellidos, correo, cedula, contraseña, tipo_ingreso, nombre_carrera, id_carrera) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param('sssssssi', $name, $lastname, $email, $CI, $password, $tipo_ingreso, $nombre_carrera, $id_carrera);

                // Ejecutar la consulta SQL de inserción
                if ($stmt_insert->execute()) {
                    $success_message = "Registro Completado con Éxito";
                } else {
                    $error_message = "Error al Completar el Registro: " . $stmt_insert->error;
                }
            } else {
                $error_message = "Carrera no encontrada. Por favor, selecciona una carrera válida.";
            }
        }
        $stmt_check->close();
    }
}
?>
