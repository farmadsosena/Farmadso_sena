<?php
require_once '../config/Conexion.php';

// CONSULTA PARA OBTENER LOS DETALLES DE LA COMPRA
$sql = "SELECT c.idcompra AS idCompra, c.idestadocompra  AS idestado,  c.nombre AS nombre_compra, c.fecha, c.direccion, c.nombre AS nombre_cliente, c.correo AS correo_cliente,
               m.nombre AS nombre_producto, m.codigo, dc.cantidad, m.precio AS precio_unitario, dc.preciototal
        FROM detallecompra dc
        INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
        INNER JOIN compra c ON dc.idcompra = c.idcompra";

$resultado = $conexion->query($sql);

?>

<!-- Contenedor para mostrar compras en contenedorCategorias -->
<div class="container-ventas">
    <div class="scroll-categories">
        <div class="contenedorCategoria">
            <?php
            $compra_actual = null; // Variable para controlar si ya se mostró la compra actual
            // Verifica si hay resultados
            
            if ($resultado->num_rows > 0) {
                // Recorre los resultados y muestra los datos
                while ($fila = $resultado->fetch_assoc()) {
                    $idEstado = intval($fila['idestado']);

                    $estado = match ($idEstado) {
                        1 => 'Disponible',
                        2 => 'Asignado',
                        3 => 'Transito',
                        4 => 'Entregado',
                        default => 'Estado Desconocido'
                    };
                    // Comprueba si la compra actual ya se mostró
                    if ($compra_actual !== $fila['nombre_compra']) {
                        $idcompra = $fila['idCompra'];
                        ?>

                        <div class="category">
                            <div class="nombre">
                                <h1>
                                    <?php echo $fila['nombre_compra']; ?>
                                </h1>
                            </div>
                            <div class="descripcion">
                                <p>Fecha de compra:
                                    <?php echo $fila['fecha']; ?>
                                </p>
                                <p>Cliente:
                                    <?php echo $fila['nombre_cliente']; ?> (
                                    <?php echo $fila['correo_cliente']; ?>)
                                </p>
                            </div>
                            <div class="buttons">
                                <div class="state">
                                    <?php echo $estado; ?>
                                </div>
                                <button onclick="openDetalles(<?php echo $idcompra; ?>)" class="btn-agregar">Ver detalles<i
                                        class="fas fa-info-circle"></i> </button>
                            </div>
                        </div>

                        <?php
                        $compra_actual = $fila['nombre_compra']; // Actualiza la compra actual
            
                    }
                }
            } else {
                echo "No hay resultados";
            }
            ?>
        </div>
    </div>
</div>