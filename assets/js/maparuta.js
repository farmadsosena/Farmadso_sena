function sendForm(event, ubicacion, link) {
  event.preventDefault();

  const form = document.getElementById(ubicacion);
  const formData = new FormData(form);

  fetch(link, {
      method: "POST",
      body: formData,
  })
  .then((response) => {
      if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const contentType = response.headers.get("content-type");
      if (contentType && contentType.indexOf("application/json") !== -1) {
          return response.json(); // Convertir la respuesta a JSON
      } else {
          console.error("Respuesta no válida en formato JSON. Tipo de contenido:", contentType);
    
          return response.text().then((text) => {
              console.error("Cuerpo de la respuesta:", text);
          });
      }
  })
  .then((data) => {
      console.log(data); 
      if (data && data.status === true) {
          toastr.success(data.message);
          form.reset();
      } else if (data && data.status === null) {
          toastr.warning(data.message);
      } else if (data && data.status === "error") {
          toastr.error(data.error); // Mostrar el mensaje de error
      } else {
          console.error("Unexpected response format:", data);
          toastr.error("Error in response format. Please try again.");
      }
  })
  .catch((error) => {
      console.error("Error:", error);
      toastr.error("Hubo un error en la solicitud."); // Mensaje de error genérico
  });
}

// places

function sendForm(event, places, link) {
  event.preventDefault();

  const form = document.getElementById(places);
  const formData = new FormData(form);

  fetch(link, {
      method: "POST",
      body: formData,
  })
  .then((response) => {
      if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const contentType = response.headers.get("content-type");
      if (contentType && contentType.indexOf("application/json") !== -1) {
          return response.json(); 
      } else {
          console.error("Respuesta no válida en formato JSON. Tipo de contenido:", contentType);
          // Imprimir el cuerpo de la respuesta en la consola
          return response.text().then((text) => {
              console.error("Cuerpo de la respuesta:", text);
          });
      }
  })
  .then((data) => {
      console.log(data); // Imprimir la respuesta en la consola
      if (data && data.status === true) {
          toastr.success(data.message);
          form.reset();
      } else if (data && data.status === null) {
          toastr.warning(data.message);
      } else if (data && data.status === "error") {
          toastr.error(data.error); // Mostrar el mensaje de error
      } else {
          console.error("Unexpected response format:", data);
          toastr.error("Error in response format. Please try again.");
      }
  })
  .catch((error) => {
      console.error("Error:", error);
      toastr.error("Hubo un error en la solicitud."); // Mensaje de error genérico
  });
}


