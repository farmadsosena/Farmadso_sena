document.getElementById("tipo_cuenta").addEventListener("change", function() {
    var selectedOption = this.value;
    var respuestaSelect = document.getElementById("respuesta_select");

    // Oculta todos los contenedores de información
    var infoContainers = respuestaSelect.getElementsByClassName("info-container");
    for (var i = 0; i < infoContainers.length; i++) {
        infoContainers[i].style.display = "none";
    }

    // Muestra el contenedor de información correspondiente a la opción seleccionada
    if (selectedOption !== "") {
        var selectedContainer = document.getElementById(selectedOption + "_info");
        selectedContainer.style.display = "block";
    }
});
