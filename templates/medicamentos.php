<html>
<div class="cont-medicine">
    <div class="header-medicine">
    <button onclick="openFormMedicine()" class="btn-agregar">Agregar medicamentos <i class="bx bx-plus-circle"></i> </button>
    <!-- REQUERIR LO DE SUAREZ AKI --> 
    <input type="text" id="filtroInventario" placeholder="Filtrar por nombre o código"></div>
    <div class="cont-allmedicine">
        <div class="articlesM-cont">
            <?php
            require_once 'config/Conexion.php';
            $sql = "SELECT m.codigo, m.nombre, m.precio, i.descripcion, i.stock, m.imagenprincipal
                    FROM medicamentos m
                    INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento";

            $result = mysqli_query($conexion, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <article class="medicamento-cont">
                            <div class="img-medicine">
                                <img src="uploads/imgProductos/' . $row["imagenprincipal"] . '" alt="">
                            </div>
                            <div class="datos-medicine">
                                <div class="dist-datos"> 
                                    <small><strong>Nombre:</strong><span class="nombre-medicamento"> ' . $row["nombre"] . '</span></small>
                                    <small><strong>Cantidad:</strong> ' . $row["stock"] . '</small>
                                </div>
                                <div class="dist-datos">
                                    <small><strong>Código:</strong> <span class="codigo-medicamento"> ' . $row["codigo"] . '</span></small>
                                    <small><strong>Precio:</strong>  $' . $row["precio"] . '</small>
                                </div>
                            </div>
                            <div class="opciones">
                            <button onclick="openDetalleInventario(\'' . $row["nombre"] . '\')" class="btn-verdetalles">Ver detalles<i class="fas fa-info-circle"></i></button>
                            </div>
                        </article>
                    ';
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }

            mysqli_close($conexion);
            ?>
        </div>
    </div>
</div>

</html>
