<?php
session_start();
require_once('../config/Conexion.php');
$conexionDataBase = new Conexion();
$conexion = $conexionDataBase->Getconexion();

// Validamos si no existe sesion de cliente  #Trabajamos con el idsessionInvitado  

$idmedicamento = $_POST['idmedicamento'];
$cantidadProducto  = $_POST['cantidad'];
buscarProductoInventario($idmedicamento,$cantidadProducto);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $producto = [
        'idmedicamento' => $_POST['idmedicamento'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'cantidad' => $_POST['cantidadcarrito']
        // Otros detalles del producto
    ];

    // Verificar si el carrito existe en la sesión o crearlo si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = $producto;

    // Redirigir a la página de productos o a donde sea conveniente
    header("Location: productos.php");
    exit();
}
function buscarProductoInventario($idmedicamento, $cantidadProducto)
{

    global $conexion;
    $consulta_general =
        "SELECT inventario.stock, medicamentos.precio, inventario.imagendescrip
         FROM  inventario
         JOIN medicamentos ON inventario.idmedicamento = medicamentos.idmedicamento
         JOIN categoria ON inventario.idcategoria = categoria.idcategoria
         WHERE inventario.idmedicamento = '$idmedicamento'";

    $resultado = mysqli_query($conexion, $consulta_general);
    $resultado_consult = mysqli_fetch_assoc($resultado);
    $candidadStock = $resultado_consult['stock'];
    $precio = $resultado_consult['precio'];
    $imagen = $resultado_consult['imagendescrip'];
    $costoTotal = $cantidadProducto * $precio;


    if ($cantidadProducto > $candidadStock) {

        // En caso de que no haya suficiente stock en inventario del producto seleccionado
        echo json_encode('nostock');
    } else {

        // Llamamos a la función para consultar productos del carrito
        $stateCart = cartQuery($idmedicamento);

        // Validamos el resultado de la funcion cartQuery()
        $state = ($stateCart === null) ? insertCart($idmedicamento, $cantidadProducto, $costoTotal, $imagen) : updateCart($idmedicamento, $cantidadProducto, $costoTotal, $imagen);
    }
}
function cartQuery($idmedicamento)
{
    global $conexion;
    // Validar la session que este activa  Usuario/Invitado
    if (isset($_SESSION['sessionId'])) {

        $idSession = $_SESSION['sessionId'];
        $consulta = $conexion->query("SELECT id_carrito, cantidadcarrito, precio FROM carrito WHERE idsession = '$idSession' AND idmedicamento = '$idmedicamento'");

        if ($consulta->num_rows > 0) {
            $data = $consulta->fetch_assoc();
            return $data;
        } else {
            return null;
        }
    } else if (isset($_SESSION['idusuario'])) {

        $idusuario = $_SESSION['idusuario'];
        $consulta = $conexion->query("SELECT id_carrito, cantidad, precio FROM carrito WHERE idusuario = '$idusuario' AND idmedicamento = '$idmedicamento'");

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

    $idUser = (isset($_SESSION['sessionId'])) ? $data = array('sessionId' => $_SESSION['sessionId']) : ((isset($_SESSION['idusuario'])) ? $data = array('idusuario' => $_SESSION['idusuario']) : null);

    return $idUser;
}


function insertCart($idmedicamento, $stock, $img)
{

    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['sessionId'])) ? $idUser['sessionId'] : ((isset($idUser['idusuario'])) ? $idUser['idusuario'] : null);

    // Generar tipo de consulta INSERT apartir de la session
    $userType = (isset($idUser['sessionId'])) ?

        //  Insertar si es invitado
        $insertCart = $conexion->query("INSERT INTO carrito (idusuario, idmedicamento, cantidadcarrito,  idinvitado)
    VALUES (null, '$idmedicamento', '$stock', '$idUserBd')")

        // Insertar si es cliente
        : $insertCart = $conexion->query("INSERT INTO carrito(idusuario, idmedicamento, cantidadcarrito,idinvitado)
    VALUES ('$idUserBd', '$idmedicamento', '$stock', null)");

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

function updateCart($idmedicamento, $cantidad, $amount, $img)
{

    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['sessionId'])) ? $idUser['sessionId'] : ((isset($idUser['idusuario'])) ? $idUser['idusuario'] : null);

    // Generar tipo de consulta UPDATE apartir de la session
    if (isset($idUser['sessionId'])) {

        //  Actualizar el carrito si es invitado / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT   idmedicamento, cantidadcarrito, precio FROM carrito 
        WHERE idmedicamento  = '$idmedicamento' and idsession = '$idUserBd'
        ");
        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['precio']);
            $cantidadBd = intval($cartArticle['cantidadcarrito']);
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidad;
            $conexion->query("UPDATE  carrito  SET cantidadcarrito ='$newCantidad', precio = '$newAmount' 
            WHERE  idmedicamento = '$idmedicamento'  and idsession = '$idUserBd'
            ");
        }
    } else if (isset($idUser['idusuario'])) {


        //  Actualizar el carrito si es Usuario / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT  carrito.cantidad, carrito.idmedicamento, inventario.stock AS cantidadBodega, carrito.preciototal 
        INNER JOIN inventario ON carrito.idmedicamento  = inventario.idmedicamento
        WHERE idmedicamento  = '$idmedicamento' and idusuario = '$idUserBd'
        ");
        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['precio']);
            $cantidadBd = intval($cartArticle['cantidad']);
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidad;
            $conexion->query("UPDATE  carrito  SET cantidadcarrito ='$newCantidad', precio = '$newAmount' 
            WHERE  idmedicamento = '$idmedicamento'  and idusuario = '$idUserBd'
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
