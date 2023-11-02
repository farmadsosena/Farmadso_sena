
// Función para mostrar u ocultar los elementos según la selección
function mostrarOcultarEPS() {
    var epsRegistrado = document.getElementById("epsRegistrado");
    var eps = document.getElementById("idEps");
    var nitEps = document.getElementById("nitEPS");
    var labels = document.querySelectorAll("label[for='eps'], label[for='nitEPS']");

    if (epsRegistrado.value === "si") {
        eps.style.display = "block";
        nitEps.style.display = "block";
        labels.forEach(function(label) {
            label.style.display = "block";
        });
    } else {
        eps.style.display = "none";
        nitEps.style.display = "none";
        labels.forEach(function(label) {
            label.style.display = "none";
        });
    }
}
