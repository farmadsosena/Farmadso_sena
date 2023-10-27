function ocultarContenedoresMenu() {
    const contenidos = document.querySelectorAll('.paginas');
    contenidos.forEach(contenedor => {
        contenedor.style.display = 'none';
    });
    const botones = document.querySelectorAll('.toggle-dic');
    botones.forEach(boton => {
        boton.classList.remove('doss');
    });
}

function mostrarContenedoresMenu(contenedor, elemento) {
    ocultarContenedoresMenu();
    document.getElementById(contenedor).style.display = 'flex';
    elemento.classList.add('doss');

    // Guardar el nombre del contenedor y el ID del botón en localStorage
    localStorage.setItem('contenedorVisible', contenedor);
    localStorage.setItem('botonVisibleId', elemento.id);
}

ocultarContenedoresMenu();

const contenedorGuardado = localStorage.getItem('contenedorVisible');
const botonIdGuardado = localStorage.getItem('botonVisibleId');

if (contenedorGuardado) {

  document.getElementById(contenedorGuardado).style.display = 'flex';

  const botonGuardado = document.getElementById(botonIdGuardado);
  if (botonGuardado) {
    botonGuardado.classList.add('btnActive');
  }
} else {
  document.getElementById('Inic').style.classList.add('doss');
  document.getElementById('uno').style.display = 'flex';

}
  // Mostrar el contenedor "uno" por defecto

mostrarContenedoresMenu('uno', document.getElementById('Inic'));


const rectElements = document.querySelectorAll('.rect');

// Agrega un controlador de eventos a cada elemento "rect"
rectElements.forEach(rect => {
  rect.addEventListener('mouseover', () => {
    // Cuando se coloca el cursor, agrega la clase "visible" al "part2-contenido" dentro de este "rect"
    rect.querySelector('.part2-contenido').classList.add('visible');
  });

  rect.addEventListener('mouseout', () => {
    // Cuando se quita el cursor, elimina la clase "visible" del "part2-contenido" dentro de este "rect"
    rect.querySelector('.part2-contenido').classList.remove('visible');
  });
});

