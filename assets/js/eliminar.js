// Obtiene una lista de referencias a todos los checkboxes con la clase 'ui-checkbox'
var checkboxes = document.querySelectorAll('.ui-checkbox');

// Almacena las secciones seleccionadas
var selectedSections = [];

// Agrega un evento de cambio a cada checkbox
checkboxes.forEach(function(checkbox) {
  checkbox.addEventListener('change', function() {
    if (checkbox.checked) {
      // Agrega la sección a la lista de selecciones
      var section = checkbox.closest('.tu-clase-de-seccion'); // Reemplaza 'tu-clase-de-seccion' con la clase correcta de la sección
      if (section) {
        selectedSections.push(section);
      }
    } else {
      // Elimina la sección de la lista de selecciones si se desmarca el checkbox
      var index = selectedSections.indexOf(section);
      if (index !== -1) {
        selectedSections.splice(index, 1);
      }
    }
  });
});

// Agrega un evento de clic a un botón para mostrar la alerta después de seleccionar
var botonAlerta = document.getElementById('botonAlerta'); // Reemplaza 'botonAlerta' con el ID correcto de tu botón

botonAlerta.addEventListener('click', function() {
  if (selectedSections.length > 0) {
    // Muestra una alerta de confirmación
    var confirmacion = confirm('¿Estás seguro de eliminar las secciones seleccionadas?');

    if (confirmacion) {
      // Elimina las secciones seleccionadas
      selectedSections.forEach(function(section) {
        section.remove();
      });

      // Desmarca todos los checkboxes
      checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
      });

      // Limpia la lista de selecciones
      selectedSections = [];
    }
  }
});
