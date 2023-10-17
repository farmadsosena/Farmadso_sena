var openModalButton = document.querySelector('.openModalButton');
var secondModal = document.querySelector('.modal'); // Cambiado de getElementsByClassName a querySelector
var closeButton = document.querySelector('.close');

function abrirG() {
  secondModal.style.display = 'block';
}


 function cerrarG(){
  secondModal.style.display = 'none';
};

window.addEventListener('click', function(event) {
  if (event.target === secondModal) {
    secondModal.style.display = 'none';
  }
});
