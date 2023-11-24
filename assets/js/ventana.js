document.addEventListener("DOMContentLoaded", function () {
  const settingsButton = document.getElementById("settings");
  const historyButton = document.getElementById("history");
  const mainDelivery = document.querySelector(".mainDelivery");
  const nuevoContenido1 = document.getElementById("nuevoContenido1");
  const nuevoContenido2 = document.getElementById("nuevoContenido2");


  settingsButton.addEventListener("click", function () {
      // Reemplazamos el contenido de mainDelivery con el contenido nuevo
      mainDelivery.innerHTML = nuevoContenido1.innerHTML;
  });

  historyButton.addEventListener("click", function () {
      mainDelivery.innerHTML = nuevoContenido2.innerHTML;
  });
});


