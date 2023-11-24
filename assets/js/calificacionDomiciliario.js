  // Función para abrir la modal de calificación
  function openCalificacionModal() {
    var modalCalificacion = document.getElementById("modalCalificacion");
    modalCalificacion.style.display = "block";

    // Aquí puedes agregar lógica para cargar los comentarios desde tu sistema
    // Por ahora, solo mostraré comentarios simulados con imágenes
    var comentariosList = document.getElementById("comentariosList");
    comentariosList.innerHTML = `
        <li>
            <img src="assets/img/domiciliario1.jpg" alt="Usuario 1" class="avatar">
            Buen servicio
        </li>
        <li>
            <img src="assets/img/domiciliario1.jpg" alt="Usuario 2" class="avatar">
            Cule yesenia en la que llegó - 20/10
        </li>`;
}

// Función para cerrar la modal de calificación
function closeCalificacionModal() {
    var modalCalificacion = document.getElementById("modalCalificacion");
    modalCalificacion.style.display = "none";
}

// Función para capturar la calificación
function calificar(event) {
    var calificacion = event.target.dataset.valor;
    console.log("Calificación:", calificacion);

    // Aquí puedes agregar lógica para enviar la calificación a tu sistema
}
