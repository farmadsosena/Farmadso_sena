// Función para abrir la ventana modal
function abrirG() {
    var modal = document.getElementById("miModal");
    modal.style.display = "block";
}

  // Función para cerrar la ventana modal
function cerrarG() {
    var modal = document.getElementById("miModal");
    modal.style.display = "none";
}

  // Event listener para cerrar la ventana modal haciendo clic en cualquier parte fuera del contenido
window.onclick = function(event) {
    var modal = document.getElementById("miModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}