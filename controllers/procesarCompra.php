<?php
// Requerir el archivo de conexión a la base de datos
require '../models/conexion.php';

// Crear un nuevo objeto de conexión
$conn = new Conexion();
$conexion = $conn->Getconexion();

// Iniciar la sesión
session_start();
ob_start();
// Obtener los datos JSON del cuerpo de la solicitud
$json = file_get_contents('php://input');
$datos = json_decode($json, true);



if (is_array($datos)) {
    // Extraer los detalles de la compra desde la respuesta de PayPal
    $idUser = $_SESSION['id_cliente'];
    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $estado = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_formateada = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $idClientePaypal = $datos['detalles']['payer']['payer_id'];

    // Insertar los datos de la compra en la tabla "compras"
    $insertarCompra = $conexion->query("INSERT INTO compras
    (id_transaccion, fecha, estado, email, id_usuario, total, id_user) VALUES 
    ('$id_transaccion', '$fecha_formateada', '$estado', '$email', '$idClientePaypal', '$total', '$idUser')");

    // Inicializar un array para almacenar las filas de la tabla de la factura
    $facturaTable = [];

    if ($insertarCompra) {
        $idCompra = $conexion->insert_id;

        // Obtener los productos del carrito desde los datos de la sesión
        $productos = $_SESSION['datosPedido'];

        foreach ($productos as $key => $stock) {
            // Obtener la información del producto desde la base de datos
            $data = $conexion->query("SELECT inventario.valor, inventario.stock, producto.nombre_producto FROM inventario INNER JOIN producto ON inventario.id_producto = producto.id_producto WHERE inventario.id_producto = '$key'");

            if ($data) {
                // Extraer los detalles del producto desde el resultado de la base de datos
                $DATA = $data->fetch_assoc();
                $precio = intval($DATA['valor']);
                $stockActual = intval($DATA['stock']);
                $cantidadS = intval($stock);
                $stockFinal = $stockActual - $cantidadS;

                // Actualizar el stock del producto en el inventario
                $actualizarInventario = $conexion->query("UPDATE inventario SET stock = '$stockFinal'  WHERE id_producto = '$key' ");

                // Calcular el subtotal para el producto
                $totaNum = intval($stock);
                $subtotal = $totaNum * $precio;

                // Crear una fila de tabla para la factura
                $productoNombre = $DATA['nombre_producto'];
                $facturaTable[] = '
                    <tr>
                        <td>' . $productoNombre . '</td>
                        <td>' . $precio . '</td>
                        <td>' . $stock . '</td>
                        <td>' . $subtotal . '</td>
                    </tr>
                ';

                // Insertar los detalles de la compra en la tabla "detalle_compra"
                $insertDetalleCompra = $conexion->query("INSERT INTO detalle_compra 
                (id_producto, cantidad, subtotal, idCompra) VALUES
                ('$key', '$stock', '$subtotal', '$idCompra')");

                // Eliminar los productos del carrito para este usuario
                $eliminar = $conexion->query("DELETE FROM carrito WHERE id_cliente = '$idUser'");

                // Vaciar los datos de la sesión del carrito
                unset($_SESSION['datosPedido']);
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

        echo json_encode($respuesta);

        // Requerir el archivo para enviar el correo electrónico
        require_once 'enviarCorreo.php';


    } else {
        echo 'Error al insertar la compra';
    }
}
?>