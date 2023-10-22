function sendForm(event, formcontraentrega,link){

event.preventDefault();
const form = document.getElementById(formcontraentrega);
contra = new FormData(form);
fetch(link, {
            method: 'POST',
            body: contra
})
            .then(response => response.json())
            .then(data => {
                if (data.status === true) {
                    alert(data.message);
                    form.reset();
                    // Puedes redirigir o realizar otras acciones aquí después de una inserción exitosa.
                }else if(data.status === null){
                    toastr.warning(data.message);
                }else if(data.status === 'error'){
                    toastr.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

    
