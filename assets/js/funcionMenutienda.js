/*FUNCION DEL MENU RESPONSIVE*/
var closeMenu = document.querySelector('.closeMenu');
var openMenu = document.querySelector('.openMenu');

/*MENU RESPONSIVE */
var contMenu = document.querySelector('#contMenu');

openMenu.addEventListener('click', () => {
  contMenu.classList.add("agg-menu");
});
closeMenu.addEventListener('click', () => {
  contMenu.classList.remove("agg-menu");
});


var containerAbout = document.querySelector('.containerAbout');
var verMas = document.querySelectorAll('.verMas')
for (var i = 0; i < verMas.length; i++) {
  verMas[i].addEventListener('click', () => {
    containerAbout.classList.add('containerAbout');
  })
}