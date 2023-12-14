<?php
require_once '../config/Conexion.php';

// Obtener el id de usuario desde la sesión
$idUsuario = $_SESSION["id"];

// Consulta para obtener el IdFarmacia asociado al usuario
$sqlFarmacia = "SELECT IdFarmacia FROM farmacias WHERE idusuario = $idUsuario";
$resultadoFarmacia = $conexion->query($sqlFarmacia);

if ($resultadoFarmacia && $resultadoFarmacia->num_rows > 0) {
    // Obtener el IdFarmacia
    $filaFarmacia = $resultadoFarmacia->fetch_assoc();
    $idFarmacia = $filaFarmacia['IdFarmacia'];

    // Consulta para obtener los detalles de la compra asociada a tu farmacia
    $sql = "SELECT c.idcompra AS idCompra, dm.*,us.*, c.fecha AS fechaCompra , c.idestadocompra  AS idestado, rp.*, c.nombre AS nombre_compra, c.fecha, c.direccion, c.nombre AS nombre_cliente, c.correo AS correo_cliente,
                   m.nombre AS nombre_producto, m.codigo, dc.cantidad, m.precio AS precio_unitario, dc.preciototal
            FROM detallecompra dc
            INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
            INNER JOIN compra c ON dc.idcompra = c.idcompra
            INNER JOIN reporteestadofinal rp ON c.idcompra = rp.idcompra
            INNER JOIN domiciliario dm ON rp.idrepartidor = dm.iddomiciliario
            INNER JOIN usuarios us ON dm.idusuario = us.idusuario
            WHERE m.idfarmacia = $idFarmacia";

    $resultado = $conexion->query($sql); 
    $domis = $resultado->fetch_assoc();
    $nombreDomi = $domis['nombre'];
    $contactoDomi = $domis['telefono'];
    ?>

    <!-- Contenedor para mostrar compras en contenedorCategorias -->
    <div class="container-ventas">
    <div class="filtroVentas">
        <input type="text" id="filtroVenta" placeholder="Filtra fecha">
</div>
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
                            // Supongamos que $fila['fechaCompra'] es una cadena de fecha y hora en formato 'Y-m-d H:i:s'
                            $fechaCompraStr = $fila['fechaCompra'];
                            
                            // Convertir la cadena a un objeto DateTime
                            $fechaCompra = DateTime::createFromFormat('Y-m-d H:i:s', $fechaCompraStr);
                            
                            // Verificar si la conversión fue exitosa
                            if ($fechaCompra === false) {
                                echo "Error al convertir la fecha.";
                            } else {
                                // Configurar el locale a español
                                setlocale(LC_TIME, 'es_ES.utf8');
                            
                                // Array asociativo para traducir nombres de meses
                                $meses = [
                                    'January' => 'enero',
                                    'February' => 'febrero',
                                    'March' => 'marzo',
                                    'April' => 'abril',
                                    'May' => 'mayo',
                                    'June' => 'junio',
                                    'July' => 'julio',
                                    'August' => 'agosto',
                                    'September' => 'septiembre',
                                    'October' => 'octubre',
                                    'November' => 'noviembre',
                                    'December' => 'diciembre',
                                ];
                            
                                // Extraer información de fecha y hora
                                $año = $fechaCompra->format('Y');
                                $dia = $fechaCompra->format('d'); 
                                $mesis = $fechaCompra->format('m');
                                // Día del mes (con ceros iniciales)
                                $mes = $meses[$fechaCompra->format('F')]; // Nombre del mes en español
                                $hora = $fechaCompra->format('H:i:s'); // Formato de 24 horas de la hora:minuto
                            }
                            
                            ?>
                            <div class="venta">
                            <div class="category">

                                <div class="nombre">
                                    <h1>
                                       Fecha de compra:
                                    </h1>
                                    <span class="fecha">
                                         <?php echo $año."/".$mesis."/".$dia; 
                                         ?>
                                    </span>
                                </div>
                                <div class="descripcion">
                                    <h1>
                                        Segumiento:
                                    </h1>
                                    <p>
                                        <?php
                                        if($idEstado ==1){
                                            ?>
                                            Ningun domiciliario ha atendido tu venta
                                            <?php
                                        } elseif($idEstado ==2){
                                            echo "El domiciliario: <strong style='color: #247a38; font-weight: 800;'>".$nombreDomi."</strong> con el telefono: <a href=tel:+57".$contactoDomi.">".$contactoDomi."</a>. <strong style='color: rgb(184, 172, 48); font-weight: 800;'> Está en camino</strong>";
                                            ?>
                                
                                            <?php
                                        } elseif($idEstado ==3){
                                            echo "El domiciliario: <strong style='color: #247a38; font-weight: 800;'>".$nombreDomi."</strong> con el telefono: <a href=tel:+57".$contactoDomi.">".$contactoDomi."</a>.<strong style='color: #2e8f7b; font-weight: 800;'> Tiene en su posesión tus productos</strong>";
                                            ?>
                                            
                                            <?php
                                        }elseif($idEstado ==4){
                                            echo " Producto entregado satisfacEl domiciliario: <strong style='color: #247a38; font-weight: 800;'>".$nombreDomi."</strong> con el telefono: <a href=tel:+57".$contactoDomi.">".$contactoDomi."</a>.<strong style='color: #2e8f7b; font-weight: 800;'> Tiene en su posesión tus productos</strong>";
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="buttons">
                                 
                                    <!-- ARCHIVO JS NAME: ventana-modals -->
                                    <button onclick="openDetalles(<?php echo $idcompra; ?>)" class="btn-agregar">Ver detalles<i
                                            class="fas fa-info-circle"></i> </button>
                                            <?php 
                                            if($idEstado == 2){
                                                ?>
                                                                                            
                                        <form action="../controllers/updateState.php" method="post" onsubmit="return confirm('Esta funcion indicará que el domiciliario tiene los productos de la venta realizada el dia: <?php echo $dia.' del mes: '.$mes.' a las: '.$hora; ?> en su poder.\n\n¿Estás seguro de aplicar cambio?');">
                                            <input type="hidden" name="idCompra" value="<?php echo $idcompra; ?>">
                                            <button type="submit" class="btn-estado">Despachar<i class="bx bx-edit"></i></button>
                                        </form>

<?php
                                        }
?>
                                </div>

                                
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
  

    <?php
} else {
    echo "No se encontró la farmacia asociada al usuario.";
}
?>
