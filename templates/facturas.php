
<html lang="en">

<div class="detalles">
    <i class="bx bx-chevron-left" onclick="closeDetalles()"></i>
    <div class="contenido-factura" id="contenido-factura">
    <?php
    // Include the database connection file (assuming it's in '../config/Conexion.php')
    require_once '../config/Conexion.php';

    // Validate if the ID of the purchase is received
    if (isset($_POST['idcomp'])) {
        // Get the ID of the purchase
        $idComprando = $_POST['idcomp'];

        // Use prepared statements to prevent SQL injection
        $consulta = "SELECT * FROM detallecompra WHERE idcompra = ?";
        $stmt = $conexion->prepare($consulta);

        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $idComprando);

            // Execute the statement
            $stmt->execute();

            // Get the result set
            $resultado = $stmt->get_result();

            // Check if the query was successful
            if ($resultado) {
                // Check if there are details of the purchase
                if ($resultado->num_rows > 0) {
                    echo '<div class="factura">';
                    echo '<h2>Detalles de compra</h2>';
                    echo '<hr>';

                    // Display details of the purchase
                    while ($fila = $resultado->fetch_assoc()) {
                        echo '<div class="detalle">';
                        echo '<p><strong>Cantidad:</strong> ' . $fila['cantidad'] . '</p>';
                        echo '</div>';
                    }

                    // End of the purchase details container
                    echo '</div>';
                } else {
                    echo 'No hay detalles de compra para el ID proporcionado.';
                }
            } else {
                // Display an error if the query fails
                echo 'Error en la consulta: ' . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Display an error if the prepared statement fails
            echo 'Error en la preparación de la consulta.';
        }
    } else {
        // Display a message if the purchase ID is not received
        echo 'No se recibió el ID de compra.';
    }
    ?>

    <div class="atencion">
        <p>Si cambias estado indicarás la reclamación de medicamentos por parte del domiciliario</p>
    </div>

    <!-- Button to change the state (without purchase ID) -->
    <button class="boton" style="padding: 7px 7px;" id="cambiarEstadoBtn" data-idcompra="">
        <span class="btn-editar">Cambiar Estado</span>
    </button>
    <div id="detalleCompra"></div>
</div>
</html>