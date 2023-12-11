<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../config/Conexion.php');
    $id = $_POST['idCompra'];
    // Verificar qué variable se proporcionó y ajustar la consulta en consecuencia
    if (isset($_SESSION['id'])) {
        $idusu = $_SESSION['id'];
        $id = $_POST['idCompra'];
        // Consulta para el ID de compra
        $consulta = "SELECT 
            medicamentos.nombre AS nombreMedicamento,
            medicamentos.precio AS precioMedicamento,
            detallecompra.cantidad AS cantidadMedicamento,
            detallecompra.preciototal AS precioMedicamentoTotal,
            usuarios.nombre AS nombreusuario,
            usuarios.apellido AS apellidousuario,
            compra.total AS totalCompra,
            compra.telefono,
            compra.fecha,
            compra.direccion,
            compra.correo,
            compra.idtipopago
        FROM compra
            INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra
            JOIN usuarios ON compra.idUsuario = usuarios.idusuario
            JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
        WHERE compra.idcompra = '$id' and compra.idUsuario = '$idusu' ";
    } elseif ($_SESSION['idinvitado']) {
        $idinvitado = $_SESSION['idinvitado'];
        $id = $_POST['idCompra'];
        // Consulta para el ID de invitado
        $consulta = "SELECT 
        medicamentos.nombre AS nombreMedicamento,
        medicamentos.precio AS precioMedicamento,
        detallecompra.cantidad AS cantidadMedicamento,
        detallecompra.preciototal AS precioMedicamentoTotal,
        compra.nombre AS nombreusuario,
        compra.apellido AS apellidousuario,
        compra.total AS totalCompra,
        compra.telefono,
        compra.fecha,
        compra.direccion,
        compra.correo,
        compra.idtipopago
    FROM compra
        INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra
        JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
    WHERE compra.idcompra = '$id' and compra.idinvitado = '$idinvitado'";
    } else {
        // Manejar un escenario donde no se proporciona ni ID ni IDInvitado
        // $_SESSION['id'] = "Valor que quieres asignar"; // Asigna un valor a $_SESSION['id'] si es necesario
        // $_SESSION['idinvitado'] = "Valor que quieres asignar";
        echo json_encode(array('error' => 'No se proporcionó un ID o IDInvitado válido.'));
        exit();
    }

    // Ejecutar la consulta y procesar los resultados
    $consultarcompra = $conexion->query($consulta);

    $datos = array();

    while ($fila = mysqli_fetch_assoc($consultarcompra)) {
        $metodoPago = match ($fila['idtipopago']) {
            '1' => 'Paypal',
            '2' => 'Tarjetas',
            '3' => 'Contraentrega'
        };
        $fila['metodoPago'] = $metodoPago;


        $datos[] = $fila;
    }

    // $datos['subtotal'] = $subtotal;
    echo json_encode($datos);
}
