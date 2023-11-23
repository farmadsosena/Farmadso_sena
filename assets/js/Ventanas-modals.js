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
    var contMedicine = document.querySelector('.container-ventas');
    var contForm = document.querySelector('.detalles');

    contMedicine.style.display = 'none';
    contForm.style.display = 'block';

    
}

function closeDetalles() {
    var contMedicine = document.querySelector('.container-ventas');
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
function openEstado(){
    var contMedicine = document.querySelector('.container-ventas');
    var contForm = document.querySelector('.estado');

    contMedicine.style.display = 'none';
    contForm.style.display = 'block';
}

function closeEstado() {
    var contMedicine = document.querySelector('.container-ventas');
    var contForm = document.querySelector('.estado');

    // Mostrar alerta
    var confirmClose = confirm("Deseas salir del vaino?");

    if (confirmClose) {
        // Cambiar el estilo de visualización
        contMedicine.style.display = 'flex';
        contForm.style.display = 'none';
    }
}

function openModalInventario(){
    var contModal = document.querySelector('.modal-inventario');
    contModal.style.display = 'block';
}

function closeModalInventario() {
    var contModal = document.querySelector('.modal-inventario');
    contModal.style.display = 'none';

    var filtroNombre = document.getElementById('filtroNombre');
    filtroNombre.value = '';

    // Limpiar la lista de manillas
    var articulos = document.querySelectorAll('.manilla');
    articulos.forEach(function(manilla) {
        manilla.style.display = 'flex';
    });
}

function openDetalleInventario(nombreProducto){
    var contModal = document.querySelector('.modal-inventario');
    contModal.style.display = 'block';

    // Establecer nombreProducto como valor del input
    var filtroNombre = document.getElementById('filtroNombre');
    filtroNombre.value = nombreProducto;
    
    // Llamar a la función de filtrado después de establecer el valor
    filtrarArticulos();

    filtroNombre.addEventListener('input', filtrarArticulos);

    function filtrarArticulos() {
        var filtro = filtroNombre.value.toLowerCase().trim();
        var articulos = document.querySelectorAll('.manilla');
    
        articulos.forEach(function(manilla) {
            var nombre = manilla.querySelector('.nombre-medicamentos').textContent.toLowerCase();
            var codigo = manilla.querySelector('.categoria-medicamento').textContent.toLowerCase();
            
            if (nombre.includes(filtro) || codigo.includes(filtro) || nombre.includes(nombreProducto.toLowerCase())) {
                manilla.style.display = 'flex';
            } else {
                manilla.style.display = 'none';
            }
        });
    }
}

function openModalComentarios(){
    var contModalC = document.querySelector('.modal-comentarios');
    contModalC.style.display = 'block';
}

function closeModalComentarios() {
    var contModalC = document.querySelector('.modal-comentarios');
    contModalC.style.display = 'none';

    var comentarios = document.querySelectorAll('.comentario');
    comentarios.forEach(function(comentario) {
        comentario.style.display = 'flex';
    });
}

function openModalOfertas(){
    var contModalP = document.querySelector('.Modal-Ofertas');
    contModalP.style.display = 'block';
}

function closeModalOfertas() {
    var contModalP = document.querySelector('.Modal-Ofertas');
    contModalP.style.display = 'none';

}

