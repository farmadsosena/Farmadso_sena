function editarMedicamento(id) {
    if (id) {


       fetch('controller')
        // Ocultar el modal de inventario
        document.querySelector('.modal-inventario').style.display = 'none';
        document.querySelector('.cont-medicine').style.display = 'none';
        // Mostrar el formulario de edición de medicamento
        document.querySelector('.cont-editar-medicamento').style.display = 'block';

        

        // Obtener las variables del medicamento seleccionado
        var codigo = document.querySelector('.codigo-medicamento').textContent;
        var nombre = document.querySelector('.nombre-medicamentos').textContent;
        var precio = document.querySelector('.precio-medicamento').textContent;
        var descripcion = document.querySelector('.descripcion-medicamento').textContent;
        var vencimiento = document.querySelector('.vencimiento-medicamento').textContent;
        var administracion = document.querySelector('.administracion-medicamento').textContent;
        var instrucciones = document.querySelector('.instrucciones-medicamento').textContent;
        var categoria = document.querySelector('.categoria-medicamento').textContent;
        var proveedor = document.querySelector('.proveedor-medicamento').textContent;
        var lote = document.querySelector('.lote-medicamento').textContent;
        var stock = document.querySelector('.stock-medicamento').textContent;

       

        actualizaxDatos(

            
codigo,
nombre,
precio,
descripcion,
vencimiento,
instrucciones,
administracion,
categoria,
proveedor,
lote,
stock
        );


    } else {
        alert("ID no válido");
    }
}

function closeEditar(){
    document.querySelector('.cont-medicine').style.display = 'block';
    document.querySelector('.cont-editar-medicamento').style.display = 'none';
   
}
function actualizaxDatos(

codigo,
nombre,
precio,
descripcion,
vencimiento,
instrucciones,
administracion,
categoria,
proveedor,
lote,
stock
){
    codigo = parseFloat(codigo);
    lote = parseFloat(lote);
    precio = parseFloat(precio);

    alert(lote)

    
                // Llenar los campos del formulario con los valores obtenidos
                document.getElementById('cumme').value = codigo;
                document.getElementById('medicineNamee').value = nombre;
                document.getElementById('priceMedicinee').value = precio;
                document.getElementById('administrae').value = administracion;
                document.getElementById('descriptionMedicinee').value = descripcion;
                document.getElementById('expirationDatee').value = vencimiento;
                document.getElementById('instructionMedicinee').innerText = instrucciones;
                document.getElementById('instructionMedicinee').value = instrucciones;
                document.getElementById('categorye').value = categoria;
                document.getElementById('provideMedicinee').value = proveedor;
                document.getElementById('loteMedicinee').value = lote;
                document.getElementById('StockMedicinee').value = stock;
}