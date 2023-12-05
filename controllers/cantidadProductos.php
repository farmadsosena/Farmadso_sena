<?php
session_start();
include('../config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Inicia la sesión
    
    $id = '';
    // Verifica si se ha enviado el ID de usuario o de invitado
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "SELECT COUNT(*) AS count FROM carrito WHERE idusuario = '$id'";
    } elseif (isset($_SESSION['idinvitado'])) {
        $id = $_SESSION['idinvitado'];
        $query = "SELECT COUNT(*) AS count FROM carrito WHERE idinvitado = '$id'";
    } else {
        // Manejar el escenario en el que no se proporciona ni ID de usuario ni ID de invitado
        echo 'No se proporcionó un ID de usuario o de invitado';
        exit(); // Terminar la ejecución del script
    }

    // Consulta SQL para obtener el recuento de medicamentos en el carrito
    $result = $conexion->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            // Devolver el recuento de medicamentos en formato JSON
            header('Content-Type: application/json');
            echo json_encode(['count' => $count]);
        } else {
            echo 'No se encontraron medicamentos para este usuario o invitado';
        }
    } else {
        echo 'Error en la consulta: ' . $conexion->error;
    }

}
// Cerrar la conexión a la base de datos
$conexion->close();

