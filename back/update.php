<?php
// Incluir archivo de conexión
include 'conection.php';

// Iniciar sesión si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Recuperar información del usuario desde la base de datos utilizando su correo electrónico
    $correo = $_SESSION['correo'];

    // Primero, intentaremos buscar en la tabla 'estudiantes'
    $sql_user_info = $conn->prepare("SELECT * FROM estudiantes WHERE correo = ?");
    $sql_user_info->bind_param("s", $correo);
    $sql_user_info->execute();
    $result_user_info = $sql_user_info->get_result();

    if ($result_user_info->num_rows > 0) {
        $user_info = $result_user_info->fetch_assoc();
    } else {
        // Si no se encuentra en la tabla 'estudiantes', buscamos en la segunda tabla
        $sql_user_info = $conn->prepare("SELECT * FROM preinscripciones WHERE correo = ?");
        $sql_user_info->bind_param("s", $correo);
        $sql_user_info->execute();
        $result_user_info = $sql_user_info->get_result();

        if ($result_user_info->num_rows > 0) {
            $user_info = $result_user_info->fetch_assoc();
        } else {
            echo "No se encontró información del usuario.";
        }
    }
}

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_accept'])) {
    // Recuperar los datos del formulario
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $civilstatus = $_POST['civilstatus'];
    
    // Recuperar los nombres de estado y ciudad/municipio del formulario
    $estado_id = $_POST['estado'];
    $cm_id = $_POST['cm'];

    // Obtener los nombres correspondientes a los IDs seleccionados
    $query_estado = "SELECT nombre FROM estados WHERE id = ?";
    $stmt_estado = $conn->prepare($query_estado);
    $stmt_estado->bind_param("i", $estado_id);
    $stmt_estado->execute();
    $result_estado = $stmt_estado->get_result();
    $nombre_estado = $result_estado->fetch_assoc()['nombre'];
    $stmt_estado->close();

    $query_cm = "SELECT nombre FROM ciudades_municipios WHERE id = ?";
    $stmt_cm = $conn->prepare($query_cm);
    $stmt_cm->bind_param("i", $cm_id);
    $stmt_cm->execute();
    $result_cm = $stmt_cm->get_result();
    $nombre_cm = $result_cm->fetch_assoc()['nombre'];
    $stmt_cm->close();

    // Actualizar los datos del usuario en la tabla "estudiantes"
    $sql_update = $conn->prepare("UPDATE estudiantes SET nombres = ?, apellidos = ?, correo = ?, telefono = ?, fecha_nacimiento = ?, direccion = ?, genero = ?, estado_civil = ?, estado = ?, ciudad_municipio = ? WHERE correo = ?");
    $sql_update->bind_param("sssssssssss", $name, $lastname, $email, $phone, $birthdate, $address, $gender, $civilstatus, $nombre_estado, $nombre_cm, $correo);
    $sql_update->execute();

    // Verificar si la actualización fue exitosa
    if ($sql_update->affected_rows > 0) {
        $success_message = "Los datos del usuario se actualizaron correctamente.";
    } else {
        $error_message = "Error al actualizar los datos del usuario.";
    }
}

// Verificar si se ha enviado el formulario de cambio de contraseña
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    // Recuperar la nueva contraseña del formulario
    $new_password = $_POST['new_password'];

    // Actualizar la contraseña del usuario en la tabla "estudiantes"
    $sql_update_password = $conn->prepare("UPDATE estudiantes SET contraseña = ? WHERE correo = ?");
    $sql_update_password->bind_param("ss", $new_password, $correo);
    $sql_update_password->execute();

    // Verificar si la actualización fue exitosa
    if ($sql_update_password->affected_rows > 0) {
        $success_message_password = "La contraseña se cambió correctamente.";
    } else {
        $error_message_password = "Error al cambiar la contraseña.";
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>
