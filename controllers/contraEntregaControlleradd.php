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

    

    $datos['nombre'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['nombre'] ?? '');
    $datos['apellido'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['apellido'] ?? '');
    $datos['direccion'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['direccion'] ?? '');
    $datos['telefono'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['telefono'] ?? '');
    $datos['correo'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['correo'] ?? '');
    $datos['instrucciones'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['instrucciones'] ?? '');

    $validacion = validarDatos($datos);

    if (empty($validacion)) {
        $resultado = $contraentrega->registrarContraEntrega($datos);

        if ($resultado !== false) {
            $mensaje = $resultado === null ? 'Tus datos ya fueron registrados' : 'Registro exitoso';
            echo json_encode(['status' => true, 'message' => $mensaje]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Ocurrió un problema al registrar los datos']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => $validacion]);
    }
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
    }

    return empty($valid['error']) ? '' : $valid['error'];
}
