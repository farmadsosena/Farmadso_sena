//FUNCION PARA ENVIAR PRODUCTOS A LA TABLA CARRITO
$('.cardProductoS').submit(function (e) {
  e.preventDefault();
  var form = $(this);
  var productoId = form.data('id');
  var cantidad = form.find('.cantidad_').val();

  $.ajax({
    url: 'controllers/agregarCarrito.php',
    type: 'POST',
    dataType: 'json', // Especificar que la respuesta será tratada como JSON
    data: {
      id_producto: productoId,
      cantidad: cantidad
    },
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


//-------ELIMINAR CARRITO------------------//
//FUNCION PARA ENVIAR PRODUCTOS A ELIMINAR 

// Evento para eliminar un solo producto del carrito
$(document).on('click', '.eliminarProducto', function (e, consultarCarrito) {
  e.preventDefault();
  var idProducto = $(this).data('id');
  eliminarProductoDelCarrito(idProducto);
});

// Evento para eliminar varios productos del carrito
$(document).on('click', '.deleteCarrito', function (e) {
  e.preventDefault();
  var idsProductos = obtenerProductosSeleccionados();
  eliminarProductosDelCarrito(idsProductos);
});

// Evento para seleccionar/deseleccionar todas las casillas de productos del carrito 
document.getElementById('seleccionarTodo').onclick = function () {
  var checkboxes = document.getElementsByClassName('checkboxMarcados');
  var deleteCarrito = document.querySelector('.deleteCarrito');
  var checkedCount = 0;

  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = this.checked;
    if (checkboxes[i].checked) {
      checkedCount++;
    }
  }

  updateDeleteCarritoDisplay();
  deleteCarrito.style.display = checkedCount > 0 ? 'flex' : 'none';
};

// Función para obtener los productos seleccionados
function obtenerProductosSeleccionados() {
  return $('#form-eliminar input[type=checkbox]:checked').map(function () {
    return $(this).val();
  }).get();
}

// Función para actualizar la visualización del botón de eliminar
function updateDeleteCarritoDisplay() {
  var deleteCarrito = document.querySelector('.deleteCarrito');
  var checkboxes = document.getElementsByName('id_productos[]');
  var checkedCount = 0;

  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      checkedCount++;
      break;
    }
  }

  deleteCarrito.style.display = checkedCount > 0 ? 'flex' : 'none';
}





// Función para eliminar un solo producto del carrito
function eliminarProductoDelCarrito(idProducto) {
  $.ajax({
    url: 'controllers/eliminarCarrito.php',
    type: 'POST',
    data: { id_Productounitario: idProducto },
    success: function (response) {
      toastr.success("El producto se eliminó del carrito", "Correcto", toastrOptions);
      consultarCarrito();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

// Función para eliminar varios productos del carrito
function eliminarProductosDelCarrito(idsProductos) {
  $.ajax({
    url: 'controllers/eliminarCarrito.php',
    type: 'POST',
    data: { id_Productos: idsProductos },
    success: function (response) {
      if (response === 'noSession') {
        alert('Debe iniciar sesión para activar el carrito.');
        window.location.href = "login.php";
      } else {
        toastr.success("Los productos se eliminaron del carrito", "Correcto", toastrOptions);
        consultarCarrito();
        $('#seleccionarTodo').prop('checked', false); // Cambiar el estado con jQuery
        $('.deleteCarrito').css('display', 'none');

      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}


$(document).ready(function() {
  // Delegación de eventos para el contenedor "tabla-contenedor"
  $('#tabla-contenedor').on('change', '.checkboxMarcados', function() {
    // Obtener la cantidad de checkboxes marcados
    var checkboxesMarcados = $('.checkboxMarcados:checked').length;

    // Si hay al menos 2 checkboxes marcados, mostrar el elemento .deleteCarrito; de lo contrario, ocultarlo
    if (checkboxesMarcados >= 2) {
      $('.deleteCarrito').css('display', 'flex');
      $('#seleccionarTodo').prop('checked', true); // Cambiar el estado con jQuery
    } else {
      $('.deleteCarrito').css('display', 'none');
      $('#seleccionarTodo').prop('checked', false); // Cambiar el estado con jQuery
    }
  });
});




var toastrOptions = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "1500",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};




