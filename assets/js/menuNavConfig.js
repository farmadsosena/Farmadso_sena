window.onload = function () {
    var currentState = sessionStorage.getItem('currentState');

    // Verificar si el estado almacenado en la sesión es válido
    if (!currentState || !['icono1', 'icono2', 'icono3'].includes(currentState)) {
        currentState = 'icono1'; // Establecer el icono1 como estado predeterminado
    }

    // Llamar a la función correspondiente según el estado actual
    if (currentState === 'icono1') {
        showContenido1();
    } else if (currentState === 'icono2') {
        showContenido2();
    } else if (currentState === 'icono3') {
        showContenido3();
    }
};

var icono1 = document.getElementById('icono1');
var icono2 = document.getElementById('icono2');
var icono3 = document.getElementById('icono3');

icono1.addEventListener('click', function() {
    showContenido1();
});

icono2.addEventListener('click', function() {
    showContenido2();
});

icono3.addEventListener('click', function() {
    showContenido3();
});

function showContenido1() {
    // Ocultar los otros contenidos si es necesario
    hideOtherContenidos();
    // Mostrar el contenido correspondiente al icono1
    document.getElementById('contenido1').style.display = 'block';
    sessionStorage.setItem('currentState', 'icono1');
}

function showContenido2() {
    // Ocultar los otros contenidos si es necesario
    hideOtherContenidos();
    // Mostrar el contenido correspondiente al icono2
    document.getElementById('contenido2').style.display = 'block';
    sessionStorage.setItem('currentState', 'icono2');
}

function showContenido3() {
    // Ocultar los otros contenidos si es necesario
    hideOtherContenidos();
    // Mostrar el contenido correspondiente al icono3
    document.getElementById('contenido3').style.display = 'block';
    sessionStorage.setItem('currentState', 'icono3');
}

function hideOtherContenidos() {
    // Ocultar todos los contenidos
    document.getElementById('contenido1').style.display = 'none';
    document.getElementById('contenido2').style.display = 'none';
    document.getElementById('contenido3').style.display = 'none';
}
