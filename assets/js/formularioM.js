document.addEventListener('DOMContentLoaded', function() {
    const fileInputs = document.querySelectorAll('.custom-file-input');

    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            const fileName = this.files[0].name;
            const noFileSelected = this.parentElement.querySelector('.no-file-selected');
            noFileSelected.textContent = fileName;
        });
    });
});

function cleanFormMedicine(){
    var confirmacion = confirm("¿Estás seguro de que deseas limpiar el formulario?");
    
    if (confirmacion) {
        // Obtener el contenedor del formulario
        var contForm = document.querySelector('.cont-form');

        if (contForm) {
            // Limpiar el contenido del formulario
            var formInputs = contForm.querySelectorAll('.custom-file-input');
            formInputs.forEach(function(input) {
                input.value = ''; // Limpiar el valor del input
            });

            var LabelInput = contForm.querySelectorAll('.no-file-selected');
            LabelInput.forEach(function(input) {
                input.textContent = 'Selecciona una imagen.'; // Limpiar el valor del input
            });

            // Resetear el formulario
            document.getElementById('medicineAdd').reset();
        } else {
            console.error("No se encontró el contenedor del formulario.");
        }
    }
}
