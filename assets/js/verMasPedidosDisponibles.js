
  // Obtener la ventana modal y el botón de cierre
  let modal = document.getElementById('myModal');
  let span = document.getElementsByClassName('close')[0];
  let ver = document.getElementsByClassName('seeMore')[0];  // Asegúrate de que este elemento exista

  function abrirNoti() {
    modal.style.display = 'flex';
  }
  // Cuando el usuario hace clic en el botón 'Ver más', abrir la ventana modal
  // Asociar la función al evento de clic en el botón 'Ver más'
  if (ver) {
    ver.addEventListener("click", abrirNoti);
  }

  // Cuando el usuario hace clic en el botón de cierre, cerrar la ventana modal
  span.onclick = function() {
    modal.style.display = 'none';
  }

  // Cuando el usuario hace clic fuera de la ventana modal, cerrarla
  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  }

