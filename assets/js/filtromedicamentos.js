document.getElementById('filtroNombre').addEventListener('input', function () {
    var filtro = this.value.toLowerCase().trim();
    var articulos = document.querySelectorAll('.manilla');

    articulos.forEach(function(manilla) {
        var nombre = manilla.querySelector('.nombre-medicamentos').textContent.toLowerCase();
        var categoria = manilla.querySelector('.categoria-medicamento').textContent.toLowerCase();
        
        if (nombre.includes(filtro) ||categoria.includes(filtro)) {
            manilla.style.display = 'flex';
        } else {
            manilla.style.display = 'none';
        }
    });
});


document.getElementById('filtroInventario').addEventListener('input', function () {
    var filtro = this.value.toLowerCase().trim();
    var articulos = document.querySelectorAll('.medicamento-cont');

    articulos.forEach(function(articulo) {
        var nombre = articulo.querySelector('.nombre-medicamento').textContent.toLowerCase();
        var codigo = articulo.querySelector('.codigo-medicamento').textContent.toLowerCase();
        
        if (nombre.includes(filtro) ||codigo.includes(filtro)) {
            articulo.style.display = 'flex';
        } else {
            articulo.style.display = 'none';
        }
    });
});


// FILTRA POR FECHA

document.getElementById('filtroVenta').addEventListener('input', function () {
    var filtro = this.value.toLowerCase().trim();
    var articulos = document.querySelectorAll('.venta');

    articulos.forEach(function(categoriV) {
        var fecha = categoriV.querySelector('.fecha').textContent.toLowerCase();
        
        if (fecha.includes(filtro)) {
            categoriV.style.display = 'flex';
        } else {
            categoriV.style.display = 'none';
        }
    });
});



