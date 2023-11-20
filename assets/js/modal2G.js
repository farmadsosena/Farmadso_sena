// function abrirGa(idDomi) {

//   // Crear un objeto FormData para enviar el ID como parte del cuerpo de la solicitud
//   var formData = new FormData();
//   formData.append("idDomi", idDomi);

//   fetch("models/datosDomi.php", {
//     method: "POST",
//     body: formData,
//   })
//   .then((response) => response.json())
//   .then((data) => {
//     // Manejar la respuesta del servidor
//     if (data.status === "success") {
//       // Acceder a los datos del repartidor desde el objeto data
//       var repartidorData = data.data;

//       // Crear variables para cada dato del repartidor
//       var idrepartidor = repartidorData.idrepartidor;
//       var nombre = repartidorData.nombre;
//       var apellido = repartidorData.apellido;
//       var contacto = repartidorData.contacto;
//       var email = repartidorData.email;
//       var documento = repartidorData.documento;
//       var idtipodocumento = repartidorData.idtipodocumento;
//       var direccionresidencia = repartidorData.direccionresidencia;
//       var datosrunt = repartidorData.datosrunt;
//       var password = repartidorData.password;
//       var idrol = repartidorData.idrol;
//       var fechaNacimiento = repartidorData.fechaNacimiento;
//       var idEstado = repartidorData.idEstado;


//       document.querySelector("#nombreDomi").textContent.nombre;

//       var modal = document.getElementById("miModal");
//       modal.style.display = "flex";
//     } else {
//       console.error("Error en la respuesta del servidor:", data.message);
//     }
//   })
//   .catch((error) => {
//     console.error("Error:", error);
//   });
// }


//   // Función para cerrar la ventana modal
// function cerrarG() {
//     var modal = document.getElementById("miModal");
//     modal.style.display = "none";
// }
