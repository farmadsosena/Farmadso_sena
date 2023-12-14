// Cargar los productos de la tabla carrito 
function TraerDataCart() {
    fetch('../controllers/getProductosFormulas.php')
        .then(response => response.json())
        .then(data => {
            // Acceder al array de medicamentos
            const medicamentos = data.medicamentos;

            // Iterar sobre los medicamentos y construir el HTML dinámicamente
            const htmlMedicamentos = medicamentos.map(medicamento => `
                <div id="medicamento${medicamento.id}" class="itemCarrito">
                    <img src="../uploads/imgProductos/${medicamento.imagenprincipal}" alt="">
                    <div class="contenido">
                        <p>${medicamento.nombre}</p>
                        <p>${medicamento.codigo}</p>
                        <span class="costo">${medicamento.precio}</span>
                    </div>
                    <div class="cantidad">
                        <p></p>
                        <p>${medicamento.cantidadcarrito}</p>
                        <span class="costo subtotal">$${medicamento.costo}</span>
                    </div>
                </div>
            `).join('');

            // Actualizar el contenido del contenedor con el HTML construido
            document.getElementById('tabla-contenedor').innerHTML = htmlMedicamentos;

            // Actualizar el subtotal
            document.getElementById('subtotal').textContent = `$${data.subtotal}`;
        })
        .catch(error => {
            console.error('Error al obtener datos del carrito:', error);
        });
}

TraerDataCart()