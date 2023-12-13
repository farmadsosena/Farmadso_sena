$('#cerrarFactura').click(function () {
 window.location.href="inicio_tienda.php";
});

 

function ConsultarDataFactura(idCompra) {

console.log(idCompra);
  var forDATA = new FormData();
  forDATA.append('idCompra', idCompra);

  // Complementar encabezados
  var contenedorFactura = $('#contenedorFactura');
  var contenedorListado = $('.listaArticulos');

  contenedorListado.empty();

  var encabezado = $('<div class="itemsArticulos lista-head"></div>')
    .append('<span>Articulo</span>')
    .append('<div>Cantidad</div>')
    .append('<div>Precio</div>')
    .append('<div>Total</div>');
  contenedorListado.append(encabezado);

  fetch('../models/compraAll.php', {
    method: 'POST',
    body: forDATA
  })
    .then(response => response.json())
    .then(datos => {
      datos.forEach(function (item) {
        var itemArticulo = $('<div class="itemsArticulos"></div>');
        var spanProducto = $('<span></span>').text(item.nombreMedicamento);
        var divCantidad = $('<div></div>').text(item.cantidadMedicamento);
        var divPrecio = $('<div></div>').text(item.precioMedicamento);
        var divTotal = $('<div></div>').text(item.precioMedicamentoTotal);

        itemArticulo.append(spanProducto, divCantidad, divPrecio, divTotal);
        contenedorListado.append(itemArticulo);
      });

      if (datos && datos.length > 0) {
        var nombre = datos[0].nombreusuario;
        var apellido = datos[0].apellidousuario;
        var fecha = datos[0].fecha; // No se ve en tus datos, ajusta según sea necesario
        var telefono = datos[0].telefono;
        var email = datos[0].correo;
        var subtotal = datos[0].totalCompra; // Ajusta según tus datos reales
        var ubicacion = datos[0].direccion; // Ajusta según tus datos reales
        var metodoPago = datos[0].metodoPago;

        $('#subtotalFactura').text(subtotal + "$");
        $('#nombreFactura').text(nombre + " " + apellido);
        $('#fechaFactura').text(fecha);
        $('#telefonoFactura').text("Telefono " + telefono);
        $('#emailFactura').text(email);
        $('#ubicacionFactura').text("Dirección " + ubicacion);
        $('#metodoPago').text("Metodo de pago: " + metodoPago);
      } else {
        console.log('Error: Los datos recibidos son incorrectos o no hay datos disponibles.');
      }

      var itemSubtotal = $('<div class="itemsArticuloSubtotal"></div>');
      var spanSubtotal = $('<span>Subtotal: <b id="subtotalFactura">' + subtotal + '</b></span>');
      itemSubtotal.append(spanSubtotal);
      contenedorListado.append(itemSubtotal);

      contenedorFactura.css('display', 'flex');
    })
    .catch(error => console.error('Error en la solicitud:', error));
}




function descargarImagenComoPDF() {
  // Capturar el contenido como imagen utilizando html2canvas
  html2canvas($('.contenidoFactura')[0]).then(function (canvas) {
    // Convertir el canvas a URL de datos
    var imgData = canvas.toDataURL();

    // Crear una instancia de jsPDF
    var pdf = new jsPDF();

    // Agregar la imagen al PDF
    pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);

    // Guardar el PDF con el nombre "factura.pdf"
    pdf.save('factura.pdf');
  });
}

$('#descargarFactura').click(function () {
  descargarImagenComoPDF();
});
