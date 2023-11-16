// Obtén todos los elementos de título y opciones
const titulos = document.querySelectorAll('.titulo');
const opciones = document.querySelectorAll('.opcion');

// Agrega un evento de clic a cada título
titulos.forEach((titulo, index) => {
    titulo.addEventListener('click', () => {
        // Oculta todas las opciones
        opciones.forEach((opcion) => {
            opcion.style.display = 'none';
        });

        // Muestra solo la opción correspondiente al título clicado
        opciones[index].style.display = 'flex';
    });
});

// Obtener referencias a los contenedores
const datosPersonalesContainer = document.getElementById('datosPersonales');
const direccionContainer = document.getElementById('direccion');
const metodoContainer = document.getElementById('metodo');
const pagoContainer = document.getElementById('pago');
const continuarButton = document.querySelector('continuar');

datosPersonalesContainer.style.display = 'flex';

continuarButton.addEventListener('click', () => {
    if (datosPersonalesContainer.style.display === 'flex') {
      
         datosPersonalesContainer.style.display = 'none';
        direccionContainer.style.display = 'flex';
    } else if (direccionContainer.style.display === 'flex') {
        // Si el contenedor de Dirección está visible, pasa al de Método de Pago
         direccionContainer.style.display = 'none';
        metodoContainer.style.display = 'flex';
    } else if (metodoContainer.style.display === 'flex') {
        // Si el contenedor de Método de Pago está visible, pasa al de Pago
        metodoContainer.style.display = 'none';
        pagoContainer.style.display = 'flex';
    }
});
