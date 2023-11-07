$(document).ready(function() {
    $('.formularioEntrega').submit(function(e) {
        e.preventDefault();

        // Obtener datos del formulario
        var formData = new FormData(this);

        $.ajax({
            url: 'models/cargarimagenCompra.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Verificar el estado de la respuesta
                if (response.status === "success") {
                    console.log(response.message);
                    
                    // Recargar la página
                    location.reload();
                } else {
                    console.error(response.message);
                }
            },
            error: function(error) {
                // Manejar errores aquí
                console.error('Error en la petición AJAX:', error);
            }
        });
    });
});
