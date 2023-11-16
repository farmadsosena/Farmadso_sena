function sendForm(event, formcontraentrega, link) {
  event.preventDefault();
  const form = document.getElementById(formcontraentrega);
  const contra = new FormData(form);
 console.log("contra");
  fetch(link, {
    method: "POST",
    body: contra,
  });
  console
    .log(body)
    .then((response) => response.json())
    .then((data) => {
      if (data.status === true) {
        toastr.success(data.message);
        form.reset();
      } else if (data.status === null) {
        toastr.warning(data.message);
      } else if (data.status === "error") {
        toastr.error(data.error); // Mostrar el mensaje de error
      }
    })
    .catch((error) => console.error("Error:", error));
}

// Funcion para cambiar contenido de la view pagosContraentrega
var btn = document.getElementById("changeContent");
var cartCont = document.querySelector(".contCarrito");
var formcontraentrega = document.querySelector(".formulario_contraentrega");

btn.addEventListener("click", () => {
  if (!formcontraentrega.classList.contains("activeForm")) {
    formcontraentrega.classList.toggle("desactiveForm");
  } else {
    cartCont.classList.toggle("activeForm");
    alert("visible formContraentrega");
  }
});
