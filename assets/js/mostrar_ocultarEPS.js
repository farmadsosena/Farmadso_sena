// Función para mostrar u ocultar los elementos según la selección
document.querySelector("#epsRegistradof").addEventListener("change",mostrarOcultarEPS);

function mostrarOcultarEPS() {
    var epsRegistrado = document.getElementById("epsRegistradof");
    var eps = document.getElementById("idEpsf");
    var nitEps = document.getElementById("nitEPS");
    var labels = document.querySelectorAll("label[for='eps'], label[for='nitEPS']");
    var niteps = document.querySelector(".niteps");

    if (epsRegistrado.value === "si"){
        eps.style.display = "block";
        nitEps.style.display = "block";
        labels.forEach(function(label) {
            label.style.display = "block";
        });
         niteps.style.display = "flex";
    } else {
        eps.style.display = "none";
        nitEps.style.display = "none";
        labels.forEach(function(label) {
            label.style.display = "none";
        });
         niteps.style.display = "none";
    }
}

function prede_mostrarOcultarEPS(){
    var eps = document.getElementById("idEpsf");
    var nitEps = document.getElementById("nitEPS");
    var labels = document.querySelectorAll("label[for='eps'], label[for='nitEPS']");
    var niteps = document.querySelector(".niteps");

    eps.style.display = "none";
    nitEps.style.display = "none";
    labels.forEach(function(label) {
        label.style.display = "none";
    });
     niteps.style.display = "none";
}

prede_mostrarOcultarEPS();