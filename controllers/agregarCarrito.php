<?php
session_start();
require_once('../models/conexion.php');
$conexionDataBase = new Conexion();
$conexion = $conexionDataBase->Getconexion();

// Validamos si no existe sesion de cliente  #Trabajamos con el idsessionInvitado  

$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
buscarProductoInventario($id_producto, $cantidad);

function buscarProductoInventario($id_producto, $cantidadProducto)
{

    global $conexion;
    $consulta_general =
        "SELECT inventario.stock, inventario.valor, inventario.imagen
         FROM  inventario
         JOIN producto ON inventario.id_producto = producto.id_producto
         JOIN categoria ON inventario.id_categoria = categoria.id_categoria
         WHERE inventario.id_producto = '$id_producto'";

    $resultado = mysqli_query($conexion, $consulta_general);
    $resultado_consult = mysqli_fetch_assoc($resultado);
    $candidadStock = $resultado_consult['stock'];
    $precio = $resultado_consult['valor'];
    $imagen = $resultado_consult['imagen'];
    $costoTotal = $cantidadProducto * $precio;


    if ($cantidadProducto > $candidadStock) {

        // En caso de que no haya suficiente stock en inventario del producto seleccionado
        echo json_encode('nostock');

    } else {

        // Llamamos a la función para consultar productos del carrito
        $stateCart = cartQuery($id_producto);

        // Validamos el resultado de la funcion cartQuery()
        $state = ($stateCart === null) ? insertCart($id_producto, $cantidadProducto, $costoTotal, $imagen) : updateCart($id_producto, $cantidadProducto, $costoTotal, $imagen);

    }
}
function cartQuery($id_producto)
{
    global $conexion;
    // Validar la session que este activa  Usuario/Invitado
    if (isset($_SESSION['sessionId'])) {

        $idSession = $_SESSION['sessionId'];
        $consulta = $conexion->query("SELECT id_carrito, cantidad, preciototal FROM carrito WHERE idsession = '$idSession' AND id_producto = '$id_producto'");

        if ($consulta->num_rows > 0) {
            $data = $consulta->fetch_assoc();
            return $data;
        } else {
            return null;
        }

    } else if (isset($_SESSION['id_cliente'])) {

        $id_cliente = $_SESSION['id_cliente'];
        $consulta = $conexion->query("SELECT id_carrito, cantidad, preciototal FROM carrito WHERE id_cliente = '$id_cliente' AND id_producto = '$id_producto'");

        if ($consulta->num_rows > 0) {
            $data = $consulta->fetch_assoc();
            return $data;
        } else {
            return null;
        }
    }
}

function userValidate()
{

    $idUser = (isset($_SESSION['sessionId'])) ? $data = array('sessionId' => $_SESSION['sessionId']) :
        ((isset($_SESSION['id_cliente'])) ? $data = array('id_cliente' => $_SESSION['id_cliente']) : null);

    return $idUser;
}


function insertCart($id_producto, $stock, $value, $img)
{

    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['sessionId'])) ? $idUser['sessionId'] :
        ((isset($idUser['id_cliente'])) ? $idUser['id_cliente'] : null);

    // Generar tipo de consulta INSERT apartir de la session
    $userType = (isset($idUser['sessionId'])) ?

        //  Insertar si es invitado
        $insertCart = $conexion->query("INSERT INTO carrito (id_cliente, id_producto, cantidad, preciototal, idsession)
    VALUES (null, '$id_producto', '$stock','$value', '$idUserBd')")

        // Insertar si es cliente
        : $insertCart = $conexion->query("INSERT INTO carrito (id_cliente, id_producto, cantidad, preciototal, idsession)
    VALUES ('$idUserBd', '$id_producto', '$stock','$value', null)");

    // Si no existe un registro, insertar un nuevo registro en el carrito


    $modificarRuta = '../';
    if (strpos($img, $modificarRuta) === 0) {
        $imagen = str_replace($modificarRuta, '', $img);
    }
    $data = array(
        'correcto' => $imagen
    );

    echo json_encode($data);
}

function updateCart($id_producto, $cantidad, $amount, $img)
{

    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['sessionId'])) ? $idUser['sessionId'] :
        ((isset($idUser['id_cliente'])) ? $idUser['id_cliente'] : null);

    // Generar tipo de consulta UPDATE apartir de la session
    if (isset($idUser['sessionId'])) {

        //  Actualizar el carrito si es invitado / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT  cantidad, id_producto, cantidad, preciototal FROM carrito 
        WHERE id_producto  = '$id_producto' and idsession = '$idUserBd'
        ");
        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['preciototal']);
            $cantidadBd = intval($cartArticle['cantidad']);
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidad;
            $conexion->query("UPDATE  carrito  SET cantidad ='$newCantidad', preciototal = '$newAmount' 
            WHERE  id_producto = '$id_producto'  and idsession = '$idUserBd'
            ");
        }

    } else if (isset($idUser['id_cliente'])) {


        //  Actualizar el carrito si es Usuario / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT  carrito.cantidad, carrito.id_producto, inventario.stock AS cantidadBodega, carrito.preciototal 
        INNER JOIN inventario ON carrito.id_producto  = inventario.id_producto
        WHERE id_producto  = '$id_producto' and id_cliente = '$idUserBd'
        ");
        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['preciototal']);
            $cantidadBd = intval($cartArticle['cantidad']);
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidad;
            $conexion->query("UPDATE  carrito  SET cantidad ='$newCantidad', preciototal = '$newAmount' 
            WHERE  id_producto = '$id_producto'  and id_cliente = '$idUserBd'
            ");
        }


    }

    // Si no existe un registro, insertar un nuevo registro en el carrito

    $modificarRuta = '../';
    if (strpos($img, $modificarRuta) === 0) {
        $imagen = str_replace($modificarRuta, '', $img);
    }
    $data = array(
        'correcto' => $imagen
    );

    echo json_encode($data);
}
// Cerrar la conexión a la base de datos
$conexion->close();
?>