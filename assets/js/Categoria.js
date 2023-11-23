
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




  

function eliminarCategoria() {
    // Obtén una NodeList de elementos con la clase 'delete'
    const botonesEliminar = document.querySelectorAll(".delete");
  
    // Itera sobre la NodeList y agrega un evento de clic a cada elemento
    botonesEliminar.forEach((boton) => {
      boton.addEventListener("click", async () => {
        // Obtiene el valor del atributo data-delete del elemento actual
        const idFormula = boton.dataset.delete;
  
        try {
          const response = await fetch("../controllers/DeleteFormula.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({ idFormula }).toString(),
          });
  
          if (!response.ok) {
            throw new Error("La solicitud no pudo completarse correctamente.");
          }
  
          const data = await response.json();
  
          if (data.success) {
            // Eliminación exitosa
            alert(data.message);
            cargarContenido(); // Otra lógica que deseas realizar después de la eliminación
          } else {
            // Eliminación fallida
            alert("Error: " + data.message);
          }
        } catch (error) {
          console.error("Error en la solicitud", error);
          alert("Error en la solicitud: " + error.message);
        }
      });
    });
  }
  