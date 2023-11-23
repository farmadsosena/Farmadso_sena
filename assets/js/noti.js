if ($(".orderAvailable").hasClass("orderAvailable")) {
    // La clase "activa" está presente en el elemento
    // Puedes realizar acciones adicionales aquí

    // Obtener todos los elementos con la clase "circuloNoti"
    var elementosCirculo = document.querySelectorAll(".circuloNoti");

    // Iterar sobre los elementos y aplicar el estilo
    elementosCirculo.forEach(function (elemento) {
        elemento.style.display = "flex";
    });
} else {
    // La clase "activa" no está presente en el elemento

    // Obtener todos los elementos con la clase "circuloNoti"
    var elementosCirculo = document.querySelectorAll(".circuloNoti");

    // Iterar sobre los elementos y aplicar el estilo
    elementosCirculo.forEach(function (elemento) {
        elemento.style.display = "none";
    });
}


if ($(".pendingTask").hasClass("pendingTask")) {
    console.log("La clase está activa");
    var elementosCirculo = document.querySelectorAll(".circuloTask");

    elementosCirculo.forEach(function (elemento) {
        elemento.style.display = "flex";
    });
}   
else{
    console.log("La clase no está activa");
    var elementosCirculo = document.querySelectorAll(".circuloTask");

    elementosCirculo.forEach(function (elemento) {
        elemento.style.display = "none";
    });
}