<?php

require_once '../config/Conexion.php';
require_once '../models/contraEntregaModel.php';

use contraentrega\ContraEntregaModel;

$response = array();

if (isset($_POST['realizarcompra'])) {

    $contraentrega = new ContraEntregaModel($conexion);

    $datos['nombre'] = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $datos['apellido'] = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $datos['direccion'] = mysqli_real_escape_string($conexion, $_POST['direccion']);
    $datos['ciudad'] = mysqli_real_escape_string($conexion, $_POST['ciudad']);
    $datos['codigo_postal'] = mysqli_real_escape_string($conexion, $_POST['codigo_postal']);
    $datos['telefono'] = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $datos['correo'] = mysqli_real_escape_string($conexion, $_POST['correo']);
    $datos['instrucciones'] = mysqli_real_escape_string($conexion, $_POST['instrucciones']);

if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['direccion']) || empty($datos['ciudad']) || empty($datos['codigo_postal']) || empty($datos['telefono']) || empty($datos['correo']) || empty($datos['instrucciones'])){
    $response['error'] = 'complete todos los campos';
}
$result = $contraentrega->registrarContraEntrega($datos);
$response = ($result) ? true : (($result === null) ? null : false);
$message = match($response) {
    true => 'Contraentrega registrada con éxito.',
    null => 'tus datos ya fueron registrados',
    false => 'Paso algo'
};
$response = array(
    'status' => $response,
    'message' => $message
);
echo json_encode($response);


}
?>
