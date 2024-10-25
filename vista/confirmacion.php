<?php
session_start();

// Verificar si existe un ID de alumno en la sesión
if(isset($_SESSION['id_alumno'])) {
    // Conectar a la base de datos
    include_once("../modelo/conexion.php");
    $conexion = conectar();

    // Consulta para obtener los datos del alumno
    $consulta = "SELECT nombre, primerApellido, segundoApellido, telefono 
                FROM alumno 
                WHERE idAlumno = " . $_SESSION['id_alumno'];

    $resultado = mysqli_query($conexion, $consulta);
    $alumno = mysqli_fetch_assoc($resultado);
}
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmación de Registro</title>
        <link rel="stylesheet" href="../vista/css/style.css">
        <link rel="stylesheet" href="../vista/css/styleform1.css">
    </head>
    <body>
    <header>
        <div class="banner-container">
            <img src="../vista/img/pagprincipal1.png" alt="Banner CEPA" class="banner-image">
            <nav>
                <a href="../index.php">Inicio</a>
                <a href="formulario1.php">Alta Alumno</a>
                <a href="#">Administración</a>
            </nav>
        </div>
    </header>

    <main>
        <h1>Confirmación de Registro</h1>
        <h2 class="centrado">🎉 ¡Enhorabuena!</h2>
        <div class="info-registro">
            <p>Has completado tu registro exitosamente. Tu información ha sido guardada.</p>
            <?php if(isset($alumno)): ?>
                <p class="id-alumno">
                    ID de Alumno: <?php echo htmlspecialchars($_SESSION['id_alumno']); ?><br>
                    Nombre: <?php echo htmlspecialchars($alumno['nombre'] . ' ' .
                        $alumno['primerApellido'] . ' ' .
                        $alumno['segundoApellido']); ?><br>
                    Teléfono: <?php echo htmlspecialchars($alumno['telefono']); ?>
                </p>
            <?php else: ?>
                <p class="id-alumno">Error al obtener los datos del alumno</p>
            <?php endif; ?>
            <p>Por favor, guarda este número de identificación para futuras referencias.</p>
            <p>Si necesitas más información o deseas realizar alguna acción adicional, no dudes en contactarnos.</p>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 CEPA - Centro de Estudios para Adultos. Todos los derechos reservados.</p>
        <p>Página realizada por Mónico Bellón Morales y José Luis Osorio González</p>
    </footer>
    </body>
    </html>
<?php
mysqli_close($conexion);
// Limpiar la sesión después de mostrar los datos
session_destroy();
?>