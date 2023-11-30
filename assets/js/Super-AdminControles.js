$(document).ready(function () {
  $(".llamarAJAX").on("click", function () {

    var estado = $(this).data("estado");

    //El codigo para mostrar los datos de la solicitud esta en controllers/nuevasSolicitudes.php
    //Se dejo el ajax ahi
    $.ajax({
      type: "POST",
      url: "../controllers/nuevasSolicitudes.php",
      data: { query: estado },
      success: function (data) {
        document.getElementById('iniciar').classList.add('none');
        document.getElementById('reemplazar').classList.add('show');
        document.getElementById('limpiar').classList.add('show');
        $("#reemplazar").html(data);
        // Capturar el valor de data-diag y asignarlo al input al hacer clic en un elemento mauso-diagnee

        $("#limpiar").on("click", function () {
          document.getElementById('iniciar').classList.remove('none');
          document.getElementById('reemplazar').classList.remove('show');
          document.getElementById('limpiar').classList.remove('show');
        });
      },
    });
  });
});



document.addEventListener('DOMContentLoaded', function () {
  // Estado de los filtros
  var filtros = {
    nombre: '',
    correo: '',
    estado: '',
    telefono: '',
    rol: ''
  };

  // Manejar el evento de cambio en cualquier campo de búsqueda
  var camposDeBusqueda = document.querySelectorAll('input[type="search"]');

  camposDeBusqueda.forEach(function (campo) {
    campo.addEventListener('input', function () {
      // Actualizar el estado del filtro correspondiente
      filtros[campo.id] = campo.value;

      // Limpiar los valores vacíos en los filtros antes de realizar la búsqueda
      for (var key in filtros) {
        if (filtros.hasOwnProperty(key) && filtros[key] === '') {
          delete filtros[key];
        }
      }
      console.log(filtros)
      // Realizar la búsqueda y actualizar los resultados
      realizarBusqueda();
    });
  });

  // Función para realizar la búsqueda y mostrar los resultados
  function realizarBusqueda() {
    // Realizar una solicitud AJAX para obtener los resultados filtrados
    $.ajax({
      type: 'POST',
      url: '../models/FiltroSuperAdmin.php',
      data: { filtros: filtros },
      success: function (data) {
        // Actualizar la sección #iniciar con los resultados filtrados
        $('#iniciar').html(data);
      }
    });
  }
});


//El controlador de desactivar o activar una cuenta esta en models/UsuarioSuper-admin.php
//Al final del archivo, se pone alli porque aqui no hagarra el codigo


