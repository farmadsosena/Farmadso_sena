function recibir_cantida_produc_carrito() {
  $.ajax({
    type: "POST",
    url: "../controllers/mostrarCantidad_produc_carrito.php",
    dataType: "json",
    success: function (datos) {
      mostrar_cantidad(datos);
    },
    error: function () {
      console.log("ocurrio un error");
    },
  });
}

function mostrar_cantidad(datos) {
  $(".cantidad_produc_carrito").remove();

  if (datos.cantidad_carrito) {
    var cantidad_carrito = $(
      "<p class='cantidad_produc_carrito'>" + datos.cantidad_carrito + "</p>"
    );

    $(".abrirCarrito").each(function (index, botonAbrir_carrito) {
      $(botonAbrir_carrito).append(cantidad_carrito.clone());
    });
  }
}

recibir_cantida_produc_carrito();
