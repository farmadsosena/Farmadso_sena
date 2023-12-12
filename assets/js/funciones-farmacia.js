function eliminarMedicamento(idMedicamento) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este medicamento?");
    if (confirmacion) {
        $.ajax({
            type: "POST",
            url: "../controllers/eliminar_medicamento.php",
            data: { idMedicamento: idMedicamento },
            success: function (response) {
                // Verifica si la eliminación fue exitosa
                if (response == "success") {
                    alert("Medicamento eliminado correctamente.");
                    location.reload();
                    var contModal = document.querySelector('.modal-inventario');
                    contModal.style.display = 'block';
                } else {
                    alert("Error al eliminar el medicamento. Por favor, inténtalo de nuevo.");
                }
            }
        });
    }
}


// ENVIA CAMBIO DE ESTADO:

$(document).ready(function () {
    // Manejador de clic para el botón
    $('#cambiarEstadoBtn').on('click', function () {
        // Obtiene el idcompra del atributo data
        var idcompra = $(this).data('idcompra');

        // Realiza la solicitud AJAX
        $.ajax({
            url: '../controllers/cambiadorEstado.php',  // URL del archivo PHP que manejará la solicitud
            method: 'POST',              // Método de solicitud
            data: { idcompra: idcompra }, // Datos que se enviarán al servidor
            success: function (response) {
                // Maneja la respuesta del servidor
                alert(response);

                // Puedes hacer más cosas aquí según la respuesta del servidor
            },
            error: function (error) {
                // Maneja errores de la solicitud AJAX
                console.error(error);
            }
        });
    });
});


// CAMBIA HEADERCITO DE GRAFICAS
$(document).ready(function() {
    var headerGraficos = $("#headerGraficos");

    $(".cont-grafics").on("scroll", function() {
      var scrollPos = $(this).scrollTop();
      var containerHeight = $(this).height();
      var headerHeight = headerGraficos.height();

      if (scrollPos > containerHeight / 2) {
        headerGraficos.text("VENTAS MENSUALES"); // Cambia el texto y el color según sea necesario
      } else {
        headerGraficos.text("VENTAS SEMANALES"); // Restaura el texto y el color original
      }
    });
  });


var content = document.getElementById('myContent');

  content.addEventListener('wheel', function(event) {
    // Detectar la dirección del desplazamiento
    var direction = event.deltaY > 0 ? 'down' : 'up';

    // Hacer scroll hasta arriba o abajo según la dirección
    if (direction === 'down') {
      content.scrollTop += 100; // ajusta según tus necesidades
    } else {
      content.scrollTop -= 100; // ajusta según tus necesidades
    }

    // Prevenir el comportamiento por defecto del evento wheel
    event.preventDefault();
  });