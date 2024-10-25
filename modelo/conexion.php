<?php
/*
 * Este archivo gestiona la conexión a la base de datos MySQL
 * Proporciona la función necesaria para establecer la conexión
 * y realizar operaciones como consultas, inserciones, eliminaciones y actualizaciones
 */

// Definición de los parámetros de conexión a la base de datos
$servidor = "localhost";     // Dirección del servidor de base de datos
$usuario = "root";          // Nombre de usuario de MySQL
$password = "";             // Contraseña del usuario (vacía por defecto en desarrollo local)
$puerto = "3306";          // Puerto por defecto de MySQL
$bbdd = "cepa";            // Nombre de la base de datos a la que nos conectaremos

/**
 * Función que establece la conexión con la base de datos
 * Utiliza las variables globales definidas arriba
 * @return mysqli|false Retorna el objeto de conexión o false si hay error
 */
function conectar() {
    // Accede a las variables globales de configuración
    global $servidor, $usuario, $password, $puerto, $bbdd;

    // Intenta establecer la conexión con el servidor MySQL
    $conexion = mysqli_connect($servidor.":".$puerto, $usuario, $password);

    // Verifica si hay errores en la conexión al servidor
    if(mysqli_error($conexion)) {
        // Si hay error, se ha comentado el mensaje para no mostrarlo
        // echo "Error al conectar con la base de datos";
    } else {
        // Conexión exitosa al servidor
        // echo "Conexión realizada correctamente<br>";
    }

    // Intenta seleccionar la base de datos especificada
    if (!mysqli_select_db($conexion, $bbdd)) {
        // Si hay error al seleccionar la base de datos
        // echo "Error al conectar con la BBDD";
        exit();  // Termina la ejecución del script
    } else {
        // Base de datos seleccionada correctamente
        // echo "Conexión con la BBDD realizada correctamente ";
    }

    // Devuelve el objeto de conexión para su uso en otras partes de la aplicación
    return $conexion;
}

// Establece la conexión inicial al cargar el archivo
$conexion = conectar();