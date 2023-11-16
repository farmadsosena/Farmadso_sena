function editarMedicamento(idMedicamento) {
    // Ocultar elementos según tu lógica
    document.querySelector('.modal-inventario').style.display = 'none';
    document.querySelector('.cont-medicine').style.display = 'none';
    document.querySelector('.cont-editar-medicamento').style.display = 'block';

    // Enviar el id por AJAX
    fetch('controllers/DatosProductos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: idMedicamento }),
    })
    .then(response => response.json())
    .then(data => {
        // Manejar la respuesta de la consulta AJAX
        console.log(data);
        // Puedes realizar acciones adicionales con la respuesta aquí
    })
    .catch(error => {
        console.error('Error en la consulta AJAX:', error);
    });
}
