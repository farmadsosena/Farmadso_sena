document.addEventListener('DOMContentLoaded', function () {
    // Obtener elementos del DOM
    const mainAdminDelivery = document.querySelector('.mainAdminDelivery');
    const icono1 = document.getElementById('icono1');
    const icono2 = document.getElementById('icono2');
    const icono3 = document.getElementById('icono3');
    const contenido1 = document.getElementById('contenido1');
    const contenido2 = document.getElementById('contenido2');
    const contenido3 = document.getElementById('contenido3');

    // Agregar controladores de eventos para los iconos
    icono1.addEventListener('click', function () {
        mainAdminDelivery.innerHTML = contenido1.innerHTML;
    });

    icono2.addEventListener('click', function () {
        mainAdminDelivery.innerHTML = contenido2.innerHTML;
    });

    icono3.addEventListener('click', function () {
        mainAdminDelivery.innerHTML = contenido3.innerHTML;
    });

    // Mostrar el contenido predeterminado al cargar la página
    mainAdminDelivery.innerHTML = contenido1.innerHTML;
});




