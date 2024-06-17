<?php
// Verificar si se ha proporcionado un ID de estado válido
if(isset($_GET['estado_id']) && !empty($_GET['estado_id'])) {
    // Conexión a la base de datos (ajusta los parámetros según tu configuración)
    $conexion = new mysqli('localhost', 'root', '', 'saiunerg');

    // Consulta para obtener las ciudades_municipios del estado seleccionado
    $estado_id = $_GET['estado_id'];
    $query = "SELECT id, nombre FROM ciudades_municipios WHERE estado_id = $estado_id";
    $result = $conexion->query($query);

    // Crear un array para almacenar las ciudades_municipios
    $ciudades_municipios = array();

    // Verificar si se obtuvieron resultados
    if($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Agregar cada ciudad al array de ciudades_municipios
            $ciudades_municipios[] = $row;
        }
    }

    // Devolver las ciudades_municipios como JSON
    echo json_encode($ciudades_municipios);
} else {
    // Devolver un mensaje de error si no se proporcionó un ID de estado válido
    echo json_encode(array('error' => 'ID de estado no válido'));
}

?>

