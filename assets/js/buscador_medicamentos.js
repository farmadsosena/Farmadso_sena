document
  .querySelectorAll(".buscador_medicamentos")
  .forEach((buscador_medicamento) => {
    buscador_medicamento.addEventListener("focus", function () {
      document
        .querySelector(".result_buscador")
        .classList.add("active-result_buscador");
    });
  });

document.addEventListener("click", function (event) {
  var buscadorInput1 = document.querySelector("#buscador_medicamento1");
  var buscadorInput2 = document.querySelector("#buscador_medicamento2");
  var resultContainer = document.querySelector(".result_buscador");
  var venergarInfo = document.querySelector(".venergar-info");

  var activo = document.querySelector(".active-result_buscador");
  if (activo) {
    if(!venergarInfo.contains(event.target)){
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