
function consultarCarrito() {

  $.ajax({
    url: '../models/carrito.php',
    method: 'POST',
    dataType: 'json',
    success: function (response) {


      if (response.message) {
        $('#tabla-contenedor').html('<p>' + response.message + '</p>');

      } else {
        // Actualizar la tabla del carrito sin borrar los contenedores existentes
        $('#tabla-contenedor').html(response.html);

        // Actualizar el subtotal en el DOM
        $('#subtotal').text(response.subtotal + ' $');
        MONTO = (response.subtotal)

      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR); // Muestra el objeto jqXHR completo en la consola
      console.log(textStatus); // Muestra el estado del texto del error en la consola
      console.log(errorThrown); // Muestra el mensaje de error en la consola

      // Manejo de errores
    }
  });
}


$('[id="abrirCarrito"]').on('click', function () {
  consultarCarrito();
});
$(document).ready(function () {
  consultarCarrito();
})



//  paypal.Buttons({
//    style: {
//      shape: 'pill',
//      label: 'pay'
//    },

//    createOrder: function (data, actions) {
//      return actions.order.create({
//        purchase_units: [{
//          amount: {
//            value: MONTO
//          }
//        }]
//      });
//    },

//    onApprove: function (data, actions) {
//      actions.order.capture().then(function (detalles) {
//        return fetch('controllers/procesarCompra.php', {
//          method: "POST",
//          headers: {
//            'Content-Type': 'application/json'
//          },
//          body: JSON.stringify({
//            detalles: detalles
//          })
//        })
//        .then(function (response) {
//          if (response.ok) {
//            // Mostrar el Toast "Compra realizada correctamente"
//            toastr.success("Compra realizada correctamente");
//            // Redirigir a index.php después de 3 segundos
//            // setTimeout(function () {
//            //   window.location.href = "index.php";
//            // }, 2000);
//          } else {
//            alert("Error al procesar la compra");
//          }
//          return response.json();
//        })
//        .then(function (data) {
//          // Puedes agregar aquí algún procesamiento adicional de la respuesta si es necesario.
//        });
//      });
//    },

//    onCancel: function (data) {
//      if (!confirm("¿Desea seguir con la compra?")) {
//        window.location.href = "index.php";
//      }
//    }
//  }).render('#paypal-button-container');