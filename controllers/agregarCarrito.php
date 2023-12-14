<?php
session_start();

require_once('../config/Conexion.php');
$conexionDataBase = new Conexion();
$conexion = $conexionDataBase->Getconexion();

// Validamos si no existe sesion de cliente  #Trabajamos con el idsessionInvitado  
// $idinvitado = $POST['idinvitado'];
$precio = $_POST['precio'];
$idmedicamento = $_POST['idmedicamento'];
$cantidadProducto  = $_POST['cantidadcarrito'];
buscarProductoInventario($idmedicamento, $cantidadProducto);


function buscarProductoInventario($idmedicamento, $cantidadProducto)
{
    global $conexion;
    $consulta_general = "SELECT inventario.stock, medicamentos.precio
         FROM  inventario
         JOIN medicamentos ON inventario.idmedicamento = medicamentos.idmedicamento
         JOIN categoria ON inventario.idcategoria = categoria.idcategoria
         WHERE inventario.idmedicamento = '$idmedicamento'";

    $resultado = mysqli_query($conexion, $consulta_general);
    $resultado_consult = mysqli_fetch_assoc($resultado);
    $candidadStock = $resultado_consult['stock'];
    $precio = $resultado_consult['precio'];


    $costoTotal = $cantidadProducto * $precio;


    if ($candidadStock <= 0) {
        echo json_encode('agotado');
    }elseif ($cantidadProducto > $candidadStock) {
        // En caso de que no haya suficiente stock en inventario del producto seleccionado
        echo json_encode('nostock');
    } else {
        // Llamamos a la función para consultar productos del carrito
        $stateCart = cartQuery($idmedicamento);
        // Validamos el resultado de la funcion cartQuery()
        $state = ($stateCart === null) ? insertCart($idmedicamento, $cantidadProducto, $costoTotal) : updateCart($idmedicamento, $cantidadProducto, $costoTotal);
    }
}
function cartQuery($idmedicamento)
{
    global $conexion;
    // Validar la session que este activa  Usuario/Invitado
    if (isset($_SESSION['idinvitado'])) {

        $idSession = $_SESSION['idinvitado'];
        $consulta = $conexion->query("SELECT idcarrito, cantidadcarrito, precio FROM carrito WHERE idinvitado = '$idSession' AND idmedicamento = '$idmedicamento'");

        if ($consulta->num_rows > 0) {
            $data = $consulta->fetch_assoc();
            return $data;
        } else {
            return null;
        }
    } elseif (isset($_SESSION['id'])) {
        $idusuario = $_SESSION['id'];
        $consulta = $conexion->query("SELECT idcarrito, cantidadcarrito, precio FROM carrito WHERE idusuario = '$idusuario' AND idmedicamento = '$idmedicamento'");

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
    $idUser = (isset($_SESSION['idinvitado'])) ? $data = array('idinvitado' => $_SESSION['idinvitado']) : ((isset($_SESSION['id'])) ? $data = array('id' => $_SESSION['id']) : null);
    return $idUser;
}

function insertCart($idmedicamento, $cantidadProducto, $precio,)
{
    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['idinvitado'])) ? $idUser['idinvitado'] : ((isset($idUser['id'])) ? $idUser['id'] : null);
    // Generar tipo de consulta INSERT apartir de la session
    $userType = (isset($idUser['idinvitado'])) ?
        //  Insertar si es invitado
        $insertCart = $conexion->query("INSERT INTO carrito (idusuario, idmedicamento, cantidadcarrito,  idinvitado,precio)
                                        VALUES (null, '$idmedicamento', '$cantidadProducto', '$idUserBd','$precio')")
        // Insertar si es cliente
        : $insertCart = $conexion->query("INSERT INTO carrito(idusuario, idmedicamento, cantidadcarrito,idinvitado,precio)
                                    VALUES ('$idUserBd', '$idmedicamento', '$cantidadProducto', null,'$precio')");

    // Si no existe un registro, insertar un nuevo registro en el carrito

    $data = array(
        'correcto' => 'medicamento añadido al carrito'
    );
    echo json_encode($data);
}

function updateCart($idmedicamento, $cantidadProducto, $amount)
{

    global $conexion;
    // Obtener el id de la session activa 
    $idUser = userValidate();
    $idUserBd = (isset($idUser['idinvitado'])) ? $idUser['idinvitado'] : ((isset($idUser['id'])) ? $idUser['id'] : null);
    // var_dump($idUserBd['id']);

    // Generar tipo de consulta UPDATE apartir de la session
    if (isset($idUser['idinvitado'])) {

        //  Actualizar el carrito si es invitado / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT   carrito.idmedicamento, carrito.cantidadcarrito, carrito.precio, inventario.stock FROM carrito 
        INNER JOIN inventario ON carrito.idmedicamento = inventario.idmedicamento
        WHERE carrito.idmedicamento  = '$idmedicamento' and carrito.idinvitado = '$idUserBd'
        ");
        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['precio']);
            $cantidadBd = intval($cartArticle['cantidadcarrito']);
            $stock_inventario = $cartArticle['stock'];
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidadProducto;
            if($newCantidad > $stock_inventario){
                echo json_encode('nostock');
                exit();
            }
            $conexion->query("UPDATE carrito SET cantidadcarrito = '$newCantidad', precio = '$newAmount' 
            WHERE  idmedicamento = '$idmedicamento'  and idinvitado = '$idUserBd'
            ");
        }
    } else if (isset($idUser['id'])) {
        //  Actualizar el carrito si es Usuario / primero consultamos si existe ese producto 
        $queryCart = $conexion->query("SELECT  carrito.cantidadcarrito, carrito.idmedicamento, inventario.stock AS cantidadBodega, carrito.precio 
        FROM carrito
        INNER JOIN inventario ON carrito.idmedicamento  = inventario.idmedicamento
        WHERE carrito.idmedicamento  = '$idmedicamento' and carrito.idusuario = '$idUserBd'
        ");


        if ($queryCart->num_rows > 0) {

            $cartArticle = $queryCart->fetch_assoc();
            $amountBd = floatval($cartArticle['precio']);
            $cantidadBd = intval($cartArticle['cantidadcarrito']);
            $stock_inventario = $cartArticle['stock'];
            $newAmount = $amount + $amountBd;
            $newCantidad = $cantidadBd + $cantidadProducto;
            if($newCantidad > $stock_inventario){
                echo json_encode('nostock');
                exit();
            }
            $conexion->query("UPDATE  carrito  SET cantidadcarrito ='$newCantidad', precio = '$newAmount' 
            WHERE  idmedicamento = '$idmedicamento'  and idusuario = '$idUserBd'
            ");
        }
    }


    $data = array(
        'correcto' => 'medicamento actualizado en carrito'
    );

    echo json_encode($data);
}
// Cerrar la conexión a la base de datos
$conexion->close();
