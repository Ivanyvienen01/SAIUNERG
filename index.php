<?php 
include './back/login.php';
include './back/conection.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>SAIUNERG</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="./assets/images/unerg-logo.png" rel="icon">
        <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/vendor/bootstrap-icons/bootstrap-icons.css">
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="stylesheet" href="./assets/css/carousel.css">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    </head>

<body class="bg-body-tertiary">

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="./assets/images/unerg-logo.png" alt="">
                <span class="d-none d-lg-block">SAIUNERG</span>
            </a>
        </div>
    </header>
    
    
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <img class="" src="./assets/images/unerg-logo.png" alt="" width="200" height="100">
                <h1>Sistema Academico Integrado</h1>
                <h2>(SAIUNERG)</h2>
            </div>

            <div class="row g-2 justify-content-center">
            
                <!-- buttons -->
                <div class="col-lg-2 order-md-last">

                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#ModalOpsu" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <i class="bi bi-person-fill-add"></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Preinscipcion de Opsu</h6>
                                </div>
                            </div>
                        </a>
                    </h4>
                    

                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#ModalInterna" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <i class="bi bi-person-plus-fill"></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Preinscipcion Interna</h6>
                                </div>
                            </div>
                        </a>
                    </h4>

                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <a href="" data-bs-toggle="modal" data-bs-target="#ModalMigracion" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <i class="bi bi-person-fill-up"></i>
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">Migracion de Usuario</h6>
                                </div>
                            </div>
                        </a>
                    </h4>
            
                </div>
                <?php 
                    include './back/register-opsu.php';
                ?>
                <!-- Modal Opsu -->
                <div class="modal fade" id="ModalOpsu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Preinscripcion Opsu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="registrationForm" class="needs-validation" novalidate>

                                <div class="form-group">
                                    <label class="form-label">Nombres</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="name" class="form-control"  required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Nombre
                                        </div>

                                    </div>
                        
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Apellido</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="lastname" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Apellido
                                        </div>

                                    </div>
                                    
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Correo</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="email" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Correo Electronico
                                        </div>

                                    </div>
                                    
                                    <br>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Cedula</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="CI" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Cedula de Identidad
                                        </div>
                                        
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-5">
                                        <label for="carrera" class="form-label">Carrera</label>
                                        <select class="form-select" id="carrera" name="carrera" required="">
                                            <option value=""></option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Salida de cada fila de datos
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row["nombre_carrera"]) . '">' . htmlspecialchars($row["nombre_carrera"]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay carreras disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Seleccione una Carrera
                                        </div>
                                    </div>                                    

                                    <br>

                                </div>
    
                                
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa una contraseña.
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <div class="invalid-feedback">
                                        Las contraseñas no coinciden.
                                    </div>

                                    <br>

                                </div>
                                    

                                <br>

                                <div class="modal-footer">
                                    <input type="hidden" name="tipo_ingreso" value="Opsu">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-primary " type="submit" name="submit_register_opsu" id="liveAlertBtn">Aceptar</button>
                                </div>
                            </form>
                        </div>
                        
                        </div>
                    </div>
                </div>

                <?php 
                    include './back/register-interna.php';
                ?>
                <!-- Modal Interna -->
                <div class="modal fade" id="ModalInterna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Preinscripcion Interna</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="registrationForm" class="needs-validation" novalidate>

                                <div class="form-group">
                                    <label class="form-label">Nombres</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="name" class="form-control"  required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Nombre
                                        </div>

                                    </div>
                        
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Apellido</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="lastname" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Apellido
                                        </div>

                                    </div>
                                    
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Correo</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="email" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Correo Electronico
                                        </div>

                                    </div>
                                    
                                    <br>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Cedula</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="CI" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Cedula de Identidad
                                        </div>
                                        
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-5">
                                        <label for="carrera" class="form-label">Carrera</label>
                                        <select class="form-select" id="carrera" name="carrera" required="">
                                            <option value=""></option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Salida de cada fila de datos
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row["nombre_carrera"]) . '">' . htmlspecialchars($row["nombre_carrera"]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay carreras disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Seleccione una Carrera
                                        </div>
                                    </div>                                    

                                    <br>

                                </div>
    
                                
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa una contraseña.
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <div class="invalid-feedback">
                                        Las contraseñas no coinciden.
                                    </div>

                                    <br>

                                </div>
                                    

                                <br>

                                <div class="modal-footer">
                                    <input type="hidden" name="tipo_ingreso" value="Interna">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-primary " type="submit" name="submit_register_interna" id="liveAlertBtn">Aceptar</button>
                                </div>
                            </form>
                        </div>
                        
                        </div>
                    </div>
                </div>

                <?php 
                    include './back/register-migracion.php';
                ?>
                <!-- Modal Migracion -->
                <div class="modal fade" id="ModalMigracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Migracion de Usuario</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="registrationForm" class="needs-validation" novalidate>

                                <div class="form-group">
                                    <label class="form-label">Nombres</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="name" class="form-control"  required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Nombre
                                        </div>

                                    </div>
                        
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Apellido</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="lastname" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su primer y segundo Apellido
                                        </div>

                                    </div>
                                    
                                    <br>
                                    
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Correo</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="email" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Correo Electronico
                                        </div>

                                    </div>
                                    
                                    <br>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Cedula</label>

                                    <div class="input-group has-validation">

                                        <input type="text" name="CI" class="form-control" required>
                                        <div class="invalid-feedback">
                                            Ingrese su Cedula de Identidad
                                        </div>
                                        
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-5">
                                        <label for="carrera" class="form-label">Carrera</label>
                                        <select class="form-select" id="carrera" name="carrera" required="">
                                            <option value=""></option>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Salida de cada fila de datos
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row["nombre_carrera"]) . '">' . htmlspecialchars($row["nombre_carrera"]) . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay carreras disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Seleccione una Carrera
                                        </div>
                                    </div>                                    

                                    <br>

                                </div>
    
                                
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        Por favor ingresa una contraseña.
                                    </div>

                                    <br>

                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <div class="invalid-feedback">
                                        Las contraseñas no coinciden.
                                    </div>

                                    <br>

                                </div>
                                    

                                <br>

                                <div class="modal-footer">
                                    <input type="hidden" name="tipo_ingreso" value="Migracion">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-primary " type="submit" name="submit_register_migration" id="liveAlertBtn">Aceptar</button>
                                </div>
                            </form>
                        </div>
                        
                        </div>
                    </div>
                </div>
                
                <!-- login -->
                <div class="col-lg-6">
                    <form class="needs-validation" novalidate method="POST">
                        <div class="col-10">
                            <label class="form-label">Correo</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" name="correo"  required>
                                <div class="invalid-feedback">
                                    Ingrese su Correo Electrónico
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <label class="form-label">Contraseña</label>
                            <div class="input-group has-validation">
                                <input type="password" class="form-control" name="contraseña" required>
                                <div class="invalid-feedback">
                                    Ingrese su Contraseña
                                </div>
                            </div>
                        </div>
                        <hr class="col-10">
                        
                        <button class="btn btn-primary" type="submit" name="submit_login">Ingresar</button>
                    </form>
                    
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

        </main>
        
    </div>


    
</body>
    
<!-- Vendor JS Files -->
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Template Main JS File -->
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/checkout.js"></script>
</html>
