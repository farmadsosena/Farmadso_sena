function openFormMedicine() {
    var contMedicine = document.querySelector('.cont-medicine');
    var contForm = document.querySelector('.cont-form');

    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';
}

function closeFormMedicine() {
    var contMedicine = document.querySelector('.cont-medicine');
    var contForm = document.querySelector('.cont-form');

    // Mostrar alerta
    var confirmClose = confirm("Si vuelves, se perderá el contenido incluido en los campos. ¿Deseas continuar?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';

        // Limpiar el contenido del formulario
        var formInputs = contForm.querySelectorAll('.custom-file-input');
        formInputs.forEach(function(input) {
            input.value = ''; // Limpiar el valor del input
        });

        var LabelInput = contForm.querySelectorAll('.no-file-selected');
        LabelInput.forEach(function(input) {
            input.textContent = 'Selecciona una imagen.'; // Limpiar el valor del input
        });
        document.getElementById('medicineAdd').reset()
        
    }
}

function openFormCategories() {
    var contMedicine = document.querySelector('.container-categoria');
    var contForm = document.querySelector('.categorias');

    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';
}

function closeFormCategories() {
    var contMedicine = document.querySelector('.container-categoria');
    var contForm = document.querySelector('.categorias');

    // Mostrar alerta
    var confirmClose = confirm("Si vuelves, se perderá el contenido incluido en los campos. ¿Deseas continuar?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';

        // Limpiar el contenido del formulario
        var formInputs = contForm.querySelectorAll('input');
        formInputs.forEach(function(input) {
            input.value = ''; // Limpiar el valor del input
        });
    }
}


function openDetalles(){
    var contMedicine = document.querySelector('.container-detalles');
    var contForm = document.querySelector('.detalles');

    contMedicine.style.display = 'none';
    contForm.style.display = 'flex';
}

function closeDetalles() {
    var contMedicine = document.querySelector('.container-detalles');
    var contForm = document.querySelector('.detalles');

    // Mostrar alerta
    var confirmClose = confirm("Deseas salir del vaino?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';

        // Limpiar el contenido del formulario
        var formInputs = contForm.querySelectorAll('input');
        formInputs.forEach(function(input) {
            input.value = ''; // Limpiar el valor del input
        });
    }
}

function openModalInventario(){
    var contModal = document.querySelector('.modal-inventario');
    contModal.style.display = 'block';
}

function closeModalInventario() {
    var contForm = document.querySelector('.modal-inventario');
        contForm.style.display = 'none';
}

