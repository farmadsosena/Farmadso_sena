// Obtén una lista de referencias a todos los checkboxes
var checkboxes = document.querySelectorAll('.ui-checkbox');

// Agrega un evento de cambio a cada checkbox
checkboxes.forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    // Verifica si el checkbox está seleccionado
    if (checkbox.checked) {
      // Agrega un retardo de tiempo antes de eliminar la sección
      setTimeout(function() {
        // Muestra una alerta de confirmación
        var confirmacion = confirm('¿Estás seguro de eliminar la sección seleccionada?');
        
        // Si el usuario confirma la eliminación, elimina la sección
        if (confirmacion) {
          // Elimina la sección
          var section = checkbox.closest('.ui-checkbox'); // Reemplaza 'tu-clase-de-seccion' con la clase correcta de la sección
          if (section) {
            section.remove();
            // Muestra una alerta de que se ha eliminado la sección
            alert('Sección eliminada.');
          }
        } else {
          // Si el usuario cancela la eliminación, desmarca el checkbox
          checkbox.checked = false;
        }
      }, 1000); // Retardo de 1 segundo (puedes ajustar el valor según tus necesidades)
    }
  });
});
