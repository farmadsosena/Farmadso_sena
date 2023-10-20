const hemberger = document.querySelector(".hemberger");
const navbar = document.querySelector(".nav-bar");

hemberger.addEventListener("click", function () {
  navbar.classList.toggle("active");
});

const closeButton = document.querySelector(".close-button");

closeButton.addEventListener("click", function () {
  navbar.classList.remove("active");
});
