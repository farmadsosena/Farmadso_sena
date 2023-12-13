$(document).ready(function () {
  $(".formularioEntrega").submit(function (e) {
    e.preventDefault();

    // Obtener datos del formulario
    var formData = new FormData(this);

    $.ajax({
      url: "../models/cargarimagenCompra.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        // Verificar el estado de la respuesta
        if (response.status === "success") {
          // Mostrar alerta de éxito
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: response.message,
            confirmButtonText: 'OK'
          }).then((result) => {
            // Puedes redirigir a otra página o hacer algo más después de hacer clic en OK
            if (result.isConfirmed) {
              // Por ejemplo, redirigir a otra página
              location.reload();
            }
          });
        } else {
          // Mostrar alerta de error
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.message,
            confirmButtonText: 'OK'
          });
        }
      },
      error: function (error) {
        // Manejar errores aquí
        console.error("Error en la petición AJAX:", error);
      },
    });
  });
});
