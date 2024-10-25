// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
    // Obtiene referencias a los elementos del DOM necesarios
    const checkboxPrivacidad = document.getElementById('casilla');         // Checkbox de aceptación de privacidad
    const botonFinalizar = document.getElementById('enviarFormulario2');   // Botón de enviar formulario

    // Función que actualiza el estado del botón basado en el estado del checkbox
    function actualizarEstadoBoton() {
        if (checkboxPrivacidad.checked) {
            // Si el checkbox está marcado:
            botonFinalizar.disabled = false;                          // Habilita el botón
            botonFinalizar.classList.remove('botonDesactivado');      // Remueve la clase de desactivado
            botonFinalizar.classList.add('botonActivado');           // Añade la clase de activado
        } else {
            // Si el checkbox no está marcado:
            botonFinalizar.disabled = true;                          // Deshabilita el botón
            botonFinalizar.classList.remove('botonActivado');        // Remueve la clase de activado
            botonFinalizar.classList.add('botonDesactivado');        // Añade la clase de desactivado
        }
    }

    // Establece el estado inicial del botón cuando se carga la página
    actualizarEstadoBoton();

    // Agrega un event listener para detectar cambios en el checkbox
    checkboxPrivacidad.addEventListener('change', actualizarEstadoBoton);
});