document
  .querySelectorAll(".buscador_medicamentos")
  .forEach((buscador_medicamento) => {
    buscador_medicamento.addEventListener("focus", function () {
      if (this.value != "") {
        buscarMedicamentos_relacionados(this.value);
      } else {
        document.querySelector(".produc_no").style.display = "none";
        document.querySelector(".cont-spinner-result_buscador").style.display =
          "none";
        document.querySelector(".resultado_busqueda").style.display = "none";
        document.querySelector(".vista_prede_buscador").style.display = "flex";
      }
      document
        .querySelector(".result_buscador")
        .classList.add("active-result_buscador");
    });
    buscador_medicamento.addEventListener("input", function () {
      buscarMedicamentos_relacionados(this.value);

      localStorage.setItem("valorBuscado", this.value);
    });
  });

function restaurarValorBuscado() {
  document
    .querySelectorAll(".buscador_medicamentos")
    .forEach((buscador_medicamento) => {
      var valorBuscado = localStorage.getItem("valorBuscado");
      if (valorBuscado !== null) {
        buscador_medicamento.value = valorBuscado;
      }
    });
}

document.addEventListener("DOMContentLoaded", restaurarValorBuscado);

document.addEventListener("click", function (event) {
  var buscadorInput1 = document.querySelector("#buscador_medicamento1");
  var buscadorInput2 = document.querySelector("#buscador_medicamento2");
  var resultContainer = document.querySelector(".result_buscador");
  var venergarInfo = document.querySelector(".venergar-info");

  var activo = document.querySelector(".active-result_buscador");
  if (activo) {
    if (!venergarInfo.contains(event.target)) {
      if (window.innerWidth < 800) {
        if (
          !buscadorInput1.contains(event.target) &&
          !resultContainer.contains(event.target)
        ) {
          resultContainer.classList.remove("active-result_buscador");
        }
      } else {
        if (
          !buscadorInput2.contains(event.target) &&
          !resultContainer.contains(event.target)
        ) {
          resultContainer.classList.remove("active-result_buscador");
        }
      }
    }
  }
});

function buscarMedicamentos_relacionados(campoBuscar) {
  if (campoBuscar != "") {
    document.querySelector(".produc_no").style.display = "none";
    document.querySelector(".resultado_busqueda").style.display = "none";
    document.querySelector(".vista_prede_buscador").style.display = "none";
    document.querySelector(".cont-spinner-result_buscador").style.display =
      "flex";
  } else {
    document.querySelector(".produc_no").style.display = "none";
    document.querySelector(".cont-spinner-result_buscador").style.display =
      "none";
    document.querySelector(".resultado_busqueda").style.display = "none";
    document.querySelector(".vista_prede_buscador").style.display = "flex";
    return;
  }
  $.ajax({
    type: "POST",
    url: "../controllers/buscador_medicamentos.php",
    data: { campoBuscar: campoBuscar },
    dataType: "json",
    success: function (datos) {
      document.querySelector(".cont-spinner-result_buscador").style.display =
        "none";
      document.querySelector(".produc_no").style.display = "none";
      document.querySelector(".vista_prede_buscador").style.display = "none";
      document.querySelector(".resultado_busqueda").style.display = "flex";
      mostrar_buscarMedicamentos_relacionados(datos, campoBuscar);
    },
    error: function () {
      console.log("ocurrio un error");
    },
  });
}

function mostrar_buscarMedicamentos_relacionados(datos, campoBuscar) {
  $(".medicamento_result").remove();
  $(".todos_medicamento_result>a").text("");
  if (datos.noexiste) {
    document.querySelector(".produc_no").style.display = "none";
    document.querySelector(".cont-spinner-result_buscador").style.display =
      "none";
    document.querySelector(".resultado_busqueda").style.display = "none";
    document.querySelector(".vista_prede_buscador").style.display = "flex";
    return;
  }
  if (datos.noconincide) {
    document.querySelector(".vista_prede_buscador").style.display = "none";
    document.querySelector(".cont-spinner-result_buscador").style.display =
      "none";
    document.querySelector(".resultado_busqueda").style.display = "none";
    document.querySelector(".produc_no").style.display = "flex";
    return;
  }

  var todos_relacionado = null;
  datos.forEach((medi_relacionados) => {
    var idMedicamento_conver = btoa(medi_relacionados.idmedicamento);
    medicamento = $(
      "<button class='medicamento_result abrirDetalles_medicamentos' data-im='" +
        idMedicamento_conver +
        "'><img src='../uploads/imgProductos/" +
        medi_relacionados.imagenprincipal +
        "' alt='" +
        medi_relacionados.nombre +
        "'><p>" +
        medi_relacionados.nombre +
        "</p></button>"
    );
    $(".cont_medicamento_result").append(medicamento);
    todos_relacionado = medi_relacionados.coinciden;
  });

  document
    .querySelectorAll(".abrirDetalles_medicamentos")
    .forEach((card_medicamento) => {
      var card = card_medicamento.parentNode;
      card_medicamento.addEventListener("click", function () {
        enviar_recibir_datos(card, card_medicamento);
      });
    });

  if (todos_relacionado <= 6) {
    $(".todos_medicamento_result").css("display", "none");
  } else {
    $(".todos_medicamento_result").css("display", "flex");
    $(".todos_medicamento_result>a").text(
      "Ver todos los " + todos_relacionado + " medicamentos relacionados"
    );
    $(".todos_medicamento_result>a").attr(
      "href",
      "productos.php?vBsLQ=" + campoBuscar
    );
  }
}
