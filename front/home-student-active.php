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

<body>
    <?php
    include '../back/login.php';
    ?>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="../assets/images/unerg-logo.png" alt="">
                <span class="d-none d-lg-block">SAIUNERG</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <!-- Icons Navigation -->
        <nav class="header-nav ms-auto">
            
            <ul class="d-flex align-items-center">

                <!-- Notification Nav -->
                <li class="nav-item dropdown">

                    <!-- Notification Icon -->
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a>

                    <!-- Notification Dropdown Items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                        Tienes 4 Nuevas Notificaciones 
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver Todas</span></a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Titulo</h4>
                            <p>Mensaje</p>
                            <p>hace 3 min</p>
                        </div>
                        </li>

                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Titulo</h4>
                            <p>Mensaje</p>
                            <p>hace 3 min</p>
                        </div>
                        </li>

                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Titulo</h4>
                            <p>Mensaje</p>
                            <p>hace 3 min</p>
                        </div>
                        </li>

                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Titulo</h4>
                            <p>Mensaje</p>
                            <p>hace 3 min</p>
                        </div>
                        </li>

                        <li>
                        <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                        <a href="#">Ver Todas las Notificaciones</a>
                        </li>

                    </ul>

                </li>

                <!-- Messages Nav -->
                <li class="nav-item dropdown">

                    <!-- Messages Icon -->
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a>

                    <!-- Messages Dropdown Items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                        Tienes 3 Nuevos Mensajes
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">Ver Todos</span></a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Remitente</h4>
                                <p>Mensaje</p>
                                <p>Hce 4 Horas</p>
                            </div>
                        </a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Remitente</h4>
                                <p>Mensaje</p>
                                <p>Hce 4 Horas</p>
                            </div>
                        </a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                        <a href="#">
                            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Remitente</h4>
                                <p>Mensaje</p>
                                <p>Hce 4 Horas</p>
                            </div>
                        </a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                        <a href="#">Ver todos los Mensajes</a>
                        </li>

                    </ul>

                </li>
                
                <!-- Profile Nav -->
                <li class="nav-item dropdown pe-3">
                    
                    <!-- Profile Image Icon -->
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img class="bi bi-person" src="../assets/images/photo.png" alt="" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php
                                // Verificar si el usuario está logeado 
                                if (isset($_SESSION['correo'])) {
                                    echo $_SESSION['correo'];
                                }
                            ?>
                        </span>
                    </a>

                    <!-- Profile Dropdown Items -->
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                            <?php
                                // Mostrar el nombre del usuario
                                if (isset($_SESSION['nombres_usuario'])) {
                                    echo htmlspecialchars($_SESSION['nombres_usuario']); // htmlspecialchars para evitar XSS
                                }
                                ?>
                            <?php
                                if (isset($_SESSION['apellidos_usuario'])) {
                                    echo htmlspecialchars($_SESSION['apellidos_usuario']); // htmlspecialchars para evitar XSS
                                }
                            ?>
                            </h6>
                            <span>Estudiante</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>Datos del Usuario</span>
                            </a>
                        </li>

                        <li>
                        <a class="dropdown-item d-flex align-items-center" href="../back/logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <!-- Dashboard Nav -->
        <ul class="sidebar-nav" id="sidebar-nav">

            <!-- Career Nav -->
            <li class="nav-item">
                <a class="nav-link " href="../front/home-student-active.php">
                <i class="bi bi-grid"></i>
                <span>Panel de Control</span>
                </a>
            </li>
            
            <li class="nav-heading">Condicion Activa</li>

            <!--PENSUM Page Nav -->
            <li class="nav-item">
                    <a class="nav-link collapsed" href="../back/generar-pensum.php" target="_blank">
                    <i class="bi bi-file-text"></i>
                    <span>PENSUM</span>
                </a>
            </li>
        </ul>

    </aside>

    <!-- ======= Main ======= -->
    <?php 
      include '../back/update.php';
    ?>
