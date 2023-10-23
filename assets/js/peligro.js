    // Función para abrir la modal
    function abrirModalTress() {
        var modal = document.getElementById("myModalTress");
        modal.style.display = "block";
    }

    // Función para cerrar la modal
    function cerrarModalTress() {
        var modal = document.getElementById("myModalTress");
        modal.style.display = "none";
    }

    // Abre la modal cuando se hace clic en el icono "peligro"
    document.getElementById("peligro").addEventListener("click", abrirModalTress);

    // Cierra la modal si se hace clic en el botón de cerrar
    document.getElementById("cerrarModalTress").addEventListener("click", cerrarModalTress);

    // Cierra la modal si se hace clic fuera de ella
    window.onclick = function(event) {
        var modal = document.getElementById("myModalTress");
        if (event.target === modal) {
            cerrarModalTress();
        }
    }

    // Acción cuando se hace clic en el botón "Enviar"
    document.getElementById("enviarBtn").addEventListener("click", function() {
        // Aquí puedes agregar la lógica para procesar el envío de datos o lo que necesites
        alert("Datos enviados con éxito"); // Ejemplo de alerta, reemplázalo con tu lógica real
        cerrarModalTress(); // Cierra la modal después de enviar
    });
