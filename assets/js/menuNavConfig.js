 

    // Recuperar el estado actual al cargar la página
    window.onload = function () {
        var currentState = sessionStorage.getItem('currentState');
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

    function showNotifications() {
        document.getElementById('notificationsSection').style.display = 'flex';
        document.getElementById('tasksSection').style.display = 'none';
        document.getElementById('nuevoContenido1').style.display = 'none';
        document.getElementById('nuevoContenido2').style.display = 'none';
        // Guardar el estado actual
        sessionStorage.setItem('currentState', 'notifications');
    }

    function showTasks() {
        document.getElementById('notificationsSection').style.display = 'none';
        document.getElementById('tasksSection').style.display = 'flex';
        document.getElementById('nuevoContenido1').style.display = 'none';
        document.getElementById('nuevoContenido2').style.display = 'none';
        // Guardar el estado actual
        sessionStorage.setItem('currentState', 'tasks');
    }

    function showNuevoContenido1() {
        document.getElementById('notificationsSection').style.display = 'none';
        document.getElementById('tasksSection').style.display = 'none';
        document.getElementById('nuevoContenido1').style.display = 'flex';
        document.getElementById('nuevoContenido2').style.display = 'none';
        // Guardar el estado actual
        sessionStorage.setItem('currentState', 'nuevoContenido1');
    }

    function showNuevoContenido2() {
        document.getElementById('notificationsSection').style.display = 'none';
        document.getElementById('tasksSection').style.display = 'none';
        document.getElementById('nuevoContenido1').style.display = 'none';
        document.getElementById('nuevoContenido2').style.display = 'flex';
        // Guardar el estado actual
        sessionStorage.setItem('currentState', 'nuevoContenido2');
    }