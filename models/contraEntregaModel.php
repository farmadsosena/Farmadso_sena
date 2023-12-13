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
            $query = "INSERT INTO compra (fecha, total, idestadocompra, direccion, nombre, apellido, telefono, correo, idtipopago, idusuario, idinvitado, instrucciones) VALUES (?,?,?,?,?,?,?,?,?,?,NULL,?)";
            $stmt = $this->conexion->prepare($query);
        } elseif (isset($_SESSION['idinvitado'])) {
            $idinvitado = $_SESSION['idinvitado'];
            $query = "INSERT INTO compra (fecha, total, idestadocompra, direccion, nombre, apellido, telefono, correo, idtipopago, idusuario, idinvitado, instrucciones) VALUES (?,?,?,?,?,?,?,?,?,NULL,?,?)";
            $stmt = $this->conexion->prepare($query);
        } else {
            return false; // Manejar el caso en el que no haya una sesión válida
        }
    
        $estadoCompra = 1; // Reemplazar con el valor correcto de estado de compra
        $tipoPago = 3; // Reemplazar con el valor correcto de tipo de pago
    
        $stmt->bind_param("siisssissis", $fecha_formateada, $subtotal, $estadoCompra, $direccion, $nombre, $apellido, $telefono, $email, $tipoPago, $idusuario,$instrucciones);
    
        if (isset($idinvitado)) {
            $stmt->bind_param("siissssssss", $fecha_formateada, $subtotal, $estadoCompra, $direccion, $nombre, $apellido, $telefono, $email, $tipoPago, $idinvitado, $instrucciones);
        }
    
        if ($stmt->execute()) {
            $idcompra = $this->conexion->insert_id;
            $_SESSION['idcompraContraentrega'] = $idcompra;
            
            $productos = $_SESSION['medicamentos'];
            foreach ($productos as $key => $stock) {
                $data = $this->conexion->query("SELECT medicamentos.precio, inventario.stock, medicamentos.nombre FROM medicamentos INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$key'");
    
                if ($data) {
                    $DATA = $data->fetch_assoc();
                    $precio = intval($DATA['precio']);
                    $stockActual = intval($DATA['stock']);
                     
                    $cantidadS = intval($stock);
                    $stockFinal = $stockActual - $cantidadS;
    
                    $actualizarInventario = $this->conexion->query("UPDATE inventario SET stock = '$stockFinal' WHERE idmedicamento = '$key'");
    
                    $totaNum = intval($stock);
                    $subtotalProducto = $totaNum * $precio;
    
                    $insertDetalleCompra = $this->conexion->query("INSERT INTO detallecompra (idcompra, idmedicamento, cantidad, preciototal) VALUES ('$idcompra', '$key', '$stock', '$subtotalProducto')");
    
                    // Eliminar productos del carrito para este usuario o invitado
                    if (isset($idusuario)) {
                        $eliminar = $this->conexion->query("DELETE FROM carrito WHERE idusuario = '$idusuario'");
                    } elseif (isset($idinvitado)) {
                        $eliminar = $this->conexion->query("DELETE FROM carrito WHERE idinvitado = '$idinvitado'");
                    }
    
                    unset($_SESSION['medicamentos']);
                    unset($_SESSION['subtotal']);
                } else {
                    echo 'Error al obtener datos del producto';
                    exit;
                }
            }
    
            require_once 'enviarCorreoContraentrega.php';
            // Resto del código para enviar correo, limpiar datos de sesión, etc.
        } else {
            echo 'Error al insertar el pedido';
        }
    
        $stmt->close();
        return true;
    }
    

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
