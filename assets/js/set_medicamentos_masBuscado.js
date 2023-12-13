function set_medicamentos_masBuscado(id_medi_masBuscado){
    $.ajax({
        type: "POST",
        url: "../controllers/set_medicamentos_masBuscado.php",
        data: { id_medi_masBuscado: id_medi_masBuscado },
        success: function (datos) {
        },
        error: function () {
          console.log("ocurrio un error");
        },
      });
}