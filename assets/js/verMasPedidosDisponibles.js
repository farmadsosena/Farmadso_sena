
  // Obtener la ventana modal y el botón de cierre
  let modal = document.getElementById('myModal');
  let span = document.getElementsByClassName('close')[0];
  let ver = document.getElementsByClassName('seeMore')[0]; 
  
  // Asegúrate de que este elemento exista
  function abrirNoti(idCompra) {
    // Crear un objeto FormData para enviar el ID como parte del cuerpo de la solicitud
    var formData = new FormData();
    formData.append('idCompra', idCompra);

    fetch('models/datosCompra.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta del servidor
        if (data.status === 'success') {
            // Acceder a los datos
            var idCompra = data.data.idCompra;
            var fechaCompra = data.data.fechaCompra;
            var nombrePaciente = data.data.nombrePaciente;
            var nombreeps = data.data.nombreeps;
            var apellidoPaciente = data.data.apellidoPaciente;
            var direccionPaciente = data.data.direccionPaciente;
            var direccionPrincipal = data.data.direccionPrincipal;
            var direccionTwo = data.data.direccionTwo;

            // Formatear la fecha
            var fechaFormateada = new Date(fechaCompra + 'T00:00:00Z');
            var dia = fechaFormateada.getDate() + 1;
            var mes = fechaFormateada.getMonth() + 1; // Sumar 1 porque los meses comienzan desde 0
            var anio = fechaFormateada.getFullYear();

            // Agregar un cero delante si el día o el mes es menor que 10
            dia = dia < 10 ? '0' + dia : dia;
            mes = mes < 10 ? '0' + mes : mes;
            

            var fechaFinal = dia + '/' + mes + '/' + anio;

            // Mostrar los datos en tu HTML (por ejemplo, en un modal)
            document.getElementById('idCompraField').value = idCompra;
            document.querySelector("#order-number").textContent = "000" + idCompra;
            document.querySelector("#fechaVer").textContent = fechaFinal;
            document.querySelector("#DireccionPrincipal").textContent = direccionPrincipal;
            document.querySelector("#DireccionTwo").textContent = direccionTwo;
            document.querySelector("#customer-name").textContent = nombrePaciente + " " + apellidoPaciente;
            document.querySelector("#customer-address").textContent = direccionPaciente;
            // Agrega el código para mostrar otros datos según sea necesario

            // Tu código para mostrar el modal
            modal.style.display = 'flex';
        } else {
            console.error('Error en la respuesta del servidor:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

  // Cuando el usuario hace clic en el botón 'Ver más', abrir la ventana modal
  // Asociar la función al evento de clic en el botón 'Ver más'
  if (ver) {
    ver.addEventListener("click", abrirNoti);
  }

  // Cuando el usuario hace clic en el botón de cierre, cerrar la ventana modal
  span.onclick = function() {
    modal.style.display = 'none';
  }

  // Cuando el usuario hace clic fuera de la ventana modal, cerrarla
  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  }

