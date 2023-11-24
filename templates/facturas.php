<html lang="en">


<i class="bx bx-chevron-left" onclick="closeDetalles()"></i>
<div class="contenido-factura" id="contenido-factura">
    <?php
    // Include the database connection file (assuming it's in '../config/Conexion.php')
    require_once '../config/Conexion.php';
    $idCompra;
    // Validate if the ID of the purchase is received
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Get the ID of the purchase
        $ID = $_POST['idcompra'];

        // Use prepared statements to prevent SQL injection
        $consulta = "SELECT * FROM detallecompra WHERE idcompra = $ID";
        $resultado = $conexion->query($consulta);




        // Check if the query was successful
        if ($resultado) {
            // Check if there are details of the purchase
            if ($resultado->num_rows > 0) {
                echo '<div class="factura">';
                echo '<h2>Detalles de compra</h2>';
                echo '<hr>';

                // Display details of the purchase
                while ($fila = $resultado->fetch_assoc()) {

                    $idCompra = $fila['idcompra'];
                    echo '<div class="detalle">';
                    echo '<p><strong>Cantidad:</strong> ' . $fila['cantidad'] . '</p>';
                    // Puedes agregar más detalles según sea necesario
                    echo '</div>';
                }

                // End of the purchase details container
                echo '</div>';
            } else {
                echo 'No hay detalles de compra para el ID proporcionado.';
            }
        }


        // Cierra la conexión a la base de datos después de usarla
    
    }

    ?>

    <div class="atencion">
        <p>Si cambias estado indicarás la reclamación de medicamentos por parte del domiciliario</p>
    </div>

    <!-- Button to change the state (without purchase ID) -->
    <form action="../controllers/updateState.php" method="post" >
        <input type="hidden" name="idCompra" value="<?php echo $idCompra; ?>">
        <button type="submit" class="btn-editar">Cambiar Estado</button>
    </form>
    <div id="detalleCompra"></div>
</div>


</html>