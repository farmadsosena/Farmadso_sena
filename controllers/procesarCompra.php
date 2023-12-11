<?php
// Requerir el archivo de conexión a la base de datos
require '../config/Conexion.php';

// Crear un nuevo objeto de conexión
$conn = new Conexion();
$conexion = $conn->Getconexion();

// Iniciar la sesión
session_start();
ob_start();
// Obtener los datos JSON del cuerpo de la solicitud
$json = file_get_contents('php://input');
$datos = json_decode($json, true);


if (isset($_SESSION['id'])) {
    $datos['idusuario'] = $_SESSION['id'];
} elseif (isset($_SESSION['idinvitado'])) {
    $datos['idinvitado'] = $_SESSION['idinvitado'];
} else {
    echo json_encode(['error' => 'No se proporcionó un ID de usuario o de invitado']);
    exit();
}

if (isset($_SESSION['id'])) {
    if (is_array($datos)) {
        // Extraer los detalles de la compra desde la respuesta de PayPal
        $idUser = $_SESSION['id'];
        $id_transaccion = $datos['detalles']['id'];
        $total = $datos['detalles']['purchase_units'][0]['amount']['value'];

        // $estado = $datos['detalles']['status'];
        $fecha = $datos['detalles']['update_time'];
        $fecha_formateada = date('Y-m-d H:i:s', strtotime($fecha));
        $email = $datos['detalles']['payer']['email_address'];
        $idClientePaypal = $datos['detalles']['payer']['payer_id'];
        $nombre = $datos['detalles']['payer']['name']['given_name'];
        $apellido = $datos['detalles']['payer']['name']['surname'];
        // Obtener la información de ubicación
        $direccion = $datos['detalles']['purchase_units'][0]['shipping']['address']['address_line_1'];
        $admin_area_2 = $datos['detalles']['purchase_units'][0]['shipping']['address']['admin_area_2'];
        $admin_area_1 = $datos['detalles']['purchase_units'][0]['shipping']['address']['admin_area_1'];
        $postal_code = $datos['detalles']['purchase_units'][0]['shipping']['address']['postal_code'];
        $country_code = $datos['detalles']['purchase_units'][0]['shipping']['address']['country_code'];

        // Consolidar los datos de ubicación en una variable
        $ubicacion = "$direccion, $admin_area_2, $admin_area_1, $postal_code, $country_code";
        $tipoPago = 1;

        // Insertar los datos de la compra en la tabla "compras"
        $insertarCompra = $conexion->query("INSERT INTO compra
    (direccion, nombre, apellido, fecha, idestadocompra, correo, idtipopago, total, idUsuario,idinvitado) VALUES 
    ( '$ubicacion','$nombre', '$apellido', '$fecha_formateada', 1, '$email', '$tipoPago','$total', '$idUser',null)");


        // Inicializar un array para almacenar las filas de la tabla de la factura
        $facturaTable = [];

        if ($insertarCompra) {
            $idcompra = $conexion->insert_id;
            // Obtener los productos del carrito desde los datos de la sesión
            $_SESSION['idcompraContraentrega'] = $idcompra;
            $productos = $_SESSION['medicamentos'];
            foreach ($productos as $key => $stock) {
                // Obtener la información del producto desde la base de datos
                $data = $conexion->query("SELECT medicamentos.precio, inventario.stock, medicamentos.nombre FROM medicamentos INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$key'");

                if ($data) {
                    // Extraer los detalles del producto desde el resultado de la base de datos
                    $DATA = $data->fetch_assoc();
                    $precio = intval($DATA['precio']);
                    $stockActual = intval($DATA['stock']);
                    $cantidadS = intval($stock);
                    $stockFinal = $stockActual - $cantidadS;

                    // Actualizar el stock del producto en el inventario
                    $actualizarInventario = $conexion->query("UPDATE inventario SET stock = '$stockFinal'  WHERE idmedicamento = '$key' ");

                    // Calcular el subtotal para el producto
                    $totaNum = intval($stock);
                    $subtotal = $totaNum * $precio;

                    // Crear una fila de tabla para la factura
                    $productoNombre = $DATA['nombre'];
                    $facturaTable[] = '
                    <tr>
                        <td>' . $productoNombre . '</td>
                        <td>' . $precio . '</td>
                        <td>' . $stock . '</td>
                        <td>' . $subtotal . '</td>
                    </tr>
                ';

                    // Insertar los detalles de la compra en la tabla "detalle_compra"
                    $insertDetalleCompra = $conexion->query("INSERT INTO detallecompra 
                (idmedicamento, cantidad, preciototal, idcompra) VALUES
                ('$key', '$stock','$subtotal', '$idcompra')");

                    // Eliminar los productos del carrito para este usuario
                    $eliminar = $conexion->query("DELETE FROM carrito WHERE idusuario = '$idUser'");

                    // Vaciar los datos de la sesión del carrito
                    unset($_SESSION['medicamentos']);
                } else {
                    echo 'Error al obtener datos del producto';
                    exit;
                }
            }

            // Almacenar los datos de la tabla de la factura en una variable
            $DATA_ALL = $facturaTable;

            $respuesta = array(
                'success' => true,

            );
            // Imprimir una respuesta de éxito en formato JSON

            // Requerir el archivo para enviar el correo electrónico
            require_once 'enviarCorreo.php';

            $respuesta = array(
                'success' => true,
                'idcompra' => $_SESSION['idcompraContraentrega']
            );
            
            unset($_SESSION['idcompraContraentrega']);
            echo json_encode($respuesta);
            
        } else {
            echo 'Error al insertar la compra';
        }
    }
} elseif ($_SESSION['idinvitado']) {
    if (is_array($datos)) {
        // Extraer los detalles de la compra desde la respuesta de PayPal
        $idinvitado = $_SESSION['idinvitado'];
        $id_transaccion = $datos['detalles']['id'];
        $total = $datos['detalles']['purchase_units'][0]['amount']['value'];

        // $estado = $datos['detalles']['status'];
        $fecha = $datos['detalles']['update_time'];
        $fecha_formateada = date('Y-m-d H:i:s', strtotime($fecha));
        $email = $datos['detalles']['payer']['email_address'];
        $idClientePaypal = $datos['detalles']['payer']['payer_id'];
        $nombre = $datos['detalles']['payer']['name']['given_name'];
        $apellido = $datos['detalles']['payer']['name']['surname'];
        // Obtener la información de ubicación
        $direccion = $datos['detalles']['purchase_units'][0]['shipping']['address']['address_line_1'];
        $admin_area_2 = $datos['detalles']['purchase_units'][0]['shipping']['address']['admin_area_2'];
        $admin_area_1 = $datos['detalles']['purchase_units'][0]['shipping']['address']['admin_area_1'];
        $postal_code = $datos['detalles']['purchase_units'][0]['shipping']['address']['postal_code'];
        $country_code = $datos['detalles']['purchase_units'][0]['shipping']['address']['country_code'];

        // Consolidar los datos de ubicación en una variable
        $ubicacion = "$direccion, $admin_area_2, $admin_area_1, $postal_code, $country_code";
        $tipoPago = 1;

        // Insertar los datos de la compra en la tabla "compras"
        $insertarCompra = $conexion->query("INSERT INTO compra
    (direccion, nombre, apellido, fecha, idestadocompra, correo, idtipopago, total,idUsuario,idinvitado) VALUES 
    ( '$ubicacion','$nombre', '$apellido', '$fecha_formateada', 1, '$email', '$tipoPago','$total',null,'$idinvitado')");


        // Inicializar un array para almacenar las filas de la tabla de la factura
        $facturaTable = [];

        if ($insertarCompra) {
            $idcompra = $conexion->insert_id;
            // Obtener los productos del carrito desde los datos de la sesión
            $_SESSION['idcompraContraentrega'] = $idcompra;
            $productos = $_SESSION['medicamentos'];
            foreach ($productos as $key => $stock) {
                // Obtener la información del producto desde la base de datos
                $data = $conexion->query("SELECT medicamentos.precio, inventario.stock, medicamentos.nombre FROM medicamentos INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$key'");

                if ($data) {
                    // Extraer los detalles del producto desde el resultado de la base de datos
                    $DATA = $data->fetch_assoc();
                    $precio = intval($DATA['precio']);
                    $stockActual = intval($DATA['stock']);
                    $cantidadS = intval($stock);
                    $stockFinal = $stockActual - $cantidadS;

                    // Actualizar el stock del producto en el inventario
                    $actualizarInventario = $conexion->query("UPDATE inventario SET stock = '$stockFinal'  WHERE idmedicamento = '$key' ");

                    // Calcular el subtotal para el producto
                    $totaNum = intval($stock);
                    $subtotal = $totaNum * $precio;

                    // Crear una fila de tabla para la factura
                    $productoNombre = $DATA['nombre'];
                    $facturaTable[] = '
                    <tr>
                        <td>' . $productoNombre . '</td>
                        <td>' . $precio . '</td>
                        <td>' . $stock . '</td>
                        <td>' . $subtotal . '</td>
                    </tr>
                ';

                    // Insertar los detalles de la compra en la tabla "detalle_compra"
                    $insertDetalleCompra = $conexion->query("INSERT INTO detallecompra 
                (idmedicamento, cantidad,preciototal,idcompra) VALUES
                ('$key', '$stock', '$subtotal', '$idcompra')");

                    // Eliminar los productos del carrito para este usuario
                    $eliminar = $conexion->query("DELETE FROM carrito WHERE idinvitado = '$idinvitado'");

                    // Vaciar los datos de la sesión del carrito
                    unset($_SESSION['medicamentos']);
                } else {
                    echo 'Error al obtener datos del producto';
                    exit;
                }
            }

            // Almacenar los datos de la tabla de la factura en una variable
            $DATA_ALL = $facturaTable;

            $respuesta = array(
                'success' => true, 
            );
            
            // Imprimir una respuesta de éxito en formato JSON

            // Requerir el archivo para enviar el correo electrónico
            require_once 'enviarCorreo.php';

            $respuesta = array(
                'success' => true,
                'idcompra' => $_SESSION['idcompraContraentrega']
            );
            
            unset($_SESSION['idcompraContraentrega']);
            echo json_encode($respuesta);
            
        } else {
            echo 'Error al insertar la compra';
        }
    }
}
