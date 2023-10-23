// Obtén todas las referencias a los contenedores y botones
const openMenus = document.querySelectorAll('.open_menu');
const toggleButtons = document.querySelectorAll('.menu_card');

// Agrega un manejador de eventos a cada botón de abrir y cerrar
for (let i = 0; i < openMenus.length; i++) {
  openMenus[i].addEventListener('click', function() {
    toggleDisplay(i);
  });
  
  toggleButtons[i].addEventListener('click', function() {
    toggleDisplay(i);
  });
}

function toggleDisplay(index) {
  // Alterna la clase "open" en el botón y cambia su visibilidad
  if (toggleButtons[index].style.display === 'flex') {
    toggleButtons[index].style.display = 'none';
  } else {
    toggleButtons[index].style.display = 'flex';
  }
}
