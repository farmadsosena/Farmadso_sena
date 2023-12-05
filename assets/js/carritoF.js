//Carrito de compras 

const cerrarCarrito = document.querySelector('#cerrarCarrito');
const modalCarrito = document.querySelector('.contCarrito');
const contenedorPD =document.querySelector('.contenedorProductos')
var abrirCarrito =document.querySelectorAll('#abrirCarrito');
for (var i = 0; i < abrirCarrito.length; i++){
  abrirCarrito[i].addEventListener('click',()=>{
    document.querySelector('.modalCarrito').style.display ='flex';
    // contenedorPD.style.display = 'flex';
    // modalCarrito.style.opacity = "1";
    // modalCarrito.style.display = "flex";
    // modalCarrito.style.transform = "translateX(-0%)";
  })
}

cerrarCarrito.addEventListener('click', function() {
  // modalCarrito.style.display = "none";
  // contenedorPD.style.display = 'flex';
  document.querySelector('.modalCarrito').style.display = 'none';
  recibir_cantida_produc_carrito();
});