<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario de Alta de nuevo Alumno</title>
    <link rel="stylesheet" href="../vista/css/style.css">
    <link rel="stylesheet" href="../vista/css/styleform1.css">
    <script src="js/formulario1.js"></script>
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
    <h2 class="centrado">1️⃣→️Datos personales del Alumno</h2>
    <form action="../controlador/controlador.php" method="post">
        <input type="hidden" name="origen" value="formulario1">
        <div class="formulario">
            <!-- IZQUIERDA-->
            <div>
                <p>
                    <label for="nombre">Nombre*:</label>
                    <input type="text" name="nombre" id="nombre">
                </p>
                <p>
                    <label for="pApellido">Primer Apellido*:</label>
                    <input type="text" name="pApellido" id="pApellido">
                </p>
                <p>
                    <label for="sApellido">Segundo Apellido*:</label>
                    <input type="text" name="sApellido" id="sApellido">
                </p>
                <p>
                    <label for="dni">DNI*:</label>
                    <input type="text" name="dni" id="dni">
                </p>
                <p>
                    <label for="uEstudio">Último Estudio Cursado*:</label>
                    <select name="uEstudio" id="uEstudio">
                        <option></option>
                        <?php
                        include_once ("../modelo/conexion.php");
                        $link=conectar();
                        $consulta="SELECT * FROM nivelestudios";
                        $resultado=mysqli_query($link,$consulta);
                        while ($fila=mysqli_fetch_assoc($resultado)){
                            echo '<option value="'.$fila['idEstudios'].'">'.$fila['nombreNivel'].'</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="fechaUE">Fecha del último Estudio*:</label>
                    <input type="date" name="fechaUE" id="fechaUE">
                </p>
            </div>
            <div>
                <p>
                    <label for="telefono">Teléfono*:</label>
                    <input type="text" id="telefono" name="telefono">
                </p>
                <p>
                    <label for="direccion">Dirección*:</label>
                    <input type="text" name="direccion" id="direccion">
                </p>
                <p>
                    <label for="cp">Código Postal*:</label>
                    <input type="text" name="cp" id="cp" maxlength="5">
                </p>
                <p>
                    <label for="ciudad">Ciudad*:</label>
                    <input type="text" name="ciudad" id="ciudad">
                </p>
                <p>
                    <label for="provincia">Provincia*:</label>
                    <select name="provincia" id="provincia" >
                        <option value=""></option>
                        <?php
                        $link=conectar();
                        $consulta="SELECT * FROM provincia";
                        $resultado=mysqli_query($link,$consulta);
                        while ($fila=mysqli_fetch_assoc($resultado)){
                            echo '<option value="'.$fila['idProvincia'].'">'.$fila['nombreProvincia'].'</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="fNacimiento">Fecha Nacimiento*:</label>
                    <input type="date" name="fNacimiento" id="fNacimiento">
                </p>
            </div>
        </div>
        <div class="enviarBoton">
            <input type="submit" name="enviarFormulario1" value="→ Siguiente">

                <?php
                if (!empty($_GET["errores"])){
                    echo urldecode($_GET["errores"]);
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