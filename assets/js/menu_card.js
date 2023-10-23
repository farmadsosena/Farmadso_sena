// Obtén una referencia al contenedor y al botón
const openMenu = document.querySelector('.open_menu');
const toggleButton = document.querySelector('.menu_card');

// Agrega un manejador de eventos al botón de abrir y cerrar
openMenu.addEventListener('click', toggleDisplay);
toggleButton.addEventListener('click', toggleDisplay);

function toggleDisplay() {
  // Alterna la clase "open" en el contenedor y cambia su visibilidad
  if (toggleButton.style.display === 'flex') {
    toggleButton.style.display = 'none';
  } else {
    toggleButton.style.display = 'flex';
  }
}
