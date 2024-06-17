<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Ejercicios de Multiplicación</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 50px;
        }
        .exercise-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
     <div class="container">
        <h1 class="text-center">Blog de Ejercicios de Multiplicación</h1>
        <div id="exercise-section" class="exercise-container">
            <!-- Aquí se generará dinámicamente el ejercicio -->
        </div>
        <button id="generate-btn" class="btn btn-primary">Generar Ejercicio</button>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Función para generar ejercicios aleatorios
        function generateExercise() {
            var tabla = Math.floor(Math.random() * 5) + 1; // Número aleatorio del 1 al 5
            var multiplicador = Math.floor(Math.random() * 10) + 1; // Número aleatorio del 1 al 10
            var resultado = tabla * multiplicador;

            var exerciseHTML = `
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Completa el Procedimiento</h5>
                        <p class="card-text">
                            ${resultado} es el resultado de ${tabla} x <input type="number" id="partInput" placeholder="Ingresa el otro número">
                        </p>
                        <button id="checkAnswerBtn" class="btn btn-primary">Comprobar</button>
                        <p id="resultMessage"></p>
                    </div>
                </div>
            `;

            document.getElementById('exercise-section').innerHTML = exerciseHTML;

            // Agregar funcionalidad al botón Comprobar
            document.getElementById('checkAnswerBtn').addEventListener('click', function() {
                var partInput = document.getElementById('partInput').value;
                if (partInput == multiplicador || partInput == tabla) {
                    document.getElementById('resultMessage').innerHTML = '<strong>¡Correcto!</strong>';
                } else {
                    document.getElementById('resultMessage').innerHTML = '<strong>Incorrecto. Inténtalo de nuevo.</strong>';
                }
            });
        }

        // Generar un ejercicio al cargar la página
        generateExercise();

        // Asignar función al botón Generar Ejercicio
        document.getElementById('generate-btn').addEventListener('click', generateExercise);
    </script>
</body>
</html>
