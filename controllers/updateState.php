<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../config/Conexion.php";
    require_once '../models/Log.php';
    session_start();

    
    // Evitar inyección SQL usando mysqli_real_escape_string
    $idCompra = mysqli_real_escape_string($conexion, $_POST['idCompra']);

   
    // Obtener datos de la tabla comprasmasivas
    $consultaComprasMasivas = $conexion->prepare("SELECT cantidadFarmacias, cantidadConfirmada, HoraReclamada FROM comprasmasivas WHERE idcompra = ?");
    $consultaComprasMasivas->bind_param("i", $idCompra);
    $consultaComprasMasivas->execute();
    $consultaComprasMasivas->bind_result($cantidadFarmacias, $cantidadConfirmada, $horaReclamada);
    $consultaComprasMasivas->fetch();
    $consultaComprasMasivas->close();  

    // Actualizar comprasmasivas
    $nuevaCantidadConfirmada = $cantidadConfirmada + 1;
    $horaActual = date('Y-m-d H:i:s');
    $actualizarComprasMasivas = $conexion->prepare("UPDATE comprasmasivas SET cantidadConfirmada = ?, HoraReclamada = ? WHERE idcompra = ?");
    $actualizarComprasMasivas->bind_param("isi", $nuevaCantidadConfirmada, $horaActual, $idCompra);
    $actualizarComprasMasivas->execute();
    $actualizarComprasMasivas->close();

    // Obtener la hora de los medicamentos desde la tabla reporteestadofinal
    $consultaReporteEstado = $conexion->prepare("SELECT horaMedicamentos FROM reporteestadofinal WHERE idcompra = ?");
    $consultaReporteEstado->bind_param("i", $idCompra);
    $consultaReporteEstado->execute();
    $consultaReporteEstado->bind_result($horaMedicamentos);
    $consultaReporteEstado->fetch();
    $consultaReporteEstado->close();

    // Comparar condiciones y actualizar los estados
    if ($cantidadFarmacias == $nuevaCantidadConfirmada && $horaReclamada <= $horaMedicamentos) {
        // Actualizar estado en la tabla reporteestadofinal
        $nuevoEstado = 3;
        $actualizarReporteEstado = $conexion->prepare("UPDATE reporteestadofinal SET idestadocompra = ?, fechafinal = DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE idcompra = ?");
        $actualizarReporteEstado->bind_param("ii", $nuevoEstado, $idCompra);
        $actualizarReporteEstado->execute();
        $actualizarReporteEstado->close();

        // Actualizar estado en la tabla compra
        $actualizarCompra = $conexion->prepare("UPDATE compra SET idestadocompra = ? WHERE idcompra = ?");
        $actualizarCompra->bind_param("ii", $nuevoEstado, $idCompra);
        $actualizarCompra->execute();
        $actualizarCompra->close();
    } else {
        // Solo actualizar la hora en comprasmasivas
        $actualizarHora = $conexion->prepare("UPDATE comprasmasivas SET HoraReclamada = ? WHERE idcompra = ?");
        $actualizarHora->bind_param("si", $horaActual, $idCompra);
        $actualizarHora->execute();
        $actualizarHora->close();
    }

    $consulticacompra = $conexion->query("SELECT c.* FROM compra c WHERE c.idcompra = $idCompra");

    $resultadits = $consulticacompra->fetch_assoc(); 
    
    $fechita = $resultadits['fecha'];
    
    // Redireccionar de manera adecuada utilizando window en lugar de windows
    echo'
    <style>
    
.loader-container {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    height: 100%;
    flex-direction: column;
    text-align: center;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 20px auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    </style>
    <div class="loader-container">
    <div class="loader"></div>
    <p>Procesando cambios...</p>
</div>';


$log  = new Log();
 
$ip = $log::getIp();
$type = $log::typeDispositive();
$info = array(
    'nivel' => 'INFO',   
    'mensaje' => "Se han realizado reclamo de compra del dia: ".$fechita." ",
    'ip' => $ip,
    'id_usuario' => $_SESSION['id'],
    'tipo' => $type 
);
$resultt = $log->insert($info);

    echo "<script>window.location.href='../views/PanelAdmin.php';</script>";

    // Cerrar la conexión y liberar recursos
    $conexion->close();
}
?>
