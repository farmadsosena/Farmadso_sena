function agregarClase() {
  // Selecciona todos los elementos con la clase "open_menu"
  const openMenuButtons = document.querySelectorAll('.open_menu');

  // Itera sobre cada botón y agrega un evento de clic
  openMenuButtons.forEach(function (button) {
      button.addEventListener('click', function (event) {
          // Detiene la propagación del clic para evitar cerrar inmediatamente
          event.stopPropagation();

          // Encuentra el contenedor hermano con la clase "menu_card"
          const menuCard = this.parentNode.nextElementSibling;

          // Desactiva todos los contenedores con la clase "menu_card"
          document.querySelectorAll('.menu_card').forEach(function (menu) {
              menu.classList.remove('active');
          });

          // Agrega la clase "active" al contenedor "menu_card"
          menuCard.classList.add('active');
      });
  });

  // Agrega un evento de clic al documento para cerrar el contenedor activo al hacer clic fuera de él
  document.addEventListener('click', function () {
      // Desactiva todos los contenedores con la clase "menu_card"
      document.querySelectorAll('.menu_card').forEach(function (menu) {
          menu.classList.remove('active');
      });
  });
}

// Agrega la llamada a la función cuando se carga el DOM
document.addEventListener('DOMContentLoaded', agregarClase);
