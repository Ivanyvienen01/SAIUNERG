<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SAIUNERG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../assets/images/unerg-logo.png" rel="icon">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/carousel.css">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  </head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php 
include '../back/migration.php';
include './administrator.php';

?>
<body >
    <main id="main" class="main">

        <div class="py-4 ">

            <div class="container-fluid d-flex justify-content-start ">
                
                <div class="col-12">

                    <div class="col-auto">
                    <h1 class="mb-3">Solicitudes de Preinscripciones</h1>
                    </div>

                    <div class="col-md-12">
                        <div class="d-flex justify-content-start mb-2">
                        
                            <nav class="navbar navbar-expand-lg navbar-light bg-light ">

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <form class="d-flex ms-auto my-2 my-lg-0">
                                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search" id="searchInput">
                                        <button class="btn btn-outline-primary me-2" type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div>

                                <a href="../report/report.php" class="btn btn-primary me-2">Generar Reporte</a>
                                <a href="../report/report-daily.php" class="btn btn-primary me-2">Generar Reporte Diario</a>
                
                            </nav>

                        </div>
                    </div>

                    <div class="col-md-20"> <!-- Ajusta el tamaño de la columna según sea necesario -->
                        <!-- Search Bar -->
                            
                        <div id="searchResults">

                            <?php
                                // Consulta SQL para obtener todos los datos del usuarios
                                $sql = "SELECT * FROM preinscripciones";


                                $result = $conn->query($sql);

                                // Verificar si hay resultados
                                if ($result->num_rows > 0) {
                                    // Mostrar el encabezado de la tabla
                                    echo "<table class='table '>";
                                    echo "<thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Cedula</th>
                                            <th>Correo</th>
                                            <th>Carrera a Inscribir</th>
                                            <th>Fecha de Inscripcion</th>
                                            <th>Tipo de Ingreso</th>
                                            <th>Acción</th>
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
                                        echo "<td>";
                                        echo "<form method='post' action=''>"; // Formulario para enviar datos
                                        echo "<input type='hidden' name='condicion' value='activo'>"; // Campo oculto con el ID del usuario
                                        echo "<input type='hidden' name='usuario_id' value='" . $row['id'] . "'>"; // Campo oculto con el ID del usuario
                                        echo "<button class='btn btn-success me-2 mb-2' type='submit' name='submit_accept'>Aceptar</button>"; // Botón para aceptar
                                        echo "<button class='mb-2 btn btn-danger' type='submit' name='submit_reject'>Rechazar</button>"; // Botón para rechazar
                                        echo "</form>"; 
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    
                                    // Cerrar la tabla
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p class='alert alert-danger'>No se encontraron usuarios.</p>";
                                }

                                // Cerrar conexión a la base de datos
                                $conn->close();
                            ?>
                        </div>

                        <!-- JavaScript para búsqueda en tiempo real -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                // Escuchar el evento de cambio en el campo de búsqueda
                                $('#searchInput').on('input', function() {
                                    var searchText = $(this).val(); // Obtener el texto de búsqueda
                                    // Realizar la petición AJAX para obtener los resultados filtrados
                                    $.ajax({
                                        type: 'GET',
                                        url: '../back/search.php', // Archivo PHP que maneja la búsqueda
                                        data: { search: searchText }, // Datos a enviar, en este caso el texto de búsqueda
                                        success: function(response) {
                                            $('#searchResults').html(response); // Actualizar los resultados en el contenedor
                                        }
                                    });
                                });
                            });
                        </script>

                        <!-- Alert -->
                        <div class="container mt-4">
                            <?php if (!empty($error_message)): ?>
                                <!-- Mostrar mensaje de error -->
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $error_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                                
                            <?php if (!empty($success_message)): ?>
                                <!-- Mostrar mensaje de éxito -->
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo $success_message; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

</body>

<script src="..assets/js/main.js"></script>
