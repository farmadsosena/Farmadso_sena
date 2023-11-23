<?php
require_once 'config/Conexion.php';

// CONSULTA PARA OBTENER LOS DETALLES DE LA COMPRA
$sql = "SELECT c.idcompra AS idCompra, c.nombre AS nombre_compra, c.fecha, c.direccion, c.nombre AS nombre_cliente, c.correo AS correo_cliente,
               m.nombre AS nombre_producto, m.codigo, dc.cantidad, m.precio AS precio_unitario, dc.preciototal
        FROM detallecompra dc
        INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
        INNER JOIN compra c ON dc.idcompra = c.idcompra";

$resultado = $conexion->query($sql);

?>

<!-- Contenedor para mostrar compras en contenedorCategorias -->
<div class="container-ventas">
    <div class="scroll-categories"> <div class="contenedorCategoria">
        <?php
        $compra_actual = null; // Variable para controlar si ya se mostró la compra actual
        // Verifica si hay resultados
        if ($resultado->num_rows > 0) {
            // Recorre los resultados y muestra los datos
            while ($fila = $resultado->fetch_assoc()) {
                // Comprueba si la compra actual ya se mostró
                if ($compra_actual !== $fila['nombre_compra']) {
        ?>
                   
                        <div class="category">
                            <div class="nombre">
                                <h1><?php echo $fila['nombre_compra']; ?></h1>
                            </div>
                            <div class="descripcion">
                                <p>Fecha de compra: <?php echo $fila['fecha']; ?></p>
                                <p>Cliente: <?php echo $fila['nombre_cliente']; ?> (<?php echo $fila['correo_cliente']; ?>)</p>
                            </div>
                            <div class="buttons">
                                <button onclick="openDetalles()" class="btn-agregar">Ver detalles<i class="fas fa-info-circle"></i> </button>                            </div>
                        </div>
              
        <?php
                    $compra_actual = $fila['nombre_compra']; // Actualiza la compra actual
                    $idcompra = $fila['idCompra'];
                }
            }
        } else {
            echo "No hay resultados";
        }
        ?>
    </div>      </div>
</div>

<!-- Contenedor para mostrar detalles en detallesCompra -->
<div class="detalles" style="display:none;">
<i class="bx bx-chevron-left" onclick="closeDetalles()"></i>
<div class="contenido-factura">


<?php
    // Reinicia el puntero de resultados para recorrerlos nuevamente
    $resultado->data_seek(0);

    // Verifica si hay resultados
    if ($resultado->num_rows > 0) {
        // Inicia la factura
        echo '<div class="factura">';
        echo '<h2>Detalles de compra</h2>';
        echo '<hr>';

        // Muestra los detalles de la compra
        while ($fila = $resultado->fetch_assoc()) {
            echo '<div class="detalle">';
            echo '<p><strong>Medicamento:</strong> ' . $fila['nombre_producto'] . '</p>';
            echo '<p><strong>Cantidad:</strong> ' . $fila['cantidad'] . '</p>';
            echo '<p><strong>Precio unitario:</strong> $' . $fila['precio_unitario'] . '</p>';
            echo '<p><strong>Subtotal:</strong> $' . $fila['preciototal'] . '</p>';
            echo '</div>
            
          
            ';


        }
      
        // Muestra el total
        echo '<div class="total">Total: $' . obtenerTotal($resultado) . '</div>';
        echo '</div>  
        ';
        ?>
    <div class="atencion">
        <p>Si cambias estado indicaras la reclamacion de medicamentos por parte del domiciliario</p>
    </div>    
    </div>
        <button class="boton" style="padding: 7px 7px;" id="cambiarEstadoBtn" data-idcompra="<?php echo $idcompra; ?>">
    <span class="btn-editar">Cambiar Estado</span>
</button>
<?php
    } else {
        echo "No hay resultados";
    }

    // Función para obtener el total de la compra
    function obtenerTotal($resultado)
    {
        $total = 0;
        while ($fila = $resultado->fetch_assoc()) {
            $total += $fila['preciototal'];
        }
        return $total;
    }
    ?>



</div>

