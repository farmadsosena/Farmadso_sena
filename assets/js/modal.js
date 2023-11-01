var openModalButton = document.querySelector(".openModalButton");
var secondModal = document.querySelector(".modal"); // Cambiado de getElementsByClassName a querySelector
var closeButton = document.querySelector(".close");

function abrirG(idCompra) {
  // Crear un objeto FormData para enviar el ID como parte del cuerpo de la solicitud
  var formData = new FormData();
  formData.append("idCompra", idCompra);

  fetch("views/datosHistoria.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      // Manejar la respuesta del servidor
      if (data.status === "success") {
      
        var idCompra = data.data.idCompra;
        var fechafinal = data.data.fechaFinal;
        var nombreUsuario = data.data.nombreUsuario;
        var apellidoPaciente = data.data.apellidoPaciente;
        var direccionCliente = data.data.direccionCliente;
        var direccionPrincipal = data.data.direccionPrincipal;
        var direccionTwo = data.data.direccionTwo;
        var imagen = data.data.imagen;

        // Formatear la fecha
        var fechaFormateada = new Date(fechafinal + "T00:00:00Z");
        var dia = fechaFormateada.getDate() ;
        var mes = fechaFormateada.getMonth() + 1; // Sumar 1 porque los meses comienzan desde 0
        var anio = fechaFormateada.getFullYear();

        // Agregar un cero delante si el día o el mes es menor que 10
        dia = dia < 10 ? "0" + dia : dia;
        mes = mes < 10 ? "0" + mes : mes;

        var fechafinal = dia + "/" + mes + "/" + anio;

        document.querySelector("#numFact").textContent = "000" + idCompra;
        document.querySelector("#FechFact").textContent = fechafinal;
        document.querySelector("#DIREFact").textContent = direccionCliente;
        document.querySelector("#DpFact").textContent = direccionPrincipal;
        document.querySelector("#dtFact").textContent = direccionTwo;
        document.querySelector("#ImgFact").src = "assets/EvidenciaCompra/" + imagen;
        document.querySelector("#ClienteFact").textContent = nombreUsuario + " " + apellidoPaciente;

        secondModal.style.display = "flex"; // Mover aquí para mostrar la modal solo en caso de éxito
      } else {
        console.error("Error en la respuesta del servidor:", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function cerrarG() {
  secondModal.style.display = "none";
}

window.addEventListener("click", function (event) {
  if (event.target === secondModal) {
    secondModal.style.display = "none";
  }
});
