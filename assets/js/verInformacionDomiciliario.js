// ... Tu código JavaScript existente

// Función para abrir la modal con datos simulados
function openModal() {
    // Obtener elementos de la modal
    var modal = document.getElementById("myModal");
    var modalImage = document.getElementById("modalImage");
    var modalName = document.getElementById("modalName");
    var modalLastName = document.getElementById("modalLastName");
    var modalAge = document.getElementById("modalAge");
    var modalPhone = document.getElementById("modalPhone");
    var modalEmail = document.getElementById("modalEmail");
    var modalAddress = document.getElementById("modalAddress");
  
    // Simular datos del domiciliario
    var domiciliarioData = {
      imageSrc: "assets/img/domiciliario1.jpg",
      name: "Mario Alexander",
      lastName: "Gomez Losada",
      age: 19,
      phone: "3229883339",
      email: "mario@gmail.com",
      address: "Calle Inventada #123"
    };
  
    // Actualizar contenido de la modal con datos simulados
    modalImage.src = domiciliarioData.imageSrc;
    modalName.textContent = domiciliarioData.name;
    modalLastName.textContent = domiciliarioData.lastName;
    modalAge.textContent = domiciliarioData.age;
    modalPhone.textContent = domiciliarioData.phone;
    modalEmail.textContent = domiciliarioData.email;
    modalAddress.textContent = domiciliarioData.address;
  
    // Mostrar la modal
    modal.style.display = "block";
  }
  
  // Función para cerrar la modal
  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }
  
