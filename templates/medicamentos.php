<div class="cont-medicine">
    <button onclick="openFormMedicine()" class="btn-agregar">Agregar medicamentos <i class="bx bx-plus-circle"></i> </button>
    <!-- REQUERIR LO DE SUAREZ AKI --> 
    <input type="text" id="filtroNombre" placeholder="Filtrar por nombre o código">
    <div class="cont-allmedicine">
        <div class="articlesM-cont">
            <?php

            $sql = "SELECT *
                    FROM medicamentos m
                    INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento";


            $result = mysqli_query($conexion, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <article class="medicamento-cont">
                            <div class="img-medicine">
                                <img src="../uploads/imgProductos/' . $row["imagenprincipal"] . '" alt="">
                            </div>
                            <div class="datos-medicine">
                                <div class="dist-datos"> 
                                    <small><strong>Nombre:</strong> ' . $row["nombre"] . '</small>
                                    <small><strong>Cantidad:</strong> ' . $row["stock"] . '</small>
                                </div>
                                <div class="dist-datos">
                                    <small><strong>Código:</strong> ' . $row["codigo"] . '</small>
                                    <small><strong>Precio:</strong> ' . $row["precio"] . ' $</small>
                                </div>
                            </div>
                            <div class="opciones">
                                <button  onclick="openModalInventario()" class="btn-verdetalles">Ver detalles<i class="fas fa-info-circle"></i> </button>
                            </div>
                        </article>
                    ';
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }

            ?> 
        </div>
    </div>
</div>

<script>
   document.getElementById('filtroNombre').addEventListener('input', function () {
    var filtro = this.value.toLowerCase().trim();
    var articulos = document.querySelectorAll('.medicamento-cont');

    articulos.forEach(function(articulo) {
        var nombre = articulo.querySelector('small:nth-of-type(1)').textContent.toLowerCase();
        var codigo = articulo.querySelector('small:nth-of-type(3)').textContent.toLowerCase();

        if (nombre.includes(filtro) || codigo.includes(filtro)) {
            articulo.style.display = 'block';
        } else {
            articulo.style.display = 'none';
        }
    });
});
</script>
