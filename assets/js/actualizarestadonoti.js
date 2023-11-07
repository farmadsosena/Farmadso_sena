$(document).ready(function () {
    // Asigna un controlador de eventos al botón APLICAR
    $("#aplicarButton").click(function () {
        // Obtiene el valor de idCompra
        var idCompra = $("#idCompraField").val();

        // Realiza la solicitud AJAX
        $.ajax({
            type: "POST",
            url: "models/cambiodeestadoNoti.php", // Reemplaza con la ruta correcta a tu script PHP
            data: { idCompra: idCompra },
            success: function (response) {
                // Muestra la alerta al usuario
                alert(response);
                // Recarga la página después de la actualización exitosa
                location.reload();
            },
            error: function (error) {
                console.error("Error al realizar la solicitud AJAX:", error);
            }
        });
    });
});
