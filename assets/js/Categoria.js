
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


function cerrarEdit() {
  var contMedicine = document.querySelector('.container-categoria');
  var contForm = document.querySelector('.categorias');

  contMedicine.style.display = 'flex';
  contForm.style.display = 'none';
}


function openEditCategoria(idCategorias){
  console.log(idCategorias)
  var contMedicine = document.querySelector('.container-categoria');
  var contForm = document.querySelector('.categorias');

  contMedicine.style.display = 'none';
  contForm.style.display = 'flex';

  fetch("../controllers/editarCategoria.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "idCategoria=" + idCategorias,
})
    .then((response) => {
        if (!response.ok) {
            throw new Error("La solicitud no pudo completarse correctamente.");
        }
        return response.json();
    })
    .then((data) => {
      document.getElementById('number999').value = data.data.id
      document.getElementById('nombrecategoria').value = data.data.Nombre
      document.getElementById('descripcioncategoria').value = data.data.descripcion
      document.getElementById('img').value = data.data.descripcion

        // Procesar la respuesta del servidor
        
      
    })
    .catch((error) => {
        console.error("Error al eliminar la categoría:", error);
        alert("Error al eliminar la categoría.");
    });
}
  



document.getElementsByClassName('form_edit').addEventListener('submit', function(event) {
  // Prevenir el comportamiento predeterminado del formulario
  event.preventDefault();

  // Crear un nuevo objeto FormData
  var formData = new FormData(this);

  // Agregar el par clave-valor al FormData
  formData.append('crearEvaluacion', true);
  var formulario = this;

  // Realizar la solicitud Fetch
  fetch('../controllers/editarCategoria.php', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      // Manejar la respuesta del servidor
      if (!response.ok) {
        throw new Error('Error en la solicitud');
      }
      return response.json(); // O response.text(), según el tipo de respuesta esperada
    })
    .then(data => {
      // Manejar los datos obtenidos del servidor
      cerrarEdit();
      
    })
    .catch(error => {
      // Manejar errores en la solicitud
      console.error('Error en la solicitud:', error);
    });
});
