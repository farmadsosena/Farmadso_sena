const filtroSelect = document.getElementById("filtroSelect");
const buscarFacturaInput = document.getElementById("buscarFactura");
const fechaInicialDiv = document.querySelector(".FechaInicial");
const fechaFinalDiv = document.querySelector(".FechaFinal");
const fechaInicialInput = document.getElementById("fechainicial");
const fechaFinalInput = document.getElementById("fechaFinal");
const valorFechaInicial = document.getElementById("fechainicial");
const valorFechaFinal = document.getElementById("fechaFinal");
// Añadir un evento de cambio al select
filtroSelect.addEventListener("change", function () {
  // Verificar la opción seleccionada
  if (filtroSelect.value === "codigo") {
    // Mostrar el input de búsqueda y ocultar fechas
    buscarFacturaInput.style.display = "flex";
    fechaInicialDiv.style.display = "none";
    fechaFinalDiv.style.display = "none";
    // Limpiar valores de fechas
    fechaInicialInput.value = "";
    fechaFinalInput.value = "";
  } else if (filtroSelect.value === "fecha") {
    // Ocultar el input de búsqueda y mostrar fechas
    buscarFacturaInput.style.display = "none";
    fechaInicialDiv.style.display = "block";
    fechaFinalDiv.style.display = "block";
    // Limpiar valores de búsqueda
    buscarFacturaInput.value = "";
  }
});

buscarFacturaInput.addEventListener("input", function () {
  var dato = buscarFacturaInput.value.toLowerCase(); // Convertir a minúsculas para hacer una comparación sin distinción entre mayúsculas y minúsculas
  var facturas = document.querySelectorAll(".c");

  facturas.forEach((factura) => {
    var codigo = factura.querySelector(".co>p");
    var textoCodigo = codigo.textContent.toLowerCase(); // Convertir a minúsculas para hacer una comparación sin distinción entre mayúsculas y minúsculas

    // Utiliza toLowerCase para hacer la comparación sin distinción entre mayúsculas y minúsculas
    if (textoCodigo.startsWith(dato)) {
      factura.style.display = "block";
    } else {
      factura.style.display = "none";
    }
  });
});



function formatearFechaUsuario(fecha) {
    var dia = fecha.getDate() + 1; // ¡Sumar 1 al día!
    var mes = fecha.getMonth() + 1; // ¡Sumar 1 al mes!
    var año = fecha.getFullYear();
  
    dia = dia < 10 ? "0" + dia : dia;
    mes = mes < 10 ? "0" + mes : mes;
  
    return dia + "/" + mes + "/" + año;
}

function formatearFechaFactura(fechaStr) {
    var partes = fechaStr.match(/(\d+)\/(\d+)\/(\d+)/);
    if (partes) {
        var dia = partes[1];
        var mes = partes[2];
        var año = partes[3];

        // Asegurarse de que el año tenga cuatro dígitos
        año = año.length === 2 ? "20" + año : año;

        // Ajustar la cadena de salida directamente al formato "dd/mm/yyyy"
        return dia + "/" + mes + "/" + año;
    } else {
        return null; // Devolver nulo en caso de fecha no válida
    }
}

valorFechaFinal.addEventListener("input", function () {
    var fechainicialUsuario = new Date(valorFechaInicial.value);
    var fechaFinalUsuario = new Date(valorFechaFinal.value);

    var fechaInicialFormateada = formatearFechaUsuario(fechainicialUsuario);
    var fechaFinalFormateada = formatearFechaUsuario(fechaFinalUsuario);

    console.log("Fecha inicial formateada:", fechaInicialFormateada);
    console.log("Fecha final formateada:", fechaFinalFormateada);

    var facturas = document.querySelectorAll(".c");

    facturas.forEach((factura) => {
        var fecha = factura.querySelector(".FechaDate>p");
        console.log("Contenido de FechaDate>p:", fecha.textContent);

        var fechaString = fecha.textContent.trim().replace("Fecha:", ""); // Elimina espacios y la parte "Fecha:"
        var fechaFactura = formatearFechaFactura(fechaString);

        console.log("Fecha factura:", fechaFactura);

        if (fechaFactura < fechaInicialFormateada || fechaFactura > fechaFinalFormateada) {
            factura.style.display = "none";
        } else {
            factura.style.display = "block";
        }
    });
});


