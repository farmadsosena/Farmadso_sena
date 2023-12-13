// Funcion para actualizar la imagen que se cargue 
document.addEventListener('DOMContentLoaded', function () {
    var imagenChangeInput = document.getElementById('imagenMoto');
    var imagenChange = document.getElementById('imgSubida');

    imagenChangeInput.addEventListener('change', function () {
        // Verificar si se seleccionó un archivo
        if (imagenChangeInput.files.length > 0) {
            // Obtener la ruta del archivo
            var ruta = URL.createObjectURL(imagenChangeInput.files[0]);

            // Asignar la ruta a la imagen
            imagenChange.src = ruta;
        } else {
            // No se seleccionó ningún archivo
            imagenChange.src = ''; // Limpiar la imagen si no hay archivo seleccionado
        }
    });
});