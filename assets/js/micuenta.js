function mostrarContenido(idPestana) {
    const pestanas = document.querySelectorAll('.contenido-pestaña');
    pestanas.forEach(pestaña => {
      pestaña.style.display = 'none';
    });

    document.getElementById(idPestana).style.display = 'block';
  }

  // Mostrar la primera pestaña por defecto al cargar la página
  mostrarContenido('miperfil');