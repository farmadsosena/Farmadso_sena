// Obtén elementos relevantes
const seleccionarTodo = document.getElementById('seleccionarTodo');
const checkboxes = document.querySelectorAll('.ui-checkbox');

// Agrega un controlador de eventos al botón "Eliminar"
document.querySelector('.eliminar-razon').addEventListener('click', () => {
  // Confirma si el usuario quiere eliminar las razones seleccionadas
  const confirmacion = confirm('¿Estás seguro de que deseas eliminar las razones seleccionadas?');
  if (confirmacion) {
    // Recorre todos los checkboxes y elimina las razones seleccionadas
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        // Elimina el elemento .rect más cercano al checkbox seleccionado
        const rectElement = checkbox.closest('.rect');
        if (rectElement) {
          rectElement.remove();
        }
      }
    });
  }
});

// Agrega un controlador de eventos al checkbox "Seleccionar todo"
seleccionarTodo.addEventListener('change', () => {
  // Marca o desmarca todos los checkboxes según el estado del checkbox "Seleccionar todo"
  checkboxes.forEach(checkbox => {
    checkbox.checked = seleccionarTodo.checked;
  });
});
