
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

  function eliminarCategoria(idCategoria) {
    console.log(idCategoria)
    var confirmar = confirm("¿Estás seguro de que quieres eliminar este registro?");

    if (confirmar) {
        fetch("../controllers/CargarCategoria.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "idCategoria=" + idCategoria,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("La solicitud no pudo completarse correctamente.");
                }
                return response.text();
            })
            .then((data) => {
                // Procesar la respuesta del servidor
                cargarContenido();
                alert(data); // Muestra la respuesta en una alerta
                 // Vuelve a cargar el contenido después de la eliminación
            })
            .catch((error) => {
                console.error("Error al eliminar la categoría:", error);
                alert("Error al eliminar la categoría.");
            });
    }
}

