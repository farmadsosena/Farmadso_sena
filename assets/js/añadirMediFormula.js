function sendForm(event, formula, link) {
    event.preventDefault();
    const form = document.getElementById(formula);
    const contra = new FormData(form);
    fetch(link, {
        method: 'POST',
        body: contra,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true) {
                $('#medicamentos').load(location.href + ' #medicamentos>*', '');
                $('#total').load(location.href + ' #total>*', '');
                total
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function eliminarProductoDelCarrito(idProducto) {
    $.ajax({
      url: '../controllers/eliminarCarrito.php',
      type: 'POST',
      data: { id_Productounitario: idProducto },
      success: function (response) {
        toastr.success("El medicamento se eliminó del carrito", "Correcto", toastrOptions);
        consultarCarrito();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }
  
