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

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> e3ae44c63fcac0667f92f1010079ac3c9e922e4c

// const Musica = document.querySelector('#Musica');
// const Imagen = document.querySelector('#Imagen');
// const InputNombre = document.querySelector('#Nombre');
// const imagen = document.querySelector('#imagenP');
// const NombreLabel = document.querySelector('label[for="Musica"]');
// const ImagenLabel = document.querySelector('label[for="Imagen"]');
// const imagenLabel = document.querySelector('label[for="imagenP"]');
// const imagenPreview = document.getElementById('imagenPreview');

// Musica.addEventListener('change', actualizarLabels);
// Imagen.addEventListener('change', actualizarLabelsIMG);

// function actualizarLabelsIMG() {

//     if (Imagen.files.length > 0) {
//         imagenLabel.classList.add('active');
//         imagenLabel.textContent = 'Imagen cargada';
//         imagenPreview.style.opacity = '1'
//         imagenPreview.src = URL.createObjectURL(Imagen.files[0]); // Muestra la imagen en el contenedor
//     } else {
//         imagenLabel.classList.remove('active');
//         imagenLabel.textContent = 'Cargue alguna imagen';
//         imagenPreview.src = ''; // Borra la imagen del contenedor si no se ha subido ninguna
//     }

//     if (Imagen.files.length > 0) {
//         ImagenLabel.classList.add('active');
//         ImagenLabel.textContent = 'Imagen cargada';
//     } else {
//         ImagenLabel.classList.remove('active');
//         ImagenLabel.textContent = 'Cargue una imagen';
//     }
// }


// function actualizarLabels() {
//     if (Musica.files.length > 0) {
//         NombreLabel.classList.add('active');
//         const nombreCancion = Musica.files[0].name.replace('.mp3', ''); // Quita la extensión .mp3
//         NombreLabel.textContent = 'Canción cargada';
<<<<<<< HEAD
    
//     } else {
//         NombreLabel.classList.remove('active');
//         NombreLabel.textContent = 'Cargue alguna canción';
//         InputNombre.value = '';
//     }

// }

=======
function cleanFormMedicine(){
    var confirmacion = confirm("¿Estás seguro de que deseas limpiar el formulario?");
=======
>>>>>>> e3ae44c63fcac0667f92f1010079ac3c9e922e4c
    
//     } else {
//         NombreLabel.classList.remove('active');
//         NombreLabel.textContent = 'Cargue alguna canción';
//         InputNombre.value = '';
//     }

// }

<<<<<<< HEAD
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
>>>>>>> 79e33395d1d1e9332f17ece2a66cb4569791ad21
=======
>>>>>>> e3ae44c63fcac0667f92f1010079ac3c9e922e4c
