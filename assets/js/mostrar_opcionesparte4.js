
function mostrarContenido(opcion) {
    // Oculta los botones de opciones
    document.getElementById('opciones').style.display = 'none';
  
    // Muestra el contenido correspondiente a la opción seleccionada
    document.getElementById('contenido-' + opcion).style.display = 'block';
    document.getElementById('contenido-' + opcion).style.width = '100%';
  }
  
  function volverAopciones(opcion) {
    // Oculta el contenido actual
    document.getElementById('contenido-domiciliario').style.display = 'none';
    document.getElementById('contenido-farmacia').style.display = 'none';
  
    // Muestra el div de opciones
    document.getElementById('opciones').style.display = 'block';
    document.getElementById('contenido-' + opcion).style.width = '100%';
  }
  
