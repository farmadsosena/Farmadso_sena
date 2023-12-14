// Obtener la ventana modal y el botón de cierre
let modal = document.getElementById("myModal");
let span = document.getElementsByClassName("close")[0];
let ver = document.getElementsByClassName("seeMore")[0];

// Asegúrate de que este elemento exista
function abrirNoti(idCompra) {
  var formData = new FormData();
  formData.append("idCompra", idCompra);

  fetch("../models/datosCompra.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        var idCompra = data.data.idCompra;
        var fechaCompra = data.data.fechaCompra;
        var nombrePaciente = data.data.nombrePaciente;
        var apellidoPaciente = data.data.apellidoPaciente;
        var direccionPaciente = data.data.direccionPaciente;

        var direccionesMedicamentos = data.data.direccionesMedicamentos;

        // Parsea la fecha antes de formatearla
        var fechaFormateada = new Date(Date.parse(fechaCompra));
        fechaFormateada.setMinutes(
          fechaFormateada.getMinutes() + fechaFormateada.getTimezoneOffset()
        );

        var opcionesFecha = {
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
        };
        var fechaFinal = fechaFormateada.toLocaleDateString(
          "es-ES",
          opcionesFecha
        );

        document.getElementById("idCompraField").value = idCompra;
        document.querySelector("#order-number").textContent = "000" + idCompra;
        document.querySelector("#fechaVer").textContent = fechaFinal;
        document.querySelector("#customer-name").textContent =
          nombrePaciente + " " + apellidoPaciente;
        document.querySelector("#customer-address").textContent =
          direccionPaciente;

        var direccionesHTML = "";
        direccionesMedicamentos.forEach((direccion, index) => {
          direccionesHTML += `<p>Direccion Farmacia ${
            index + 1
          }: ${direccion}</p>`;
        });
        document.querySelector("#medication-addresses").innerHTML =
          direccionesHTML;

        modal.style.display = "flex";
      } else {
        console.error("Error en la respuesta del servidor:", data.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Cuando el usuario hace clic en el botón 'Ver más', abrir la ventana modal
// Asociar la función al evento de clic en el botón 'Ver más'
if (ver) {
  ver.addEventListener("click", abrirNoti);
}

// Cuando el usuario hace clic en el botón de cierre, cerrar la ventana modal
span.onclick = function () {
  modal.style.display = "none";
};

// Cuando el usuario hace clic fuera de la ventana modal, cerrarla
window.onclick = function (event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
