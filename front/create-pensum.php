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
            <div class="container">

            <div class="col-12">
                <h2 class="text-start">Crear Pensum de Estudio</h2>
                <form action="" method="post">
                    <div class="col-sm-4">
                        <label for="num_años_semestres">Nombre del Pensum</label>
                        <input type="text" class="form-control" id="" name="" required>
                    </div>
                    <br>
                    <div class="col-sm-4">
                        <label for="num_años_semestres">Cantidad de Años / Semestres</label>
                        <input type="number" class="form-control" id="num_años_semestres" name="num_años_semestres" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </form>
            </div>
        </div>
    </div>

    </div>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['num_años_semestres'])) {
            $num_años_semestres = $_POST['num_años_semestres'];
        ?>



        <div>
            <h2 class="text mb-4">Crear Pensum de Estudio</h2>
            <form action="procesar_pensum.php" method="post">
                <input type="hidden" name="num_años_semestres" value="<?php echo $num_años_semestres; ?>">
                <?php for ($i = 1; $i <= $num_años_semestres; $i++): ?>
                    <h3>Semestre <?php echo $i; ?></h3>

                    <div class="row g-3">
                            <div class="col-sm-4">
                                <label for="codigo_materia_<?php echo $i; ?>">Código de la Materia</label>
                                <input type="text" class="form-control" id="codigo_materia_<?php echo $i; ?>" name="codigo_materia_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="nombre_asignatura_<?php echo $i; ?>">Nombre de la Asignatura</label>
                                <input type="text" class="form-control" id="nombre_asignatura_<?php echo $i; ?>" name="nombre_asignatura_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="horas_teoricas_<?php echo $i; ?>">Horas Teóricas</label>
                                <input type="number" class="form-control" id="horas_teoricas_<?php echo $i; ?>" name="horas_teoricas_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="horas_practicas_<?php echo $i; ?>">Horas Prácticas</label>
                                <input type="number" class="form-control" id="horas_practicas_<?php echo $i; ?>" name="horas_practicas_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="horas_semanales_<?php echo $i; ?>">Horas Semanales</label>
                                <input type="number" class="form-control" id="horas_semanales_<?php echo $i; ?>" name="horas_semanales_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="uc_<?php echo $i; ?>">U.C (Unidades de Crédito)</label>
                                <input type="number" class="form-control" id="uc_<?php echo $i; ?>" name="uc_<?php echo $i; ?>" required>
                            </div>
                            <div class="col-sm-4">
                                <label for="prelaciones_<?php echo $i; ?>">Prelaciones</label>
                                <input type="text " class="form-control" id="prelaciones_<?php echo $i; ?>" name="prelaciones_<?php echo $i; ?>" required>
                            </div>
                        <?php endfor; ?>
                        <button type="submit" class="btn btn-primary">Crear Pensum</button>


                    </div>
                    
            </form>
        </div> 
    
 
</main>
    
</body>

<script src="..assets/js/main.js"></script>

<?php
}