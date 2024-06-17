<?php
// Incluir el archivo de conexión a la base de datos y otros archivos necesarios
include '../back/migration.php';

// Verificar si se recibió el parámetro 'search' por GET
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']); // Escapar el término de búsqueda para evitar inyección SQL
    
    // Consulta SQL con filtro por término de búsqueda
    $sql = "SELECT * FROM estudiantes WHERE nombres LIKE '%$search%' OR apellidos LIKE '%$search%' OR cedula LIKE '%$search%' OR correo LIKE '%$search%' OR nombre_carrera LIKE '%$search%' OR fecha_inscripcion LIKE '%$search%' OR tipo_ingreso LIKE '%$search%'";
} else {
    // Si no se proporcionó un término de búsqueda válido, no se ejecuta la consulta y se muestra un mensaje o se maneja como prefieras
    echo "<p class='alert alert-danger'>No se proporcionó un término de búsqueda válido.</p>";
    exit; // Termina la ejecución del script
}

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Construir la tabla HTML con los resultados
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Correo</th>
                <th>Carrera a Inscribir</th>
                <th>Fecha de Inscripcion</th>
                <th>Tipo de Ingreso</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Iterar sobre cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["nombres"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["apellidos"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cedula"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["correo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["nombre_carrera"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["fecha_inscripcion"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["tipo_ingreso"]) . "</td>";
        echo "<form method='post' action=''>"; // Formulario para enviar datos
        echo "<input type='hidden' name='condicion' value='activo'>"; // Campo oculto con el ID del usuario
        echo "<input type='hidden' name='usuario_id' value='" . $row['id'] . "'>"; // Campo oculto con el ID del usuario
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p class='alert alert-danger'>No se encontraron usuarios.</p>";
}

// Cerrar conexión a la base de datos
$conn->close();
?>