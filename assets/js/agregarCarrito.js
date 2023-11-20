$(document).on('submit', '.añadirCarrito', function (e) {
  e.preventDefault(); // Evitar que la página se recargue

  var form = $(this);
  var productoId = form.data('idp'); // Corregido: usar 'idp' en lugar de 'idP'
  var cantidad = form.find('.cantidadProductO').val();

  $.ajax({
    url: "controllers/agregarCarrito.php",
    type: "POST",
    dataType: 'json',
    data: {
      id_producto: productoId,
      cantidad: cantidad
    },
    success: function (response) {
      // Manejar la respuesta del servidor
      if (response.correcto !== undefined) {
        var img = response.correcto;
        // Mostrar la alerta de éxito con imagen
        toastr.success('<img src="' + img + '" width="80px" heigh="80px" >', 'Producto añadido al carrito', {
          "timeOut": 1000,
          "progressBar": true
        });
      } else if (response === "nostock") {
        toastr.error("No hay suficiente stock disponible para agregar el producto", "Error", {
          timeOut: 1000,
          progressBar: true
        });
      } else if (response === "noSession") {
        toastr.warning("Para agregar productos al carrito, necesitas iniciar sesión", "Advertencia", {
          timeOut: 2500,
          progressBar: true
        });
      } else if (response === "carritolleno") {
        toastr.warning("No se puede agregar más productos, ya estás al límite", "Advertencia", {
          timeOut: 1000,
          progressBar: true
        });
      } else {
        toastr.error(response, "Error", {
          timeOut: 1000,
          progressBar: true
        });
      }
    },
    error: function (xhr, status, error) {
      toastr.error("Se produjo un error al realizar la solicitud", "Error", {
        timeOut: 1000,
        progressBar: true
      });
    }
  });
});

