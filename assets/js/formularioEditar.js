function editarMedicamento(idMedicamento) {

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
        var precio = data.data.precio;
        var descripcion = data.data.descripcion;
        var instruccion = data.data.instruccions;
        var lote = data.data.lote;
        var stock = parseInt(data.data.stock);
        var formaadmi = data.data.fadmi;
        var idcatego = data.data.idcategoria;
        var idprove = data.data.idprovedor;
        var fecha = data.data.fechaexp;

        document.getElementById('fechaexp').value = fecha;
        document.getElementById('medimanetId').value = idMedicamento;
        document.getElementById('cumme').value = code;
        document.getElementById('medicineNamee').value = nombre;
        document.getElementById('priceMedicinee').value = precio;
        document.getElementById('descriptionMedicinee').value = descripcion;
        document.getElementById('instructionMedicinee').value = instruccion;
        document.getElementById('loteMedicinee').value = lote;
        $('#StockMedicinee').val(stock);
        document.getElementById('administrae').value = formaadmi;
        document.getElementById('categorye').value = idcatego;
        document.getElementById('provideMedicinee').value = idprove;



        // mostrar el contenedor

        pages = document.querySelectorAll('.page');
        items = document.querySelectorAll('.item');

        pages.forEach(page => {
          page.classList.remove('visiblePage')
        })
        items.forEach(item => {
          item.classList.remove('activeItem')
        })

        document.getElementById("medicamentos").classList.add('visiblePage')
        document.querySelector('.medicamnentos-btn').classList.add('activeItem')

      } else {
        console.error('Error en la respuesta del servidor:', data.message);
      }
    })
    .catch(error => {
      console.error('Error en la consulta AJAX:', error.message);
    });



  function ActualizarM() {
    $.ajax({
      url: "controllers/medicineEdit.php",
      type: "POST",
      data: $("#medicineEdit").serialize(),  // Corregido para usar el ID correcto del formulario
      success: function (response19) {
        // Manejar el éxito de la solicitud
        toastr.success("Actualizado Correctamente");

        // Esperar 2 segundos (2000 milisegundos) y luego recargar la página
        // setTimeout(function () {
        //   location.reload();
        // }, 2000);
      },
      error: function (error) {
        // Manejar el error de la solicitud
        console.error('Error en la solicitud AJAX:', error);
        toastr.error("Error al actualizar");
      },
    });




  }

  $(".btn-registrar").click(function () {
    ActualizarM();
  });


}




