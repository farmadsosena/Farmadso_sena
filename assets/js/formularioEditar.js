function editarMedicamento(idMedicamento) {
    console.log("ID del medicamento que se va a enviar por AJAX: " + idMedicamento);

    // Ocultar elementos según tu lógica
    document.querySelector('.modal-inventario').style.display = 'none';
    document.querySelector('.cont-medicine').style.display = 'none';
    document.querySelector('.cont-editar-medicamento').style.display = 'block';

    // Enviar el id por AJAX
    fetch('controllers/datosMedicamento.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Cambiado a 'application/x-www-form-urlencoded'
        },
        body: 'id=' + encodeURIComponent(idMedicamento), // Modificado para enviar el ID correctamente
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.status === 'success') {
            var code = data.data.codigo;
            var nombre = data.data.nombre;
            alert(nombre);
            alert(code);
            document.getElementById('medicineNamee').value = nombre;
        } else {
            console.error('Error en la respuesta del servidor:', data.message);
        }
    })
    .catch(error => {
        console.error('Error en la consulta AJAX:', error.message);
    });
}




function ActualizarM() {
    $.ajax({
      url: "controllers/medicineEdit.php",
      type: "POST",
      data: $("#editarParque").serialize(),
      success: function (response19) {
        // Mostrar la alerta Toastr
        toastr.success("Actualizado Correctamente");

        // Esperar 2 segundos (2000 milisegundos) y luego recargar la página
        setTimeout(function () {
          location.reload();
        }, 2000);
      },
    });
  }

  $(".btn-registrar").click(function () {
    ActualizarM();
  });
