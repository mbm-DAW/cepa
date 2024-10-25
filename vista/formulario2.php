<?php
session_start();
// Verificar si no existen las variables de sesión necesarias
if (!isset($_SESSION['nombre']) || !isset($_SESSION['dni'])) {
    // Redirigir al formulario1.php si no existen
    header('Location: formulario1.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario 2 - Datos de persona Contacto</title>
    <link rel="stylesheet" href="../vista/css/style.css">
    <link rel="stylesheet" href="../vista/css/styleform2.css">
    <script src="../vista/js/formulario2.js"></script>
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
    <h1>Formulario de Alta de nuevo Alumno</h1>
    <h2 class="centrado">2️⃣→Datos de persona Contacto</h2>
    <form action="../controlador/controlador.php" method="post">
        <input type="hidden" name="origen" value="formulario2">

        <div class="formulario">
            <div>
                <p>
                    <label for="nombreFamiliar">Nombre persona Contacto:</label>
                    <input type="text" name="nombreFamiliar" id="nombreFamiliar">
                </p>
                <p>
                    <label for="telefonoFamiliar">Teléfono del Contacto:</label>
                    <input type="text" name="telefonoFamiliar" id="telefonoFamiliar">
                </p>
                <p>
                    <label for="relacion">Relación:</label>
                    <select name="relacion" id="relacion">
                        <option value=""></option>
                        <?php
                        include_once ("../modelo/conexion.php");
                        $link=conectar();
                        $consulta="SELECT * FROM parentesco";
                        $resultado=mysqli_query($link,$consulta);
                        while ($fila=mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['idRelacion'] . '">' . $fila['nombreRelacion'] . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <input type="checkbox" id="casilla">
                    <span>Acepta la Política de <a href="https://aepd.es/" target="_blank">Privacidad y Protección de datos</a></span>
                </p>
            </div>
        </div>
        <div class="enviarBoton">
            <input type="submit" name="enviarFormulario2" value="→ Finalizar" disabled id="enviarFormulario2" class="botonDesactivado">

                <?php
                if (!empty($_GET["errores"])){
                    echo $_GET["errores"];
                }
                ?>

        </div>
    </form>
</main>

<footer>
    <p>&copy; 2024 CEPA - Centro de Estudios para Adultos. Todos los derechos reservados.</p>
    <p>Página realizada por Mónico Bellón Morales y José Luis Osorio González</p>

</footer>
</body>
</html>
