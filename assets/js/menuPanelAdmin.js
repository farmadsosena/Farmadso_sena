function mostrarContenido(id, element) {
    pages = document.querySelectorAll('.page');
    items = document.querySelectorAll('.item');

    pages.forEach(page => {
        page.classList.remove('visiblePage');
    });

    items.forEach(item => {
        item.classList.remove('activeItem');
    });

    document.getElementById(id).classList.add('visiblePage');
    element.classList.add('activeItem');

    // Guardar el estado actual en localStorage
    var estado = {
        id: id,
        elementId: element.id
    };

    localStorage.setItem('estado', JSON.stringify(estado));
}

// Recuperar el estado almacenado en localStorage al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    var estadoGuardado = localStorage.getItem('estado');

    if (estadoGuardado) {
        var estado = JSON.parse(estadoGuardado);
        mostrarContenido(estado.id, document.getElementById(estado.elementId));
    }
});
