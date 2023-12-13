document.querySelector(".venergar-info").addEventListener("click",function(event){
  var containerRapido = document.querySelector(".container-rapido");

  if (!containerRapido.contains(event.target)) {
      this.classList.remove("active-venergar-info");
  }
});

document.querySelectorAll(".abrirDetalles_medicamentos").forEach((card_medicamento) => {
  var card = card_medicamento.parentNode;
  card_medicamento.addEventListener("click", function () {
    enviar_recibir_datos(card,card_medicamento);
  });
});

document
  .querySelector(".salir-vista-medicamento")
  .addEventListener("click", function () {
    document
      .querySelector(".venergar-info")
      .classList.remove("active-venergar-info");
  });

function enviar_recibir_datos(card,card_medicamento) {
  if(card_medicamento){
    if(card_medicamento.classList.contains("medicamento_result")){
      var id_medi_relacionado = card_medicamento.getAttribute("data-im");
      set_medicamentos_masBuscado(id_medi_relacionado);
    }
  }
  $(".container-rapido").css("display", "none");
  $(".cont-spinner-deta_med").css("display", "flex");
  $(".venergar-info").addClass("active-venergar-info");
  var im = (card.getAttribute("data-im")) ? card.getAttribute("data-im") : card_medicamento.getAttribute("data-im");
  var imd = atob(im);

  $.ajax({
    type: "POST",
    url: "../controllers/detallesRapidos.php",
    data: { im: imd },
    dataType: "json",
    success: function (datos) {
      $(".cont-spinner-deta_med").css("display", "none");
      $(".container-rapido").css("display", "flex");
      mostrar_detallesMedi(datos);
    },
    error: function () {
      console.log("ocurrio un error");
    },
  });
}

function mostrar_detallesMedi(datos) {
  var idmedicamento = datos.medicamento.idmedicamento;
  var idpromocion = datos.medicamento.idpromocion;
  var nombreFarmacia = datos.medicamento.Nombre;
  var nombreMedicamento = datos.medicamento.nombre;
  var codigoReferencia = datos.medicamento.codigo;
  var precioAntes = datos.medicamento.precio;
  var descuento = datos.medicamento.valordescuento;
  var precio_actual = precioAntes - precioAntes * (descuento / 100);
  var ahorro = precioAntes - precio_actual;
  var precio_antes_formateado = precioAntes.toLocaleString("es-ES");
  var precio_actual_formateado = precio_actual.toLocaleString("es-ES");
  var precio_ahorro_formateado = ahorro.toLocaleString("es-ES");
  var descripcion = datos.inventario.descripcion;
  var imgPrincipal = datos.medicamento.imagenprincipal;
  var imagenes = datos.inventario.imagendescrip;
  var stock = datos.inventario.stock;

  var arrayDeImagenes = imagenes.split(",");
  $(".raster").remove();
  arrayDeImagenes.forEach((imagen) => {
    var img = imagen.trim();
    var contImg = $(
      "<section class='raster'><img src='../uploads/imgProductos/" +
        img +
        "' alt='" +
        nombreMedicamento +
        "'></section>"
    );

    contImg.click(function () {
      var img_mostrar_principal = this.querySelector("img").src;
      document.querySelector(".produc>img").src = img_mostrar_principal;
  });

    $(".scroll2").append(contImg);
  });

  if(idpromocion){
    $(".descripcion_det_med > p").css("height","5rem");
    $(".precio-antes").css("display","flex");
    $(".img-oferta>button").css("display","flex");
    $(".precio-a").text("Antes $ " + precio_antes_formateado);
    $(".ahorro").text("Ahorra $" + precio_ahorro_formateado);
    $(".precio").text("$" + precio_actual_formateado);
    $(".img-oferta>button").text("Ahorra "+descuento+"%");
    $(".precio_detalles_r").val(precio_actual);
  }else{
    $(".descripcion_det_med > p").css("height","8rem");
    $(".precio-a").text("");
    $(".ahorro").text("");
    $(".img-oferta>button").text("");
    $(".precio-antes").css("display","none");
    $(".img-oferta>button").css("display","none");
    $(".precio").text("$" + precio_antes_formateado);
    $(".precio_detalles_r").val(precioAntes);
  }
  $(".idmedicamento_detalles_r").val(idmedicamento);
  $(".cantidadcarrito_detalles_r").attr("max",stock);
  $(".cantidadcarrito_detalles_r").val(1);
  $(".nombre_farmacia").text(nombreFarmacia);
  $(".nombre_med").text(nombreMedicamento);
  $(".c_m").text("Referencia: " + codigoReferencia);
  $(".stock_detaM").text("Cantidad: " + stock);
  $(".descripcion_det_med>p").text(descripcion);
  $(".produc>img").attr("src", "../uploads/imgProductos/" + imgPrincipal + "");
  $(".produc>img").attr("alt", nombreMedicamento);
}
