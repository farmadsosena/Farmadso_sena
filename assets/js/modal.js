var openModalButton = document.querySelector(".openModalButton");
var secondModal = document.querySelector(".modal");
var closeButton = document.querySelector(".close");

function abrirG(idCompra) {
  var formData = new FormData();
  formData.append("idCompra", idCompra);

  fetch("../models/datosHistoria.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        var idCompra = data.data.idCompra;
        var fechafinal = data.data.fechaCompra; // Cambiado a fechaCompra
        var nombreUsuario = data.data.nombrePaciente; // Cambiado a nombrePaciente
        var apellidoPaciente = data.data.apellidoPaciente;
        var direccionCliente = data.data.direccionCliente;

        // Utilizar campos de dirección principal y two para las nuevas direcciones
        var direccion1 = data.data.direccionesMedicamentos[0] || ""; // Puedes ajustar según la estructura de tu respuesta
        var direccion2 = data.data.direccionesMedicamentos[1] || ""; // Puedes ajustar según la estructura de tu respuesta

        var imagen = data.data.imagen;

        // Formatear la fecha
        var fechaFormateada = new Date(fechafinal);
        var dia = fechaFormateada.getDate();
        var mes = fechaFormateada.getMonth() + 1;
        var anio = fechaFormateada.getFullYear();

        // Agregar un cero delante si el día o el mes es menor que 10
        dia = dia < 10 ? "0" + dia : dia;
        mes = mes < 10 ? "0" + mes : mes;

        var fechafinal = dia + "/" + mes + "/" + anio;

        document.querySelector("#numFact").textContent = "000"+idCompra;
        document.querySelector("#FechFact").textContent = fechafinal;
        document.querySelector("#DIREFact").textContent = direccionCliente;
        document.querySelector("#DpFact").textContent = direccion1;
        document.querySelector("#dtFact").textContent = direccion2;
        document.querySelector("#ImgFact").src = "../assets/EvidenciaCompra/" + imagen;
        document.querySelector("#ClienteFact").textContent = nombreUsuario + " " + apellidoPaciente;

        secondModal.style.display = "flex";
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
