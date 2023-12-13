<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../config/Conexion.php');

    if (isset($_SESSION['id'])) {
        $idusu = $_SESSION['id'];
        $id = $_POST['idCompra'];
        $consulta = "SELECT 
            medicamentos.nombre AS nombreMedicamento,
            medicamentos.precio AS precioMedicamento,
            detallecompra.cantidad AS cantidadMedicamento,
            detallecompra.preciototal AS precioMedicamentoTotal,
            usuarios.nombre AS nombreusuario,
            usuarios.apellido AS apellidousuario,
            compra.total AS totalCompra,
            compra.fecha,
            compra.direccion,
            compra.correo,
            compra.idtipopago
        FROM compra
            INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra
            JOIN usuarios ON compra.idUsuario = usuarios.idusuario
            JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
        WHERE compra.idcompra = '$id' and compra.idUsuario = '$idusu'";
    } elseif ($_SESSION['idinvitado']) {
        $idinvitado = $_SESSION['idinvitado'];
        $id = $_POST['idCompra'];
        $consulta = "SELECT 
            medicamentos.nombre AS nombreMedicamento,
            medicamentos.precio AS precioMedicamento,
            detallecompra.cantidad AS cantidadMedicamento,
            detallecompra.preciototal AS precioMedicamentoTotal,
            compra.nombre AS nombreusuario,
            compra.apellido AS apellidousuario,
            compra.total AS totalCompra,
            compra.fecha,
            compra.direccion,
            compra.correo,
            compra.idtipopago
        FROM compra
            INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra
            JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
        WHERE compra.idcompra = '$id' and compra.idinvitado = '$idinvitado'";
    } else {
        echo json_encode(array('error' => 'No se proporcionó un ID o IDInvitado válido.'));
        exit();
    }

    $consultarcompra = $conexion->query($consulta);

    $datos = array();

    while ($fila = mysqli_fetch_assoc($consultarcompra)) {
        $metodoPago = match ($fila['idtipopago']) {
            '1' => 'Paypal',
            '2' => 'Tarjetas',
            '3' => 'Contraentrega'
        };
        $fila['metodoPago'] = $metodoPago;

        // Conversión de dólares a pesos colombianos (suponiendo una tasa de cambio)
        $tasaCambio = 4049.1688; // Tasa de cambio estimada
        $subtotalDolares = $fila['totalCompra'];
        $subtotalCOP = $subtotalDolares * $tasaCambio;

        // Formatear el subtotal a dos decimales y sin separadores de miles
        $subtotalFormateado = number_format($subtotalCOP, 2, '.', '');
        $fila['totalCompra'] = $subtotalFormateado;

        $datos[] = $fila;
    }

    echo json_encode($datos);
}

