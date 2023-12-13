<?php
session_start();
require_once "../config/Conexion.php";

// Validar usuario
function userValidate()
{

    $idUser = (isset($_SESSION['idinvitado'])) ? $data = array('sessionId' => $_SESSION['idinvitado']) : ((isset($_SESSION['id'])) ? $data = array('id_cliente' => $_SESSION['id']) : null);

    return $idUser;
}

// Verificar si un usuario ha iniciado sesión (identificado por 'id_cliente' en la sesión)

$idUserSession = userValidate();

// Inicialmente, asignamos null a $idUserBd.
$idUserBd = null;

// Verificamos si existe 'sessionId' en $idUserSession, si es cierto, asignamos su valor a $idUserBd.
if (isset($idUserSession['sessionId'])) {
    $idUserBd = $idUserSession['sessionId'];
}
// Si 'sessionId' no existe, verificamos si existe 'id_cliente' en $idUserSession, y si es cierto, asignamos su valor a $idUserBd.
elseif (isset($idUserSession['id_cliente'])) {
    $idUserBd = $idUserSession['id_cliente'];
}



if (!empty($idUserSession['sessionId'])) {
    $consultaCarrito = "SELECT * FROM carrito WHERE idinvitado = '$idUserBd'";
} elseif (!empty($idUserSession['id_cliente'])) {
    $id = $idUserSession['id_cliente'];
    $consultaCarrito = "SELECT * FROM carrito WHERE carrito.idusuario = '$id'";
} else {
    $consultaCarrito = null;
}



$resultadoCarrito = mysqli_query($conexion, $consultaCarrito);
$cantidad_carrito = mysqli_num_rows($resultadoCarrito);
if ($cantidad_carrito === 0) {
    $response = "nohay";
} else {
    $response = array(
        "cantidad_carrito" => $cantidad_carrito
    );
}

echo json_encode($response);
