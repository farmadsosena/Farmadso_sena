<?php
session_start();
if (!isset($_SESSION['id'])) {
    if (!isset($_SESSION['id_invitado'])) {
       $idinvitado = $_SESSION['id_invitado'] = generarIDInvitadoUnico(); // Generar un ID único para el invitado si no hay sesión de usuario
    }
} else {
    $idUsuario = $_SESSION['id'];
}

function generarIDInvitadoUnico()
{
    $numero = rand(1, 5);
    $prefix = 'INVITADO_'; // Prefijo para identificar al invitado
    $uniqueID = $prefix . uniqid() . $numero; // Generar un identificador único
    return $uniqueID;
}

// Importar conexion y modelo contraentrega
require_once '../config/Conexion.php';
require_once '../models/contraEntregaModel.php';

// Definimos el espacio d
use contraentrega\ContraEntregaModel;

$conexion = new Conexion(); // Esto podría variar según tu configuración.

$contraentrega = new ContraEntregaModel($conexion->getConexion()); // Cambiado para 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $datos['nombre'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['nombre']);
    $datos['apellido'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['apellido']);
    $datos['direccion'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['direccion']);
    $datos['telefono'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['telefono']);
    $datos['correo'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['correo']);
    $datos['instrucciones'] = mysqli_real_escape_string($conexion->getConexion(), $_POST['instrucciones']);

    $valid = array();

    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['correo'])) {
        $valid['error'] = 'Complete todos los campos';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $_POST['nombre'])) {
        $valid['error'] = 'El nombre no debe contener números ni caracteres especiales.';
    } elseif (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $_POST['apellido'])) {
        $valid['error'] = 'El apellido no debe contener números ni caracteres especiales.';
    } elseif (empty($_POST['telefono'])) {
        $valid['error'] = 'El teléfono es obligatorio.';
    } elseif (!preg_match('/^\d{10}$/', $_POST['telefono'])) {
        $valid['error'] = 'El teléfono debe contener 10 dígitos.';
    } elseif (empty($_POST['correo'])) {
        $valid['error'] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
        $valid['error'] = 'El correo electrónico no tiene un formato válido.';
    }

    if (empty($valid['error'])) {

        $result = $contraentrega->registrarContraEntrega($datos, $_SESSION);
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
