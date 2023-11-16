// Formulario de contraentrega
const contraentregaForm  = document.getElementById('contraentregaForm');
contraentregaForm.addEventListener('submit', (event)=>{
    event.preventDefault();

    dataForm = new FormData(contraentregaForm);

    fetch('../controllers/pagoContraentrega.php', {
        method: 'POST',
        body: dataForm
    }).then(response =>  response.json())
    .then(data =>{
        
    }).catch(error =>{
        console.log(error)
    })

})

contraentregaForm.addEventListener('input', ()=>{
        
})



// // Funcion de mostrar ventana cart()
// document.getElementById('viewCart').
// document.getElementById('contraentregaForm').