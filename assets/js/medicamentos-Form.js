


function openFormMedicine() {
   
    var  contMedicine = document.querySelector('.cont-medicine');
    var contForm = document.querySelector('.cont-form');
    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';
}

function closeFormMedicine() {
  
   
    var  contMedicine = document.querySelector('.cont-medicine');
    var contForm = document.querySelector('.cont-form');
    // Mostrar alerta
    var confirmClose = confirm("Si vuelves, se perderá el contenido incluido en los campos. ¿Deseas continuar?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';

        // Limpiar el contenido del formulario
        var formInputs = contForm.querySelectorAll('.custom-file-input');
        formInputs.forEach(function(input) {
            input.value = ''; // Limpiar el valor del input
        });

        var LabelInput = contForm.querySelectorAll('.no-file-selected');
        LabelInput.forEach(function(input) {
            input.textContent = 'Selecciona una imagen.'; // Limpiar el valor del input
        });
        document.getElementById('medicineAdd').reset()
        
    }
}

function openFormCategories() {
var contMedicine = document.querySelector('.container-categoria');
var contForm = document.querySelector('.categorias');
    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';

    var formularioCreate = document.getElementById('categoryAdd');
    formularioCreate.classList.add('active');

    // Quitar clase 'active' al formulario 'form_edit'
    var formularioEdit = document.getElementById('form_edit');
    if (formularioEdit) {
        formularioEdit.classList.remove('active');
    }
    
}


var formularioCreate = document.getElementById('categoryAdd');
// Agregar el event listener para el formulario
formularioCreate.addEventListener('submit', function (event) {
    event.preventDefault();



    // Recuperar los datos del formulario
    const formData = new FormData(this);

    // Enviar la información al servidor usando Fetch
    fetch('../controllers/agregarCategoria.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Puedes cambiar a response.text() si esperas una respuesta diferente
    .then(data => {
        // Manejar la respuesta del servidor
        console.log(data);

        // Redirigir o mostrar un mensaje de éxito según la respuesta del servidor
       
            formularioCreate.reset();
            closeFormCategory();
           cargarContenido()
      
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
    });
});



function closeFormCategories() {
    var contMedicine = document.querySelector('.container-categoria');
    var contForm = document.querySelector('.categorias');

    // Mostrar alerta
    var confirmClose = confirm("Si vuelves, se perderá el contenido incluido en los campos. ¿Deseas continuar?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';

        // Limpiar el contenido del formulario
        var formInputs = contForm.querySelectorAll('input');
        formInputs.forEach(function(input) {
            input.value = ''; // Limpiar el valor del input
        });
    }
    cargarContenido()
}


function closeFormCategory() {
    var contMedicine = document.querySelector('.container-categoria');
    var contForm = document.querySelector('.categorias');
    contMedicine.style.display = 'flex';
        contForm.style.display = 'none';
        
        
}




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

function openEditCategoria(idCategorias) {
    console.log(idCategorias);
    var contMedicine = document.querySelector('.container-categoria');
    var contForm = document.querySelector('.categorias');

    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';

    // Obtén la referencia al formulario
    var formularioCreate = document.getElementById('categoryAdd');
    if (formularioCreate) {
        formularioCreate.classList.remove('active');
    }

    // Agregar clase 'active' al formulario 'form_edit'
    var formElement = document.getElementById('form_edit');
    formElement.classList.add('active');

    fetch("../controllers/EditarCategoria.php", {
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
            document.getElementById('editcategoria').value = data.data.Nombre
            document.getElementById('editdescripcioncategoria').value = data.data.descripcion;

            // Procesar la respuesta del servidor
        })
        .catch((error) => {
            console.error("Error al obtener la categoría:", error);
            alert("Error al obtener la categoría.");
        });
}

var formulario = document.getElementById('form_edit');

// Agrega un listener para el evento submit del formulario
formulario.addEventListener('submit', function (event) {
    event.preventDefault();
    // Función para enviar los datos al servidor
    function enviarDatosAlServidor() {
        // Obtén los datos del formulario
        var formDatas = new FormData(formulario);

        // Realizar la solicitud Fetch
        fetch('../controllers/EditarCategoria.php', {
            method: 'POST',
            body: formDatas
        })
            .then(response => {
                // Manejar la respuesta del servidor
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.json(); // O response.text(), según el tipo de respuesta esperada
            })
            .then(data => {
                console.log("Datos recibidos del servidor:", data);
                // Manejar los datos obtenidos del servidor
                if (data.success) {
                    // Limpiar el formulario o realizar acciones adicionales
                    cerrarEdit();
                } else {
                    // Manejar el caso en que la respuesta del servidor indique un error
                    console.error('Error en la respuesta del servidor:', data.error);
                }
            })
            .catch(error => {
                // Manejar errores en la solicitud
                console.error('Error en la solicitud:', error);
            });
    }

    // Llama a la función enviarDatosAlServidor al enviar el formulario
    enviarDatosAlServidor();
});

// Función para cerrar el formulario (ajusta esto según tu implementación real)
function cerrarEdit() {
    var formElement = document.getElementById('form_edit');
    formElement.classList.remove('active');
    // Realizar cualquier otra acción necesaria para cerrar el formulario
}








function cerrarEdit() {
  console.log("cerrarEdit() ejecutada");
  var contMedicine = document.querySelector('.container-categoria');
  var contForm = document.querySelector('.categorias');

  contMedicine.style.display = 'flex';
  contForm.style.display = 'none';
  document.getElementById('form_edit').reset();
  cargarContenido()
}









  

// Esperar a que el DOM esté completamente cargado

    // Asociar la función al evento de envío del formulario






