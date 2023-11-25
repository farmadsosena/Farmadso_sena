<?php
session_start();
$idusuario = $_SESSION["id"];
// Incluye el archivo de conexión a la base de datos (asumiendo que está en '../config/Conexion.php')
require_once '../config/Conexion.php';
$idCompra;

// Valida si se recibe el ID de la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene el ID de la compra
    $ID = $_POST['idcompra'];

    // Obtiene el IdFarmacia del usuario actual
    $consultaFarmacia = "SELECT IdFarmacia FROM farmacias WHERE idusuario = $idusuario";
    $resultadoFarmacia = $conexion->query($consultaFarmacia);

    if ($resultadoFarmacia && $resultadoFarmacia->num_rows > 0) {
        $filaFarmacia = $resultadoFarmacia->fetch_assoc();
        $idFarmacia = $filaFarmacia['IdFarmacia'];

        // Utiliza declaraciones preparadas para evitar la inyección SQL
        $consulta = "SELECT dc.*, m.nombre AS nombre_medicamento
                     FROM detallecompra dc
                     INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
                     WHERE dc.idcompra = $ID
                     AND m.idfarmacia = $idFarmacia";

        $resultado = $conexion->query($consulta);

        // Verifica si la consulta fue exitosa
        if ($resultado) {
            // Verifica si hay detalles de la compra
            if ($resultado->num_rows > 0) {
                echo '<div class="factura">';
                echo '<h2>Detalles de compra: ' .  $ID . '</h2>';
                echo '<hr>';

                // Muestra los detalles de la compra
                while ($fila = $resultado->fetch_assoc()) {
                    $idmedicamento = $fila["idmedicamento"];
                    $idCompra = $fila['idcompra'];

                    echo '<div class="detalle">';
                    echo '<p><strong>Nombre del Medicamento:</strong> ' . $fila['nombre_medicamento'] . '</p>';
                    echo '<p><strong>Cantidad:</strong> ' . $fila['cantidad'] . '</p>';
                    // Puedes agregar más detalles según sea necesario
                    echo '</div>';
                }

                // Fin del contenedor de detalles de la compra
                echo '</div>';
            } else {
                echo 'No hay detalles de compra para el ID proporcionado.';
            }
        }
    }

    // Cierra la conexión a la base de datos después de usarla
}
?>

<div class="atencion">
    <p>Si cambias el estado, indicarás la reclamación de medicamentos por parte del domiciliario</p>
</div>

<!-- Botón para cambiar el estado (sin ID de compra) -->
<form action="../controllers/updateState.php" method="post">
    <input type="hidden" name="idCompra" value="<?php echo $idCompra; ?>">
    <button type="submit" class="btn-editar">Cambiar Estado</button>
</form>
<div id="detalleCompra"></div>
