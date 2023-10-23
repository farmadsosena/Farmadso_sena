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
            if (data.status === true) {
                toastr.success(data.message);
                form.reset();
            } else if (data.status === null) {
                toastr.warning(data.message);
            } else if (data.status === 'error') {
                toastr.error(data.error); // Mostrar el mensaje de error
            }
        })
        .catch((error) => console.error('Error:', error));
}
