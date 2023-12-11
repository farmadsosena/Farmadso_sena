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
                document.getElementById('modalCargar').style.display = 'flex';
                
                form.reset();
                
                // Retraso antes de redirigir a la página de inicio
                setTimeout(() => {
                    document.getElementById('modalCargar').style.display = 'none' ;
                    window.location.href = "inicio_tienda.php";
                }, 3000); 
                toastr.success(data.message);
            } else if (data.status === false || data.status === 'error') {
                toastr.error(data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}


