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

