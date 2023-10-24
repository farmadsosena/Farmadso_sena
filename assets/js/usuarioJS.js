document.addEventListener("DOMContentLoaded", function () {
  const customSelect = document.querySelector(".custom-select");
  const selectedOption = customSelect.querySelector(".selected-option");
  const options = customSelect.querySelector(".options");

  customSelect.addEventListener("click", function () {
    options.classList.toggle("show");
  });

  options.querySelectorAll(".option").forEach(function (option) {
    option.addEventListener("click", function () {
      option.classList.remove("show");
      const text = option.textContent;
      selectedOption.innerHTML = option.innerHTML;


      if (text.includes("Domiciliario")) {
        window.location= '../views/domiciliario.php'
      } else if (text.includes("Farmaceutico")) {
        window.location= '../views/'
      } else if (text.includes("Cuenta de usuario")) {
        window.location= '../views/'
      }

    });
  });

  // Cerrar el menú cuando se hace clic fuera de las opciones
  document.addEventListener("click", function (event) {
    if (!customSelect.contains(event.target)) {
      options.classList.remove("show");
    }
  });
});


document.getElementById('cuenta-fasd').addEventListener('click', (event) => {
  event.stopPropagation(); 
  document.getElementById('datos-user').classList.toggle('dash');
});

document.addEventListener('click', (event) => {
  const datosUser = document.getElementById('datos-user');
  
  if (!datosUser.contains(event.target)) {
      datosUser.classList.remove('dash'); 
  }
});
