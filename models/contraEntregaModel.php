<?php
namespace contraentrega;

require_once '../config/Conexion.php';

class ContraEntregaModel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrarContraEntrega($datos)
    {
 
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $direccion = $datos['direccion'];
        $telefono = $datos['telefono'];
        $email = $datos['correo'];
        $instrucciones = $datos['instrucciones'];
        $fecha_formateada = date('Y-m-d H:i:s');
        $subtotal = $datos['subtotal'];
        $stmt = null;

        if (isset($_SESSION['id'])) {
            $idusuario = $_SESSION['id'];
            $query = "INSERT INTO compra (fecha, total,idestadocompra, direccion,nombre, apellido,telefono,correo,idtipopago, idusuario, idinvitado, instrucciones) VALUES (?,?,?,?,?,?,?,?,?,?,NULL,?)";
            $stmt = $this->conexion->prepare($query);
            $estadoCompra = 1; // Reemplaza esto con el valor correcto de estado de compra
            $tipoPago = 3; // Reemplaza esto con el valor correcto de tipo de pago
            $stmt->bind_param("siisssissis", $fecha_formateada, $subtotal, $estadoCompra, $direccion, $nombre, $apellido, $telefono, $email, $tipoPago, $idusuario, $instrucciones);

            // Inicializar un array para almacenar las filas de la tabla de la factura
            $facturaTable = [];

            if ($stmt->execute()) {
                $idcompra = $this->conexion->insert_id;
          
                $_SESSION['idcompraContraentrega'] = $idcompra;
                // Obtener los productos del carrito desde los datos de la sesión
                $productos = $_SESSION['medicamentos'];
                foreach ($productos as $key => $stock) {
                    // Obtener la información del producto desde la base de datos
                    $data = $this->conexion->query("SELECT medicamentos.precio, inventario.stock, medicamentos.nombre FROM medicamentos INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$key'");

                    if ($data) {
                        // Extraer los detalles del producto desde el resultado de la base de datos
                        $DATA = $data->fetch_assoc();
                        $precio = intval($DATA['precio']);
                        $stockActual = intval($DATA['stock']);
                        $cantidadS = intval($stock);
                        $stockFinal = $stockActual - $cantidadS;

                        // Actualizar el stock del producto en el inventario
                        $actualizarInventario = $this->conexion->query("UPDATE inventario SET stock = '$stockFinal' WHERE idmedicamento = '$key'");

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
                        // Insertar los detalles de la compra en la tabla "detalle_pedido"
                        $insertDetalleCompra = $this->conexion->query("INSERT INTO detallecompra 
                (idcompra,idmedicamento,cantidad,preciototal) VALUES
                ('$idcompra','$key', '$stock', '$subtotal')");
                        // Eliminar los productos del carrito para este usuario
                        $eliminar = $this->conexion->query("DELETE FROM carrito WHERE idusuario = '$idusuario'");

                        // Vaciar los datos de la sesión del carrito
                        unset($_SESSION['medicamentos']);
                        unset($_SESSION['subtotal']);
                       
                    } else {
                        echo 'Error al obtener datos del producto';
                        exit;
                    }
                }

                // Almacenar los datos de la tabla de la factura en una variable
                $DATA_ALL = $facturaTable;

                // $respuesta = array(
                //     'success' => true,
                // );
                // Imprimir una respuesta de éxito en formato JSON

                // Requerir el archivo para enviar el correo electrónico
                require_once 'enviarCorreoContraentrega.php';

                // $respuesta = array(
                //     'success' => true,
                // );
                // echo json_encode($respuesta);
            } else {
                echo 'Error al insertar el pedido';
            }


        } elseif (isset($_SESSION['idinvitado'])) {
            $idinvitado = $_SESSION['idinvitado'];
            $query = "INSERT INTO compra (fecha,total,idestadocompra, direccion,nombre, apellido,telefono,correo,idtipopago, idusuario,idinvitado,instrucciones) VALUES (?,?,?,?,?,?,?,?,?,NULL,?,?)";
            $stmt = $this->conexion->prepare($query);
            $estadoCompra = 1; // Reemplaza esto con el valor correcto de estado de compra
            $tipoPago = 3; // Reemplaza esto con el valor correcto de tipo de pago
            $stmt->bind_param("siissssssss", $fecha_formateada, $subtotal, $estadoCompra, $direccion, $nombre, $apellido, $telefono, $email, $tipoPago, $idinvitado, $instrucciones);

            $facturaTable = [];

            if ($stmt->execute()) {
                $idcompra = $this->conexion->insert_id;

                $_SESSION['idcompraContraentrega'] = $idcompra;
                // Obtener los productos del carrito desde los datos de la sesión
                $productos = $_SESSION['medicamentos'];
                foreach ($productos as $key => $stock) {
                    // Obtener la información del producto desde la base de datos
                    $data = $this->conexion->query("SELECT medicamentos.precio, inventario.stock, medicamentos.nombre FROM medicamentos INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$key'");

                    if ($data) {
                        // Extraer los detalles del producto desde el resultado de la base de datos
                        $DATA = $data->fetch_assoc();
                        $precio = intval($DATA['precio']);
                        $stockActual = intval($DATA['stock']);
                        $cantidadS = intval($stock);
                        $stockFinal = $stockActual - $cantidadS;

                        // Actualizar el stock del producto en el inventario
                        $actualizarInventario = $this->conexion->query("UPDATE inventario SET stock = '$stockFinal'  WHERE idmedicamento = '$key' ");

                        // Calcular el subtotal para el producto
                        $totaNum = intval($stock);
                        $subtotal = $totaNum * $precio;

                        // Crear una fila de tabla para la factura
                        $productoNombre = $DATA['nombre'];
                        $facturaTable[] = '<tr>
                            <td>' . $productoNombre . '</td>
                            <td>' . $precio . '</td>
                            <td>' . $stock . '</td>
                            <td>' . $subtotal . '</td>
                        </tr>';

                        // Insertar los detalles de la compra en la tabla "detalle_compra"
                        $insertDetalleCompra = $this->conexion->query("INSERT INTO detallecompra 
                (idcompra,idmedicamento,cantidad,preciototal) VALUES
                ('$idcompra','$key', '$stock', '$subtotal')");

                        // Eliminar los productos del carrito para este usuario
                        $eliminar = $this->conexion->query("DELETE FROM carrito WHERE idinvitado = '$idinvitado'");

                        // Vaciar los datos de la sesión del carrito
                        unset($_SESSION['medicamentos']);
                    } else {
                        echo 'Error al obtener datos del producto';
                        exit;
                    }
                }

                // Almacenar los datos de la tabla de la factura en una variable
                $DATA_ALL = $facturaTable;

                // $respuesta = array(
                //     'success' => true,

                // );
                // Imprimir una respuesta de éxito en formato JSON

                // Requerir el archivo para enviar el correo electrónico
                require_once 'enviarCorreoContraentrega.php';

                // $respuesta = array(
                //     'success' => true,
                // );
                // echo json_encode($respuesta);
            } else {
                echo 'Error al insertar el pedido';
            }



        } else {
            return false; // Manejar el caso en el que no haya una sesión válida
        }


        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
