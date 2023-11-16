<?php
require_once '../config/Conexion.php';
require_once '../models/contraEntregaModel.php';

use contraentrega\registrarContraEntrega;
use contraentrega\ContraEntregaModel;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['realizarcompra']) {
    $conexion = new Conexion(); // Esto podría variar según tu configuración.

    $contraentrega = new ContraEntregaModel($conexion->getConexion()); // Cambiado para 

    $datos['nombre'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['nombre']);
    $datos['apellido'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['apellido']);
   
    $datos['telefono'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['telefono']);
    $datos['correo'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['correo']);
    $datos['direccion'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['direccion']);

    $datos['instrucciones'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['instrucciones']);

    $valid = array();

    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion'])  || empty($_POST['telefono']) || empty($_POST['correo'])) {
        $valid['error'] = 'Complete todos los campos';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $_POST['nombre'])) {
        $valid['error'] = 'El nombre no debe contener números ni caracteres especiales.';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $_POST['apellido'])) {
        $valid['error'] = 'El apellido no debe contener números ni caracteres especiales.';
    } elseif (empty($_POST['codigo'])) {
        $valid['error'] = 'El código postal es obligatorio.';
    } elseif (!preg_match('/^\d{5}$/', $_POST['codigo'])) {
        $valid['error'] = 'El código postal debe contener 5 dígitos.';
    } elseif (empty($_POST['telefono'])) {
        $valid['error'] = 'El teléfono es obligatorio.';
    } elseif (!preg_match('/^\d{10}$/', $_POST['telefono'])) {
        $valid['error'] = 'El teléfono debe contener 10 dígitos.';
    } elseif (empty($_POST['correo'])) {
        $valid['error'] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        $valid['error'] = 'El correo electrónico no tiene un formato válido.';
    }


    $address = $datos['direccion'];
    $api_key = 'AIzaSyARqXhqVZfBQNW43eJ1fHsyMdq3cUjYRS8';

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $api_key;
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    
    if (empty($valid['error'])) {
        $result = $contraentrega->registrarContraEntrega($datos,$data);
        $response = ($result) ? true : (($result === null) ? null : false);
        $message = match ($response) {
            true => 'registro éxitoso.',
            null => 'Tus datos ya fueron registrados',
            false => 'Ocurrió un problema',
        };
        if ($response === true) {
            $response = array(
                'status' => true,
                'message' => $message,
            );
        } else if ($response === null) {
            $response = array(
                'status' => null,
                'message' => $message,
            );
        }
        echo json_encode($response);
    } else {
        $response = array(
            'status' => 'error',
            'message' => $valid['error'],
            'error' => $valid['error'],
        );
        echo json_encode($response);
    }
    
}
