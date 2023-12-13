const hemberger = document.querySelector(".hemberger");

hemberger.addEventListener("click", function () {
  let navbar = document.querySelector("#sidebar");
  navbar.classList.toggle("active");
});
