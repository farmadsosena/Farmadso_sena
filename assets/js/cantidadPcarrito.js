$(document).ready(function() {
    // Llamada AJAX para obtener el recuento de usuarios
    $.ajax({
        url: '../controllers/cantidadProductos.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Actualizar el contador de usuarios en la página
            $('#productCount').text(response.count);
        },
        error: function(error) {
            console.log(error);
        }
    });
});