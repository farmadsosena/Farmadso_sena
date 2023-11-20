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


$(document).ready(function () {
    $(".search input").on("input", function () {
        var searchTerm = $(this).val().toLowerCase();

        // Oculta todos los resultados
        $(".card").hide();
        $("#mensajeNoResultados").hide();

        // Filtra y muestra solo los resultados que coinciden con la búsqueda
        var resultadosFiltrados = $(".card").filter(function () {
            return $(this).data("informacion").toLowerCase().includes(searchTerm);
        });

        if (resultadosFiltrados.length > 0) {
            // Mostrar los resultados filtrados si hay coincidencias
            resultadosFiltrados.show();
            document.getElementById('mensajeNoResultados').classList.remove('flex')
        } else {
            // Mostrar un mensaje cuando no hay coincidencias
            document.getElementById('mensajeNoResultados').classList.add('flex')
        }
    });
});
