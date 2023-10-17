
  // Obtener la ventana modal y el botón de cierre
  var modal = document.getElementById('myModal');
  var span = document.getElementsByClassName('close')[0];

  // Cuando el usuario hace clic en el botón 'Ver más', abrir la ventana modal
  var seeMoreButtons = document.getElementsByClassName('seeMore');
  for (var i = 0; i < seeMoreButtons.length; i++) {
    seeMoreButtons[i].onclick = function() {
      modal.style.display = 'block';
      // Aquí puedes agregar lógica para cargar los detalles del pedido específico
      // Puedes acceder a la información del pedido a través de los elementos del DOM
      // y mostrarla en la ventana modal.
      document.getElementById('order-number').innerText = '001';
      document.getElementById('customer-name').innerText = 'Isaias Caballero Mendoza';
      document.getElementById('customer-address').innerText = 'B/Rosal';
      // Puedes continuar agregando más detalles según sea necesario
    }
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