<main id="main" class="main">
    <div class="justify-content-start">

    <div class="col-12">

        <h1>Datos del Usuario</h1>

        <form method="post" class="needs-validation" novalidate>
            
        <fieldset id="user-fieldset" disabled>

            <div class="row g-3">

            <div class="col-sm-4">
                <label for="userName" class="form-label">Nombres</label>
                <input type="text" class="form-control" name="name" value="<?php echo isset($user_info['nombres']) ? $user_info['nombres'] : ''; ?>" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="lastname" value="<?php echo isset($user_info['apellidos']) ? $user_info['apellidos'] : ''; ?>" required>
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Cedula</label>
                <input type="text" class="form-control" name="cedula" value="<?php echo isset($user_info['cedula']) ? $user_info['cedula'] : ''; ?>" required disabled>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Correo Electronico</label>
                <input type="text" class="form-control" name="email" value="<?php echo isset($user_info['correo']) ? $user_info['correo'] : ''; ?>"required>
                <div class="invalid-feedback">
                    Ingresa tu Correo Electronico.
                </div>
            </div>

            <div class="col-sm-4">
                <label for="" class="form-label">Numero de Telefono</label>
                <input type="text" class="form-control" name="phone" value="<?php echo isset($user_info['telefono']) ? $user_info['telefono'] : ''; ?>"  required>
                <div class="invalid-feedback">
                    Ingresa tu Numero de Telefono.
                </div>
            </div>

            <div class="col-sm-2">
                <label for="" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="birthdate" value="<?php echo isset($user_info['fecha_nacimiento']) ? $user_info['fecha_nacimiento'] : ''; ?>"  required>
                <div class="invalid-feedback">
                    Ingresa tu Fecha de Nacimiento
                </div>
            </div>

            <div class="col-sm-2">
                <label for="" class="form-label">Fecha de Inscripcion</label>
                <input type="datetime" class="form-control" id="fechaInscripcion" value="<?php echo isset($user_info['fecha_inscripcion']) ? $user_info['fecha_inscripcion'] : ''; ?>" required disabled>
            </div>                

            <div class="col-sm-4">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" id="estado" name="estado" required>
                    <?php
                    $conexion = new mysqli('localhost', 'root', '', 'saiunerg');
                    $query_first_option = "SELECT estado FROM estudiantes LIMIT 1";
                    $result_first_option = $conexion->query($query_first_option);
                    
                    if ($result_first_option->num_rows > 0) {
                        $row_first_option = $result_first_option->fetch_assoc();
                        echo "<option value='" . $row_first_option['estado'] . "'>" . $row_first_option['estado'] . "</option>";
                    }
                    
                    $query_estados = "SELECT id, nombre FROM estados";
                    $result_estados = $conexion->query($query_estados);
                    
                    if ($result_estados->num_rows > 0) {
                        while ($row = $result_estados->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                        }
                    }   

                    ?>
                </select>
                <div class="invalid-feedback">
                    Selecciona un estado.
                </div>
            </div>

            <div class="col-sm-4">

                <label for="cm" class="form-label">Ciudad/Municipio</label>
                <select class="form-select" id="cm" name="cm" required disabled>
                <?php
                    $conexion = new mysqli('localhost', 'root', '', 'saiunerg');
                    $query_first_option = "SELECT ciudad_municipio FROM estudiantes LIMIT 1";
                    $result_first_option = $conexion->query($query_first_option);
                    
                    if ($result_first_option->num_rows > 0) {
                        $row_first_option = $result_first_option->fetch_assoc();
                        echo "<option value='" . $row_first_option['ciudad_municipio'] . "'>" . $row_first_option['ciudad_municipio'] . "</option>";
                    }
                ?>
                </select>
                <div class="invalid-feedback">
                    Selecciona una cm.
                </div>
            </div>

            
            
            <div class="col-sm-8">
                <label for="" class="form-label">Direccion de Domicilio</label>
                <input type="text" class="form-control" name="address" value="<?php echo isset($user_info['direccion']) ? $user_info['direccion'] : ''; ?>"  required>
                <div class="invalid-feedback">
                    Ingresa una Direccion de Domicilio
                </div>
            </div>
            
            <div class="col-sm-2">
                <label for="" class="form-label">Género</label>
                <select class="form-select" name="gender" required>
                    <option value="Masculino" <?php echo (isset($user_info['genero']) && $user_info['genero'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="Femenino" <?php echo (isset($user_info['genero']) && $user_info['genero'] == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                </select>
                <div class="invalid-feedback">
                    Selecciona tu género.
                </div>
            </div>


            <div class="col-sm-2">
                <label for="" class="form-label">Estado Civil</label>
                <select class="form-select" name="civilstatus" required>
                    <option value="Solter@" <?php echo (isset($user_info['estado_civil']) && $user_info['estado_civil'] == 'Masculino') ? 'selected' : ''; ?>>Solter@</option>
                    <option value="Casad@" <?php echo (isset($user_info['estado_civil']) && $user_info['estado_civil'] == 'Femenino') ? 'selected' : ''; ?>>Casad@</option>
                    <option value="Divorciad@" <?php echo (isset($user_info['estado_civil']) && $user_info['estado_civil'] == 'Femenino') ? 'selected' : ''; ?>>Divorciad@</option>
                    <option value="Viud@" <?php echo (isset($user_info['estado_civil']) && $user_info['estado_civil'] == 'Femenino') ? 'selected' : ''; ?>>Viud@</option>
                </select>
                <div class="invalid-feedback">
                    Selecciona tu Estado Civil.
                </div>
            </div>

            <div class="col-sm-8">
                <label for="" class="form-label">Contraseña</label>

                <div class="row">
                    <div class="col-sm-4">
                    <input type="password" class="form-control" id="contraseña" value="<?php echo isset($user_info['contraseña']) ? $user_info['contraseña'] : ''; ?>"  required disabled>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#CambiarContra">
                        Cambiar Contraseña
                    </button>
                    </div>
                </div>
                
            </div>             

            <hr class="my-4">
            </div>

        </fieldset>
        <button  class="btn btn-primary " type="button" id="editButton">Actualizar datos</button>
        <button class='btn btn-success' type='submit' name='submit_accept'>Confirmar</button>

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

            <?php if (!empty($success_message_password)): ?>
                <!-- Mostrar mensaje de éxito -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message_password; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message_password)): ?>
                <!-- Mostrar mensaje de error -->
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error_message_password; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

        </div>
        
        </form>

        <!-- Modal cambio Contraseña -->
        <div class="modal fade" id="CambiarContra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="change_password">Cambiar Contraseña</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
    </div>
    
        
    </div>

</main>

</body>
</html>
<script src="../assets/js/main.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/checkout.js"></script>
<script>

 // JavaScript para deshabilitar campos de fecha de inscripción y contraseña
  document.getElementById('editButton').addEventListener('click', function() {
      document.getElementById('user-fieldset').removeAttribute('disabled');

      document.getElementById('cedula').setAttribute('disabled', 'disabled');
      document.getElementById('fechaInscripcion').setAttribute('disabled', 'disabled');
      document.getElementById('contraseña').setAttribute('disabled', 'disabled');
  });

 // JavaScript para cargar las cmes dependiendo del estado seleccionado
    document.getElementById('estado').addEventListener('change', function() {
        var estadoId = this.value;
        var cmSelect = document.getElementById('cm');
        cmSelect.innerHTML = '<option value="">Cargando...</option>';

        // Petición AJAX para obtener las cmes del estado seleccionado
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../back/get.php?estado_id=' + estadoId, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var cmes = JSON.parse(xhr.responseText);
                cmSelect.innerHTML = '<option value="">Selecciona una Ciudad/Municipio</option>';
                cmes.forEach(function(cm) {
                    cmSelect.innerHTML += '<option value="' + cm.id + '">' + cm.nombre + '</option>';
                });
                cmSelect.disabled = false;
            } else {
                cmSelect.innerHTML = '<option value="">Error al cargar las cmes</option>';
            }
        };
        xhr.send();
    });
</script>