
<html>
<div class="cont-medicine">
    <div class="header-medicine">
    <button onclick="openFormMedicine()" class="btn-agregar">Agregar medicamentos <i class="bx bx-plus-circle"></i> </button>
    <!-- REQUERIR LO DE SUAREZ AKI --> 
    <input type="text" id="filtroInventario" placeholder="Filtrar por nombre o código"></div>
    <div class="cont-allmedicine">
        <div class="articlesM-cont">
            <?php
            $id_farmacia = $_SESSION["farm"]; 
            require_once '../config/Conexion.php';
            $sql = "SELECT m.codigo, m.nombre, m.precio, i.descripcion, i.stock, m.imagenprincipal, f.*
                    FROM medicamentos m
                    INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento
                    INNER JOIN farmacias f ON m.idfarmacia = f.IdFarmacia
                    WHERE f.IdFarmacia = '$id_farmacia'";

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
                                    <small><strong>Nombre:</strong><span class="nombre-medicamento"> ' . $row["nombre"] . '</span></small>
                                    <small><strong>Cantidad:</strong> ' . $row["stock"] . '</small>
                                </div>
                                <div class="dist-datos">
                                    <small><strong>Código:</strong> <span class="codigo-medicamento"> ' . $row["codigo"] . '</span></small>
                                    <small><strong>Precio:</strong>  $' . $row["precio"] . '</small>
                                </div>
                            </div>
                            <div class="opciones">
                            <button onclick="openDetalleInventario(\'' . $row["nombre"] . '\')" class="btn-verdetalles" id="goku">Ver detalles<i class="fas fa-info-circle"></i></button>
                            </div>
                        </article>
                    ';
                }
                if (mysqli_num_rows($result) == 0) {
                    echo '   <div class="sinMedicamentos">
                    <img src="../assets/img/NoHayM.jpg" alt="" class="imgNohay">
                    <h3 class="titleNohay">No tienes medicamentos.</h3>
                    </div>';
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }

            ?>
        </div>
    </div>
</div>

</html>
