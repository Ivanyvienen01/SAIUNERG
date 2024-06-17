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
    $sql_user_info = $conn->prepare("SELECT * FROM estudiantes WHERE correo = ?");
    $sql_user_info->bind_param("s", $correo);
    $sql_user_info->execute();
    $result_user_info = $sql_user_info->get_result();

    if ($result_user_info->num_rows > 0) {
        $user_info = $result_user_info->fetch_assoc();
        // Asegurarse de almacenar el id_carrera y apellidos en la sesión
        $_SESSION['id_carrera'] = $user_info['id_carrera'];
        $_SESSION['apellidos_usuario'] = $user_info['apellidos'];
    } else {
        echo "No se encontró información del usuario.";
    }
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_login'])) {
    // Recuperar los datos del formulario
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Verificar las credenciales del usuario en la tabla "estudiantes"
    $sql = $conn->prepare("SELECT id, nombres, apellidos, id_carrera FROM estudiantes WHERE correo = ? AND contraseña = ?");
    $sql->bind_param("ss", $correo, $contraseña);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        // Iniciar sesión
        $_SESSION['loggedin'] = true;
        $_SESSION['correo'] = $correo;
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['nombres_usuario'] = $row['nombres'];
        $_SESSION['apellidos_usuario'] = $row['apellidos'];
        $_SESSION['id_carrera'] = $row['id_carrera'];

        // Redireccionar a una página de éxito o a la página principal
        header('Location: ./front/home-student-active.php');
        exit;
    } else {
        // Si no se encontraron coincidencias en la tabla "estudiantes", verificar en la segunda tabla
        $sql_second_table = $conn->prepare("SELECT id, nombres, apellidos, id_carrera FROM preinscripciones WHERE correo = ? AND contraseña = ?");
        $sql_second_table->bind_param("ss", $correo, $contraseña);
        $sql_second_table->execute();
        $result_second_table = $sql_second_table->get_result();

        if ($result_second_table->num_rows > 0) {
            // Iniciar sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['correo'] = $correo;
            $row = $result_second_table->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nombres_usuario'] = $row['nombres'];
            $_SESSION['apellidos_usuario'] = $row['apellidos'];
            $_SESSION['id_carrera'] = $row['id_carrera'];

            // Redireccionar a una página de éxito o a la página principal
            header('Location: ./front/home-student-inactive.php');
            exit;
        } else {
            // Si no se encontraron coincidencias en la segunda tabla, verificar en la tercera tabla
            $sql_third_table = $conn->prepare("SELECT id FROM administrador WHERE usuario = ? AND contraseña = ?");
            $sql_third_table->bind_param("ss", $correo, $contraseña);
            $sql_third_table->execute();
            $result_third_table = $sql_third_table->get_result();

            if ($result_third_table->num_rows > 0) {
                // Iniciar sesión
                $_SESSION['loggedin'] = true;
                $_SESSION['correo'] = $correo;
                $row = $result_third_table->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];
                // Redireccionar a una página de éxito o a la página principal
                header('Location: ./front/administrator.php');
                exit();
            } else {
                // Mostrar mensaje de error si no se encontraron coincidencias en ninguna tabla
                $error_message = "Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.";
            }
        }
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>
