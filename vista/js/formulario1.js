// Se ejecuta cuando la página ha cargado completamente
window.onload=function () {
    // Obtiene el elemento input de fecha de nacimiento del formulario
    let fechaNacimiento = document.querySelector("#fNacimiento");

    // Crea un objeto Date con la fecha actual
    let hoy = new Date(); //2024-10-24

    // Obtiene el año actual
    let year = hoy.getFullYear(); //2024

    // Calcula el año máximo permitido (18 años atrás desde el año actual)
    let fechaMin = year-18;

    // Obtiene el mes actual (se suma 1 porque los meses van de 0 a 11)
    // padStart asegura que el mes tenga dos dígitos (ej: 01, 02, ..., 12)
    let mesMin=String(hoy.getMonth()+1).padStart(2,"0");

    // Obtiene el día actual y asegura que tenga dos dígitos
    let diaMin=String(hoy.getDate()).padStart(2,"0");

    // Construye la fecha en formato YYYY-MM-DD para el atributo max del input
    let fechaFormulario=fechaMin+"-"+mesMin+"-"+diaMin;

    // Establece la fecha máxima permitida en el input
    // Esto evita que se seleccionen fechas de personas menores de 18 años
    fechaNacimiento.setAttribute("max",fechaFormulario);
}