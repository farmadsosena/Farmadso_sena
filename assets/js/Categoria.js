
document.addEventListener('DOMContentLoaded', function () {
    cargarContenido();
})

function cargarContenido() {
    var CargarDatos = document.getElementById("contenedorCategoria");
    CargarDatos.innerHTML = "";
  
    fetch("../controllers/CargarCategoria.php", {
      method: "GET",
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("La solicitud no pudo completarse correctamente.");
        }
        return response.text();
      })
      .then((data) => {
        CargarDatos.innerHTML = data;
      })
      .catch((error) => {
        console.error("Error al cargar el contenido:", error);
        alert("Error al cargar el contenido.");
      });
  }
  