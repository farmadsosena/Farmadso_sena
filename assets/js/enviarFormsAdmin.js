// Funcion para enviar formularios de agregar

function sendForm(event, formulario, ruta) {
 
    event.preventDefault();
    const MedicineForm = document.getElementById(formulario);
    info = new FormData(MedicineForm);
    fetch(ruta, {
        method: 'POST',
        body: info
    }).then((response) => response.json())
        .then(data => {
            if(data.status === true){
                toastr.success(data.message);
                formulario.reset();
            }else if(data.status === null){
                toastr.warning(data.message);
            }else if(data.status === 'error'){
                toastr.error(data.message);
            }
        })
        .catch(error => {
            console.log(error);
        })

}
// Enviar form

function EditMedicament(event, formId, action) {
    event.preventDefault();

    var form = document.getElementById(formId);
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert("Medicamento actualizado correctamente.");
                // Restablecer el formulario después de una edición exitosa
                form.reset();
            } else {
                alert("Hubo un error al actualizar el medicamento. Por favor, inténtalo de nuevo.");
            }
        }
    };

    xhr.open('POST', action, true);
    xhr.send(formData);
}
