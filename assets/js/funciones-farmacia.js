function eliminarMedicamento(idMedicamento) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este medicamento?");
    if (confirmacion) {
        $.ajax({
            type: "POST",
            url: "controllers/eliminar_medicamento.php", 
            data: { idMedicamento: idMedicamento },
            success: function(response) {
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

    $(document).ready(function() {
        // Manejador de clic para el botón
        $('#cambiarEstadoBtn').on('click', function() {
            // Obtiene el idcompra del atributo data
            var idcompra = $(this).data('idcompra');

            // Realiza la solicitud AJAX
            $.ajax({
                url: 'controllers/cambiadorEstado.php',  // URL del archivo PHP que manejará la solicitud
                method: 'POST',              // Método de solicitud
                data: { idcompra: idcompra }, // Datos que se enviarán al servidor
                success: function(response) {
                    // Maneja la respuesta del servidor
                    alert(response);

                    // Puedes hacer más cosas aquí según la respuesta del servidor
                },
                error: function(error) {
                    // Maneja errores de la solicitud AJAX
                    console.error(error);
                }
            });
        });
    });

       
