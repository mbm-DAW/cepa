<?php
/**
 * Controlador principal para el proceso de registro de alumnos
 * Este archivo maneja la validación y procesamiento de dos formularios
 * relacionados con la inscripción de estudiantes y sus datos de contacto
 */

session_start(); // Inicia la sesión para mantener datos entre páginas

/**
 * Array global para almacenar mensajes de error durante la validación
 * Se reinicia cada vez que se carga el controlador
 */
$errores = array();

/**
 * Variable para concatenar todos los mensajes de error
 * Se utiliza para enviar errores de vuelta a los formularios
 */
$todosLosErrores = "";

/**
 * Procesamiento del primer formulario (datos personales del alumno)
 * Valida todos los campos requeridos y guarda los datos en sesión si son válidos
 */
if($_REQUEST["origen"]==="formulario1") {
    $valido = true; // Indicador de validación general

    // Validación de campos obligatorios del formulario 1
    if (!validarTexto($_REQUEST["nombre"],"nombre")) $valido = false;
    if (!validarTexto($_REQUEST["pApellido"],"primer apellido")) $valido = false;
    if (!validarTexto($_REQUEST["sApellido"],"segundo apellido")) $valido = false;
    if (!validarDni($_REQUEST["dni"])) $valido = false;
    if (!validarTelefono($_REQUEST["telefono"])) $valido = false;
    if (!validarDireccion($_REQUEST["direccion"])) $valido = false;
    if (!validarCpostal($_REQUEST["cp"])) $valido = false;
    if (!validarEdad($_REQUEST["fNacimiento"])) $valido = false;

    // Validación de campos select
    if (empty($_REQUEST["provincia"])) {
        $errores[] = "<p>Debe seleccionar una provincia</p>";
        $valido = false;
    }
    if (empty($_REQUEST["fechaUE"])) {
        $errores[] = "<p>Debe seleccionar la fecha del último estudio</p>";
        $valido = false;
    }
    if (empty($_REQUEST["uEstudio"])) {
        $errores[] = "<p>Debe seleccionar el último estudio cursado</p>";
        $valido = false;
    }

    // Si todos los campos son válidos, guarda en sesión y redirige
    if ($valido) {
        // Almacenamiento de datos en variables de sesión
        $_SESSION["nombre"] = $_REQUEST["nombre"];
        $_SESSION["pApellido"] = $_REQUEST["pApellido"];
        $_SESSION["sApellido"] = $_REQUEST["sApellido"];
        $_SESSION["dni"] = $_REQUEST["dni"];
        $_SESSION["telefono"] = $_REQUEST["telefono"];
        $_SESSION["direccion"] = $_REQUEST["direccion"];
        $_SESSION["cp"] = $_REQUEST["cp"];
        $_SESSION["ciudad"] = $_REQUEST["ciudad"];
        $_SESSION["provincia"] = $_REQUEST["provincia"];
        $_SESSION["uEstudio"] = $_REQUEST["uEstudio"];
        $_SESSION["fechaUE"] = $_REQUEST["fechaUE"];
        $_SESSION["fNacimiento"] = $_REQUEST["fNacimiento"];

        header("Location:../vista/formulario2.php");
    } else {
        // Concatena errores y redirige al formulario 1 con mensajes
        // recorre el array $errores y concatena cada mensaje de error
        //añadiendo un espacio entre ellos para separarlo
        foreach ($errores as $error) {
            $todosLosErrores .= $error . " ";
        }
        // Codifica los errores para que sean seguros de pasar en la URL
        // urlencode() convierte caracteres especiales en formato %XX
        $todosLosErrores = urlencode($todosLosErrores);
        //redirige al usuario de vuelta al formulario
        //Pasa los errores como parametro GET en la URL para mostrarlos
        header("Location:../vista/formulario1.php?errores=" . $todosLosErrores);
    }
}

/**
 * Procesamiento del segundo formulario (datos del familiar/contacto)
 * Valida los campos y si son correctos, guarda todo en la base de datos
 */
if ($_REQUEST["origen"]==="formulario2") {
    $valido = true;

    // Validación de campos del formulario 2
    if (!validarTexto($_REQUEST["nombreFamiliar"],"Persona Contacto")) $valido = false;
    if (!validarTelefono($_REQUEST["telefonoFamiliar"])) $valido = false;
    if (empty($_REQUEST["relacion"])) $valido = false;

    if ($valido) {
        include_once("../modelo/conexion.php");
        $conexion = conectar();

        // Inserción de datos del familiar en la base de datos
        $sqlFamiliar = "INSERT INTO familiar (nombreFamiliar, telefono, idRelacion) 
                        VALUES ('".$_REQUEST["nombreFamiliar"]."', 
                                '".$_REQUEST["telefonoFamiliar"]."', 
                                '".$_REQUEST["relacion"]."')";

        if(mysqli_query($conexion, $sqlFamiliar)) {
            $idFamiliar = mysqli_insert_id($conexion); // Obtiene ID del familiar insertado

            // Inserción de datos del alumno en la base de datos
            $sqlAlumno = "INSERT INTO alumno (nombre, primerApellido, segundoApellido, dni, 
                                            telefono, direccion, cp, ciudad, fechaUltimoEst, 
                                            idProvincia, idEstudios, idFamiliar, fechaNacimiento) 
                         VALUES ('".$_SESSION["nombre"]."', 
                                '".$_SESSION["pApellido"]."', 
                                '".$_SESSION["sApellido"]."', 
                                '".$_SESSION["dni"]."', 
                                '".$_SESSION["telefono"]."', 
                                '".$_SESSION["direccion"]."', 
                                '".$_SESSION["cp"]."', 
                                '".$_SESSION["ciudad"]."', 
                                '".$_SESSION["fechaUE"]."', 
                                '".$_SESSION["provincia"]."', 
                                '".$_SESSION["uEstudio"]."', 
                                '".$idFamiliar."', 
                                '".$_SESSION["fNacimiento"]."')";

            if(mysqli_query($conexion, $sqlAlumno)) {
                // Guarda ID del alumno y limpia sesión
                $_SESSION['id_alumno'] = mysqli_insert_id($conexion);
                $id_temp = $_SESSION['id_alumno'];
                session_unset();
                $_SESSION['id_alumno'] = $id_temp;
                header("Location:../vista/confirmacion.php");
            } else {
                $errores[] = "<p>Error al guardar los datos del alumno</p>";
                $valido = false;
            }
        } else {
            $errores[] = "<p>Error al guardar los datos del familiar</p>";
            $valido = false;
        }
        mysqli_close($conexion);
    }

    if (!$valido) {
        // Redirige al formulario 2 con errores si hay problemas
        foreach ($errores as $error){
            $todosLosErrores .= $error . " ";
        }
        $todosLosErrores = urlencode($todosLosErrores);
        header("Location:../vista/formulario2.php?errores=" . $todosLosErrores);
    }
}

