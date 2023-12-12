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
        $consulta = "SELECT dc.*, c.*, m.nombre AS nombre_medicamento, m.precio AS precioM
                     FROM detallecompra dc
                     INNER JOIN compra c ON dc.idcompra = c.idcompra
                     INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
                     WHERE dc.idcompra = $ID
                     AND m.idfarmacia = $idFarmacia";

        $resultado = $conexion->query($consulta);

        // Verifica si la consulta fue exitosa
        if ($resultado) {
            // Verifica si hay detalles de la compra
            if ($resultado->num_rows > 0) {
                $oli = $resultado->fetch_assoc();
                $idestadoC=  $oli["idestadocompra"];

                $fechaCompraStr = $oli['fecha'];
                            
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
                    $dia = $fechaCompra->format('d'); // Día del mes (con ceros iniciales)
                    $mes = $meses[$fechaCompra->format('F')]; // Nombre del mes en español
                    $hora = $fechaCompra->format('H:i:s'); // Formato de 24 horas de la hora:minuto
                }
                


                echo '<div class="factura">';
                ?>
<div class="header-ventas">

                    <i class="bx bx-chevron-left" onclick="closeDetalles()"></i>

                <?php
                echo '<h2>Detalles de compra del dia: <color-datesish>' .  $dia .'</color-datesish> del mes: <color-datesish>'.$mes.'</color-datesish> a las: <color-datesish>'.$hora. '</color-datesish></h2>';
                echo '<hr>';

                ?>
    </div>
    
    <div class="encabezado">
        <div class="productos">Productos</div>
        <div class="cantidades">Cantidad</div>
        <div class="precioU">precio Unitario</div>
        <div class="subtotal">Sub total</div><div class="otrico"></div>
    </div><div class="scroll-detallesventas">


                <?php
                // Muestra los detalles de la compra
                while ($fila = $resultado->fetch_assoc()) {
                    $idmedicamento = $fila["idmedicamento"];
                    $idCompra = $fila['idcompra'];

?>

<div class="encabezado">
                    <div class="productos"><?php echo $fila['nombre_medicamento']; ?></div>
                    <div class="cantidades"><?php echo $fila['cantidad']; ?></div>
                    <div class="precioU"><?php echo "$".$fila['precioM']; ?></div>
                    <div class="subtotal"><?php $subtotal=$fila['precioM'] * $fila['cantidad']; echo "$".$subtotal; ?></div>
                </div>
                
<?php
                    
                }

           
            } else {
                echo 'No hay detalles de compra para el ID proporcionado.';
            }
        }
    }

    // Cierra la conexión a la base de datos después de usarla
}
?>
</div>

<div class="footer-detalles">
    <div class="totality">
   Total: <?php echo "$".$oli['total'];?>
    </div>
    <?php
if($idestadoC==2){
?>
<!-- Botón para cambiar el estado (con ID de compra) -->
<form action="../controllers/updateState.php" method="post" onsubmit="return confirm('Esta funcion indicará que el domiciliario tiene los productos de la venta realizada el dia: <?php echo $dia.' del mes: '.$mes.' a las: '.$hora; ?> en su poder.\n\n¿Estás seguro de aplicar cambio?');">
    <input type="hidden" name="idCompra" value="<?php echo $idCompra; ?>">
    <button type="submit" class="btn-estado">Despachar<i class="bx bx-edit"></i></button>
</form>


<?php
 }else{
    // NOTHING
 }
?>
</div>
