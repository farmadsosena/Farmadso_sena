function sendForm(event, formcontraentrega, link) {

    event.preventDefault();
    const form = document.getElementById(formcontraentrega);
    document.getElementById('btn-compra').innerHTML =`Validando...`; 
    document.getElementById('btn-compra').disabled =true;
    const contra = new FormData(form);
    fetch(link, {
        method: 'POST',
        body: contra,
    })
        .then((response) => response.json())
        .then((data) => {
            document.getElementById('modalCargar').style.display = 'flex';

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
                document.getElementById('btn-compra').innerHTML =`Comprar`; 
                document.getElementById('btn-compra').disabled =false;
                toastr.error(data.message);
                document.getElementById('modalCargar').style.display = 'none';
            }
        })
        .catch((error) => console.error('Error:', error));
}



// Funcion para cambiar contenido de la view pagosContraentrega
var btn = document.getElementById('changeContent');
var cartCont = document.querySelector('.contCarrito')
var formcontraentrega = document.querySelector('.formulario_contraentrega')

btn.addEventListener('click', () => {

    if (cartCont.classList.contains('desactiveForm')) {
        ocultarElemento('viewCartIcon')
        ocultarElemento('cantidadFinal')
        mostrarElemento('payContinue')

        formcontraentrega.classList.add('desactiveForm');
        formcontraentrega.classList.remove('activeForm');
        cartCont.classList.remove('desactiveForm');
        cartCont.classList.add('activeForm')
        TraerDataCart();


    } else {
        ocultarElemento('payContinue')
        mostrarElemento('cantidadFinal')
        mostrarElemento('viewCartIcon')
        cartCont.classList.remove('activeForm');
        cartCont.classList.add('desactiveForm');

        formcontraentrega.classList.remove('desactiveForm');
        formcontraentrega.classList.add('activeForm');

    }

})


function ocultarElemento(id) {
    document.getElementById(id).style.display = 'none';
}
function mostrarElemento(id) {
    document.getElementById(id).style.display = 'flex';
}



// Animar el titulo 
function animateText() {
    const textElement = document.getElementById("animated-text");
    let opacity = 0;

    const fadeInInterval = setInterval(function () {
        opacity += 0.01; // Ajusta la velocidad de la animación cambiando este valor
        textElement.style.opacity = opacity;
        if (opacity >= 1) {
            clearInterval(fadeInInterval);
            // La animación ha terminado

        }
    }, 20); // El intervalo en milisegundos
}

// Llama a la función de animación cuando el documento esté listo
document.addEventListener("DOMContentLoaded", animateText);


