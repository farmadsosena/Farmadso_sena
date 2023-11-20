let BtnMicuenta = document.getElementById("Micuenta");
let BtnDetalles = document.getElementById("Detalles");
let BtnCerrarSesion = document.getElementById("CerrarSesion");
let Contenedor1 = document.getElementsByClassName("ContenedoresOptionConfig1");
let Contenedor2 = document.getElementsByClassName("ContenedoresOptionConfig2");
let Contenedor3 = document.getElementsByClassName("ContenedoresOptionConfig3");




// Agregado: Obtener el botón "History"
let BtnHistory = document.getElementById("history");

// Oculta los contenedores al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    ocultarTodosLosContenedores();
});

// For para ocultar la página
function ocultarTodosLosContenedores() {
    for (let contenedor of Contenedor1) {
        contenedor.style.display = "none";
    }

    for (let contenedor of Contenedor2) {
        contenedor.style.display = "none";
    }

    for (let contenedor of Contenedor3) {
        contenedor.style.display = "none";
    }
}

let ventanaPrincipal = false;

// Función para obtener el nombre de la función activa almacenada en sessionStorage
function obtenerFuncionActiva() {
    return sessionStorage.getItem("funcionActiva");
}

// Función para guardar el nombre de la función activa en sessionStorage
function guardarFuncionActiva(funcion) {
    sessionStorage.setItem("funcionActiva", funcion);
}

// Función para mostrar el contenedor especificado y guardar la función activa
function mostrarContenedorYGuardar(funcion, contenedor) {
    ocultarTodosLosContenedores();
    for (let c of contenedor) {
        c.style.display = "flex";
    }
    guardarFuncionActiva(funcion);
}

// Eventos click con la persistencia del estado
BtnMicuenta.addEventListener("click", function() {
    mostrarContenedorYGuardar("BtnMicuenta", Contenedor1);
});

BtnDetalles.addEventListener("click", function() {
    mostrarContenedorYGuardar("BtnDetalles", Contenedor2);
});

BtnCerrarSesion.addEventListener("click", function() {
    mostrarContenedorYGuardar("BtnCerrarSesion", Contenedor3);
});

// Agregado: Evento click para el botón "History"
BtnHistory.addEventListener("click", function() {
    // Restablecer la configuración predeterminada (BtnMicuenta y Contenedor1)
    ocultarTodosLosContenedores();
    for (let contenedor of Contenedor1) {
        contenedor.style.display = "flex";
    }
    guardarFuncionActiva("BtnMicuenta");
});

// Al cargar la página, restaurar la función activa almacenada
document.addEventListener("DOMContentLoaded", function () {
    const funcionActiva = obtenerFuncionActiva();
    if (funcionActiva) {
        switch (funcionActiva) {
            case "BtnMicuenta":
                mostrarContenedorYGuardar("BtnMicuenta", Contenedor1);
                break;
            case "BtnDetalles":
                mostrarContenedorYGuardar("BtnDetalles", Contenedor2);
                break;
            case "BtnCerrarSesion":
                mostrarContenedorYGuardar("BtnCerrarSesion", Contenedor3);
                break;
            default:
                ocultarTodosLosContenedores();
        }
    } else {
        // Si no hay función activa almacenada, mostrar la configuración predeterminada
        ocultarTodosLosContenedores();
        for (let contenedor of Contenedor1) {
            contenedor.style.display = "flex";
        }
        guardarFuncionActiva("BtnMicuenta");
    }
});
