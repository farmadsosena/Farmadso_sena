$(document).ready(function () {
    // Asigna un controlador de eventos al botón APLICAR
    $("#aplicarButton").click(function () {
        // Obtiene el valor de idCompra
        var idCompra = $("#idCompraField").val();

        // Realiza la solicitud AJAX
        $.ajax({
            type: "POST",
            url: "../models/cambiodeestadoNoti.php", // Reemplaza con la ruta correcta a tu script PHP
            data: { idCompra: idCompra },
            dataType: 'json', // Asegura que la respuesta se interprete como JSON
            success: function (response) {
                // Verifica el estado de la respuesta
                if (response.status === "success") {
                    // Muestra la alerta de éxito con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        // Recarga la página después de hacer clic en OK
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    // Muestra la alerta de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (error) {
                console.error("Error al realizar la solicitud AJAX:", error);
            }
        });
    });
});
