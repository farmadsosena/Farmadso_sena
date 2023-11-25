<?php
include('../config/Conexion.php');

session_start();
// Consulta SQL para obtener el recuento de usuarios
$query = 'SELECT COUNT(*) AS count FROM carrito WHERE idusuario =';
$result = $conexion->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];
    // Devolver el recuento de usuarios en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['count' => $count]);
} else {
    echo 'No se encontraron productos';
}

// Cerrar la conexión a la base de datos
$conexion->close();
