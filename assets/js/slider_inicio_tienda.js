const progressCircle = document.querySelector(".autoplay-progress svg");
const progressContent = document.querySelector(".autoplay-progress span");
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".slider-categorias", {
  loop: true,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var swiper = new Swiper(".slider-farmacias", {
  loop: true,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

function addEtiqueta() {
  var etiqueta = document.createElement("div");
  etiqueta.classList.add("swiper-slide");
  etiqueta.classList.add("colum-categorias");

  var swiperCategorias = document.querySelector(".slider-categorias > .swiper-wrapper");
  var swiperFarmacias = document.querySelector(".slider-farmacias > .swiper-wrapper");

  var etiquetaCategorias = etiqueta.cloneNode(true);
  var etiquetaFarmacias = etiqueta.cloneNode(true);

  swiperCategorias.appendChild(etiquetaCategorias);
  swiperFarmacias.appendChild(etiquetaFarmacias);
}

if (window.innerWidth <= 830) {
  addEtiqueta();
}


if (window.innerWidth <= 430) {
  addEtiqueta();
}

function activar_buscador_responsive(){
  var cont_buscador = document.querySelector(".cont-input-buscador-responsive");
  var titulo_header = document.querySelector(".logo>b");
  var logo_header = document.querySelector(".logo>img");
  icono = document.querySelector(".cont-input-buscador-responsive>i:nth-child(1)");
  cont_buscador.style.backgroundColor = "#f5f5f5";
  icono.style.visibility = "visible";

  if (window.innerWidth <= 570) {
    titulo_header.style.display = "none";
  }
  if (window.innerWidth <= 374) {
    var tamaño_pantalla = window.innerWidth;
    logo_header.style.display = "none";
    cont_buscador.style.width = tamaño_pantalla/1.6+"px";
  }else{
    cont_buscador.style.width = "13rem";
  }
}

function desactivar_buscador_responsive(){
  cont_buscador = document.querySelector(".cont-input-buscador-responsive");
  var logo_header = document.querySelector(".logo>img");
  var titulo_header = document.querySelector(".logo>b");
  icono = document.querySelector(".cont-input-buscador-responsive>i:nth-child(1)");
  cont_buscador.style.width = "2rem";
  cont_buscador.style.backgroundColor = "transparent";
  icono.style.visibility = "hidden";
  titulo_header.style.display = "block";
  logo_header.style.display = "block";
}