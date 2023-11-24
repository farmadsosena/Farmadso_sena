document.addEventListener("DOMContentLoaded", function () {
    console.log("DOMContentLoaded event fired");

    const notificacion = document.querySelector(".orderAvailable");
    const historia = document.querySelector(".c");
    const tarea = document.querySelector(".pendingTask");
    const mensaje = document.querySelector(".ContenedorMss");
    const alert = document.querySelector(".ContenedorHisto");
    const alertTarea = document.querySelector(".contenedorAlertMm");

    if(!tarea){
        alertTarea.style.display = "flex";
    }

    if(!historia){
        alert.style.display = "flex";
    }

    if (!notificacion) {
        mensaje.style.display = "flex";
    }
});
