const rasterElements = document.querySelectorAll(".scroll2 .raster");
const producElement = document.querySelector(".img-oferta .produc img");

rasterElements.forEach((raster) => {
  raster.addEventListener("click", () => {
    const imageUrl = raster.querySelector("img").getAttribute("src");
    producElement.setAttribute("src", imageUrl);
  });
});

document.querySelectorAll(".top-product>img").forEach((card_medicamento) => {
  card_medicamento.addEventListener("click", function () {
    var ventana_detalles_medicamentos =
      document.querySelector(".venergar-info");
    ventana_detalles_medicamentos.classList.add("active-venergar-info");
  });
});

document.querySelector(".salir-vista-medicamento").addEventListener("click", function (){
  document.querySelector(".venergar-info").classList.remove("active-venergar-info");
});