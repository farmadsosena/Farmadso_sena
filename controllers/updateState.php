<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../config/Conexion.php";

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
        $actualizarReporteEstado = $conexion->prepare("UPDATE reporteestadofinal SET idestadocompra = ?, fechafinal = DATE_ADD(NOW(), INTERVAL 1 MINUTE) WHERE idcompra = ?");
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

    // Redireccionar de manera adecuada utilizando window en lugar de windows
    echo "<script>window.location.href='../views/PanelAdmin.php';</script>";

    // Cerrar la conexión y liberar recursos
    $conexion->close();
}
?>
