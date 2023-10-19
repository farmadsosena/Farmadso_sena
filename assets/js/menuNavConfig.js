window.onload = function () {
    var currentState = sessionStorage.getItem('currentState');

    // Verificar si el estado almacenado en la sesión es válido
    if (!currentState || !['notifications', 'tasks', 'nuevoContenido1', 'nuevoContenido2'].includes(currentState)) {
        currentState = 'notifications';
    }

    // Llamar a la función correspondiente según el estado actual
    if (currentState === 'notifications') {
        showNotifications();
    } else if (currentState === 'tasks') {
        showTasks();
    } else if (currentState === 'nuevoContenido1') {
        showNuevoContenido1();
    } else if (currentState === 'nuevoContenido2') {
        showNuevoContenido2();
    }
};

var tareas = document.querySelector(".tareas");
var notificacion = document.querySelector(".notificacion");
var historial = document.querySelector(".historial");
var config = document.querySelector(".config");

function showNotifications() {
    hideAllSections();
    document.getElementById('notificationsSection').style.display = 'flex';
    notificacion.classList.add("azulClaro");
    sessionStorage.setItem('currentState', 'notifications');
}

function showTasks() {
    hideAllSections();
    document.getElementById('tasksSection').style.display = 'flex';
    tareas.classList.add("azulClaro");
    sessionStorage.setItem('currentState', 'tasks');
}

function showNuevoContenido1() {
    hideAllSections();
    document.getElementById('nuevoContenido1').style.display = 'flex';
    config.classList.add("azulClaro");
    sessionStorage.setItem('currentState', 'nuevoContenido1');
}

function showNuevoContenido2() {
    hideAllSections();
    document.getElementById('nuevoContenido2').style.display = 'flex';
    historial.classList.add("azulClaro");
    sessionStorage.setItem('currentState', 'nuevoContenido2');
}

function hideAllSections() {
    document.getElementById('notificationsSection').style.display = 'none';
    document.getElementById('tasksSection').style.display = 'none';
    document.getElementById('nuevoContenido1').style.display = 'none';
    document.getElementById('nuevoContenido2').style.display = 'none';

    // Remover la clase azulClaro de todos los elementos
    tareas.classList.remove("azulClaro");
    notificacion.classList.remove("azulClaro");
    config.classList.remove("azulClaro");
    historial.classList.remove("azulClaro");
}

// Solo configurar el estado predeterminado cuando no hay un estado almacenado en la sesión
if (!sessionStorage.getItem('currentState')) {
    hideAllSections();
    document.getElementById('notificationsSection').style.display = 'flex';
    notificacion.classList.add("azulClaro");
    sessionStorage.setItem('currentState', 'notifications');
}
