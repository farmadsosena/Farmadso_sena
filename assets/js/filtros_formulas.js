//AJAX PARA ENVIAR LOS DATOS RECOLECTADOS DE LOS FILTROS

$(document).ready(function () {
    $(".config_filtros .ventana-sal div").on("click", function () {
        var text = $(this).text();
        var filtro = $(this).data("valor");
        var contenedorSeleccionado = $(this).closest('.config_filtros');
        // Obtener el tipo de filtro (doctor, estado, fecha)
        var tipoFiltro = contenedorSeleccionado.data('tipo-filtro');

        // Actualizar el contenido del contenedor seleccionado
        contenedorSeleccionado.find('.filtros-titulo').text(text);
        contenedorSeleccionado.find('.filtros-titulo').val(filtro);

        // Obtener todos los filtros seleccionados
        var filtros = {};
        $(".config_filtros").each(function () {
            var tipo = $(this).data('tipo-filtro');
            var valor = $(this).find('.filtros-titulo').val();

            if (tipo === "fechaOrden") {
                valor = $(this).find('#fecha').val(); // Obtener el valor del input de fecha
            }

            filtros[tipo] = valor;
        });


        // Realizar la solicitud AJAX al servidor con todos los filtros
        $.ajax({
            url: "../controllers/FiltrosFormulas.php",
            type: "POST",
            data: { filtros: JSON.stringify(filtros) }, // Convertir el objeto a cadena JSON
            success: function (response) {
                $("#LLEGARFR").html(response);
            },
            error: function (error) {
                console.log("Error en la solicitud AJAX:", error);
            }
        });
    });
});



$(document).ready(function() {
    // Evento de cambio en el cuadro de búsqueda
    $('#cassos').on('input', function() {
        var searchTerm = $(this).val().toLowerCase(); // Obtener el término de búsqueda en minúsculas
        var resultadosEncontrados = false;
        var estanco= document.getElementById('mensajeNoResultados');
        // Iterar sobre las tarjetas de fórmulas

        $('#LLEGARFR .card').each(function() {
            var informacion = $(this).data('informacion').toLowerCase();
            

            // Mostrar u ocultar según si el término de búsqueda está presente en la información
            if (informacion.includes(searchTerm)) {
                $(this).show();
                resultadosEncontrados= true;
            } else {
                $(this).hide();
            }
        });

         if (resultadosEncontrados) {
            estanco.classList.remove('flex')
            } else {
            estanco.classList.add('flex')
            }
    });
});