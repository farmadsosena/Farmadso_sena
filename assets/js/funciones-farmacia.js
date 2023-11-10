function eliminarMedicamento(idMedicamento) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este medicamento?");
    if (confirmacion) {
        $.ajax({
            type: "POST",
            url: "controllers/eliminar_medicamento.php", 
            data: { idMedicamento: idMedicamento },
            success: function(response) {
                // Verifica si la eliminación fue exitosa
                if (response == "success") {
                    alert("Medicamento eliminado correctamente.");
                    location.reload();
 var contModal = document.querySelector('.modal-inventario');
        contModal.style.display = 'block';
                } else {
                    alert("Error al eliminar el medicamento. Por favor, inténtalo de nuevo.");
                }
            }
        });
    }
}


       
