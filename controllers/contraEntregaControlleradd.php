<?php
session_start();
require_once '../config/Conexion.php';
require_once '../models/contraEntregaModel.php';

use contraentrega\ContraEntregaModel;

$conexion = new Conexion();

$contraentrega = new ContraEntregaModel($conexion->getConexion());

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $datos = [];

    if (isset($_SESSION['id'])) {
        $datos['idusuario'] = $_SESSION['id'];
    } elseif (isset($_SESSION['idinvitado'])) {
        $datos['idinvitado'] = $_SESSION['idinvitado'];
    } else {
        echo json_encode(['error' => 'No se proporcionó un ID de usuario o de invitado']);
        exit();
    }

    $datos['subtotal'] = $_SESSION['subtotal'];
    $datos['nombre'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['nombre']);
    $datos['apellido'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['apellido']);
    $datos['direccion'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['direccion']);
    $datos['telefono'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['telefono']);
    $datos['correo'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['correo']);
    $datos['instrucciones'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['instrucciones']);

    $validacion = validarDatos($datos);

    $response = []; // Objeto para almacenar la respuesta final

    if (empty($validacion)) {
        $resultado = $contraentrega->registrarContraEntrega($datos);

        if ($resultado !== false) {
            $mensaje = $resultado === null ? 'Tu pedido ya fue registrado' : 'pedido exitoso';
            $response['status'] = true;
            $response['message'] = $mensaje;
            $idCompra = $_SESSION['idcompraContraentrega'];
            $response['idcompra'] =$idCompra ;
            unset($_SESSION['idcompraContraentrega']);
        } else {
            $response['status'] = false;
            $response['message'] = 'Ocurrió un problema al registrar los datos';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = $validacion;
    }

    echo json_encode($response);
}

function validarDatos($datos)
{
    $valid = [];
    if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['direccion']) || empty($datos['telefono']) || empty($datos['correo'])) {
        $valid['error'] = 'Complete todos los campos';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $datos['nombre'])) {
        $valid['error'] = 'El nombre no debe contener números ni caracteres especiales.';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $datos['apellido'])) {
        $valid['error'] = 'El apellido no debe contener números ni caracteres especiales.';
    } elseif (empty($datos['telefono'])) {
        $valid['error'] = 'El teléfono es obligatorio.';
    } elseif (!preg_match('/^\d{10}$/', $datos['telefono'])) {
        $valid['error'] = 'El teléfono debe contener 10 dígitos.';
    } elseif (empty($datos['correo'])) {
        $valid['error'] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
        $valid['error'] = 'El correo electrónico no tiene un formato válido.';
    } elseif($_SESSION['medicamentos'] === []){
        $valid['error'] = 'no hay medicamentos existentes';
    } elseif($_SESSION['medicamentos'] > $_SESSION['stock']){
        $valid['error'] = 'no hay medicamentos disponibles';
    }
    return empty($valid['error']) ? '' : $valid['error'];
}

