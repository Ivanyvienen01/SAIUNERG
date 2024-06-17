<?php
// Incluir archivo de conexión
include 'conection.php';

// Iniciar sesión si no está ya iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se ha enviado el formulario de migración de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_accept'])) {
        // Recuperar el ID del usuario a aceptar
        $usuario_id = $_POST['usuario_id'];
        
        // Obtener los datos del usuario a migrar
        $sql_select = "SELECT * FROM preinscripciones WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $usuario_id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        
        if ($result_select->num_rows > 0) {
            // Obtener los datos del usuario
            $row = $result_select->fetch_assoc();
            $cedula = $row['cedula'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $correo = $row['correo'];
            $contraseña = $row['contraseña'];
            $condicion = $_POST['condicion'];
            $nombre_carrera = $row['nombre_carrera'];
            $tipo_ingreso = $row['tipo_ingreso'];
            $fecha_inscripcion = $row['fecha_inscripcion']; // Mantener la fecha de inscripción original

            // Buscar el id_carrera en la tabla carreras
            $sql_get_carrera = "SELECT id_carrera FROM carreras WHERE nombre_carrera = ?";
            $stmt_get_carrera = $conn->prepare($sql_get_carrera);
            $stmt_get_carrera->bind_param("s", $nombre_carrera);
            $stmt_get_carrera->execute();
            $result_get_carrera = $stmt_get_carrera->get_result();
            
            if ($result_get_carrera->num_rows > 0) {
                // Obtener el id_carrera
                $row_carrera = $result_get_carrera->fetch_assoc();
                $id_carrera = $row_carrera['id_carrera'];

                // Insertar el usuario migrado en la nueva tabla
                $sql_insert = "INSERT INTO estudiantes (cedula, nombres, apellidos, correo, contraseña, condicion, id_carrera, nombre_carrera, tipo_ingreso, fecha_inscripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("ssssssisss", $cedula, $nombres, $apellidos, $correo, $contraseña, $condicion, $id_carrera, $nombre_carrera, $tipo_ingreso, $fecha_inscripcion);

                if ($stmt_insert->execute()) {
                    // Eliminar el usuario de la tabla original después de migrarlo
                    $sql_delete = "DELETE FROM preinscripciones WHERE id = ?";
                    $stmt_delete = $conn->prepare($sql_delete);
                    $stmt_delete->bind_param("i", $usuario_id);
                    if ($stmt_delete->execute()) {
                        // Migración exitosa
                        $success_message = "El usuario ha sido migrado exitosamente.";
                    } else {
                        $error_message = "Error al eliminar el usuario de la tabla original: " . $stmt_delete->error;
                    }
                } else {
                    $error_message = "Error al migrar el usuario a la nueva tabla: " . $stmt_insert->error;
                }
            } else {
                $error_message = "No se encontró el id_carrera para la carrera: " . $nombre_carrera;
            }
            $stmt_get_carrera->close();
        } else {
            $error_message = "El usuario con ID $usuario_id no existe en la tabla original.";
        }
        $stmt_select->close();
    } elseif (isset($_POST['submit_reject'])) {
        // Recuperar el ID del usuario a rechazar
        $usuario_id = $_POST['usuario_id'];
        
        // Obtener los datos del usuario a migrar antes de eliminarlo
        $sql_select = "SELECT * FROM preinscripciones WHERE id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $usuario_id);
        $stmt_select->execute();
        $result_select = $stmt_select->get_result();
        
        if ($result_select->num_rows > 0) {
            // Obtener los datos del usuario
            $row = $result_select->fetch_assoc();
            $cedula = $row['cedula'];
            $nombres = $row['nombres'];
            $apellidos = $row['apellidos'];
            $correo = $row['correo'];
            $contraseña = $row['contraseña'];
            $nombre_carrera = $row['nombre_carrera'];
            $tipo_ingreso = $row['tipo_ingreso'];
            $fecha_inscripcion = $row['fecha_inscripcion']; // Mantener la fecha de inscripción original

            // Insertar el usuario en la tabla preinscripciones_rechazadas
            $sql_insert_rechazadas = "INSERT INTO preinscripciones_rechazadas (cedula, nombres, apellidos, correo, contraseña, nombre_carrera, tipo_ingreso, fecha_inscripcion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_rechazadas = $conn->prepare($sql_insert_rechazadas);
            $stmt_insert_rechazadas->bind_param("ssssssss", $cedula, $nombres, $apellidos, $correo, $contraseña, $nombre_carrera, $tipo_ingreso, $fecha_inscripcion);

            if ($stmt_insert_rechazadas->execute()) {
                // Eliminar el usuario de la tabla original
                $sql_delete = "DELETE FROM preinscripciones WHERE id = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("i", $usuario_id);
                if ($stmt_delete->execute()) {
                    $success_message = "El usuario ha sido rechazado y migrado a preinscripciones_rechazadas exitosamente.";
                } else {
                    $error_message = "Error al eliminar el usuario de la tabla original: " . $stmt_delete->error;
                }
            } else {
                $error_message = "Error al migrar el usuario a preinscripciones_rechazadas: " . $stmt_insert_rechazadas->error;
            }
        } else {
            $error_message = "El usuario con ID $usuario_id no existe en la tabla original.";
        }
        $stmt_select->close();
    }
}
?>