/**
 * Valida campos de texto (nombres, apellidos)
 * @param string $texto Texto a validar
 * @param string $variable Nombre del campo para el mensaje de error
 * @return boolean True si es válido, False si no cumple los requisitos
 */
function validarTexto($texto, $variable){
    global $errores;
    if (empty($texto)) {
        $errores[] = "<p>El campo $variable no puede estar vacío</p>";
        return false;
    }

    // Verifica que solo contenga letras y espacios
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $texto)) {
        $errores[] = "<p>El campo $variable solo puede contener letras</p>";
        return false;
    }
    return true;
}

/**
 * Valida números de teléfono españoles
 * @param string $telefono Número de teléfono a validar
 * @return boolean True si es válido, False si no cumple el formato
 */
function validarTelefono($telefono){
    global $errores;
    $telefono = str_replace([' ', '-'], '', $telefono); // Limpia el formato

    if (empty($telefono)) {
        $errores[] = "<p>El teléfono no puede estar vacío</p>";
        return false;
    }

    // Valida formato español: 9 dígitos comenzando por 6,7,8,9
    if (!preg_match('/^[6789][0-9]{8}$/', $telefono)) {
        $errores[] = "<p>El teléfono debe tener 9 dígitos y empezar por 6, 7, 8 o 9</p>";
        return false;
    }
    return true;
}

/**
 * Valida que la persona sea mayor de 18 años
 * @param string $fecha Fecha de nacimiento en formato Y-m-d
 * @return boolean True si es mayor de 18, False si no
 */
function validarEdad($fecha) {
    global $errores;

    if(empty($fecha)) {
        $errores[] = "<p>La fecha de nacimiento es obligatoria</p>";
        return false;
    }

    $hoy = new DateTime();
    $nacimiento = new DateTime($fecha);
    $edad = $hoy->diff($nacimiento)->y;

    if($edad < 18) {
        $errores[] = "<p>Debe ser mayor de 18 años</p>";
        return false;
    }
    return true;
}

/**
 * Valida el formato y letra del DNI español
 * @param string $dni DNI con letra (formato: 12345678A)
 * @return boolean True si es válido, False si no cumple los requisitos
 */
function validarDni($dni) {
    global $errores;
    $dni = strtoupper(trim($dni));

    if(empty($dni)) {
        $errores[] = "<p>El DNI no puede estar vacío</p>";
        return false;
    }

    if(!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
        $errores[] = "<p>El DNI debe tener 8 números y una letra mayúscula</p>";
        return false;
    }

    // Validación de la letra según algoritmo oficial
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    $numero = substr($dni, 0, 8);
    $letra = $dni[8];

    if($letra !== $letras[$numero % 23]) {
        $errores[] = "<p>La letra del DNI no es correcta</p>";
        return false;
    }
    return true;
}

/**
 * Valida códigos postales españoles
 * @param string $cp Código postal a validar
 * @return boolean True si es válido, False si no cumple el formato
 */
function validarCpostal($cp){
    global $errores;
    if(empty($cp)) {
        $errores[] = "<p>El código postal no puede estar vacío</p>";
        return false;
    }

    // Valida formato español: 5 dígitos comenzando por 0-5
    if(!preg_match('/^[0-5][0-9]{4}$/', $cp)) {
        $errores[] = "<p>El código postal debe tener 5 dígitos y empezar por 0-5</p>";
        return false;
    }

    // Valida rango de códigos postales españoles
    $cpNum = intval($cp);
    if($cpNum < 1001 || $cpNum > 52999) {
        $errores[] = "<p>El código postal debe estar entre 01001 y 52999</p>";
        return false;
    }
    return true;
}

/**
 * Valida el formato de la dirección
 * @param string $direccion Dirección a validar
 * @return boolean True si es válida, False si no cumple los requisitos
 */
function validarDireccion($direccion) {
    global $errores;
    if(empty($direccion)) {
        $errores[] = "<p>La dirección no puede estar vacía</p>";
        return false;
    }

    // Valida caracteres permitidos y presencia de al menos una letra
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s,.ºª-]+$/", $direccion) || !preg_match("/[a-zA-ZáéíóúÁÉÍÓÚñÑ]/", $direccion)) {
        $errores[] = "<p>La dirección debe contener al menos una letra</p>";
        return false;
    }

    if (strlen($direccion) < 5) {
        $errores[] = "<p>La dirección debe tener al menos 5 caracteres</p>";
        return false;
    }
    return true;
}
?>
































