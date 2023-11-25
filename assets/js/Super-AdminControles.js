$(document).ready(function () {
  $(".llamarAJAX").on("click", function () {
   
    var estado= $(this).data("estado");

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


//El codigo para mostrar los datos de la solicitud esta en controllers/nuevasSolicitudes.php
//Se dejo el ajax ahi
