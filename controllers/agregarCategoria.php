<?php
require_once '../config/Conexion.php';

// Crear un arreglo para almacenar la respuesta JSON
$response = array();

// Verificar si se enviaron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y escapar datos del formulario
    $nombrecategoria = htmlspecialchars($_POST["nombrecategoria"], ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

    // Ejecutar la consulta INSERT de forma segura
    $query = "INSERT INTO categoria (nombrecategoria, descripcion) VALUES (?, ?)";
    $statement = $conexion->prepare($query);

    // Intentar ejecutar la consulta preparada
    if ($statement->execute([$nombrecategoria, $descripcion])) {
        // Inserción exitosa
        $response['status'] = true;
        $response['message'] = 'El registro se agregó correctamente a la categoría';
    } else {
        // Error al insertar datos
        $response['status'] = false;
        $response['message'] = 'Error al insertar datos:';
    }
} else {
    // Si no se enviaron datos por POST, proporcionar un mensaje de error
    $response['status'] = false;
    $response['message'] = 'No se enviaron datos por POST';
}

// Establecer la cabecera de respuesta como JSON
header('Content-Type: application/json');

// Imprimir la respuesta JSON
echo json_encode($response);
