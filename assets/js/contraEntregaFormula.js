function sendForm(event, formcontraentrega, link) {
    event.preventDefault();
    const form = document.getElementById(formcontraentrega);
    const contra = new FormData(form);
    
    fetch(link, {
        method: 'POST',
        body: contra,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            if (data.status === true) {
                form.reset();
                setTimeout(()=>{
                    document.getElementById('modalCargar').style.display = 'none';
                },
                2000)
                IDCOMPRA = data.idcompra;
                ConsultarDataFactura(IDCOMPRA);
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}


