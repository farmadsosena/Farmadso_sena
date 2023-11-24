$('.cardProductoS').submit(function (e) {
  e.preventDefault();
  var form = $(this);
var formData = form.serialize();

  $.ajax({
    url: '../controllers/agregarCarrito.php',
    type: 'POST',
    dataType: 'json', // Especificar que la respuesta será tratada como JSON
    data: formData,
    success: function (response) {
      console.log(response);
      // Manejar la respuesta del servidor
      if (response.correcto !== undefined) {
        var img = response.correcto;

        // Mostrar la alerta de éxito con imagen
        toastr.success('<img src="' + img + '" width="80px" heigh="80px" >', 'Producto añadido al carrito', {
          "timeOut": 1000,
          "progressBar": true
        });
      } else if (response === 'nostock') {
        // Mostrar la alerta de error con barra de progreso
        toastr.error('No hay suficiente stock disponible para agregar el producto', 'Error', {
          timeOut: 1000, // Duración de 1 segundo
          progressBar: true // Barra de progreso activada
        });
      } else if (response === 'noSession') {
        // Si no hay sesión activa, redirigir a la página de inicio de sesión
        toastr.warning('Para agregar productos al carrito, necesitas iniciar sesión', 'Advertencia', {
          timeOut: 2500, // Duración de 1 segundo
          progressBar: true // Barra de progreso activada
        });
      } else if (response === 'carritolleno') {
        // Si no hay sesión activa, redirigir a la página de inicio de sesión
        toastr.warning('No se puede agregar más productos, ya se alcanzó el límite', 'Advertencia', {
          timeOut: 1000, // Duración de 1 segundo
          progressBar: true // Barra de progreso activada
        });
      } else {
        // Mostrar un mensaje de error al usuario utilizando toastr con barra de progreso
        toastr.error(response, 'Error', {
          timeOut: 1000, // Duración de 1 segundo
          progressBar: true // Barra de progreso activada
        });
      }
    },
    error: function (xhr, status, error) {
      // Manejar los errores de la llamada AJAX
      toastr.error('Se produjo un error al realizar la solicitud', 'Error', {
        timeOut: 1000, // Duración de 1 segundo
        progressBar: true // Barra de progreso activada
      });
    }
  });
});

