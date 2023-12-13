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
                MedicineForm.reset();
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

