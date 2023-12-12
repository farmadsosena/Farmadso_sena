<?php

include '../config/Conexion.php';
require_once '../models/Log.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IdCategoria = 1;
    $deleteQuery = "UPDATE categoria SET Estado = 0 WHERE idcategoria = ?";

// Prepara la consulta
if ($stmt = mysqli_prepare($conexion, $deleteQuery)) {
    // Vincula los parámetros
    mysqli_stmt_bind_param($stmt, "i", $IdCategoria);

    // Ejecuta la consulta
    if (mysqli_stmt_execute($stmt)) {
        // La consulta se ejecutó con éxito
        $response['success'] = true;
        $response['message'] = "Categoría eliminada exitosamente";

        $log  = new Log();

        $ip = $log::getIp();
        $type = $log::typeDispositive();
        $info = array(
            'nivel' => 'ERROR',   
            'mensaje' => "Se ha eliminado una categoria",
            'ip' => $ip,
            'id_usuario' => $_SESSION['id'],
            'tipo' => $type 
        );
        $resultt = $log->insert($info);

    } else {
        // Error en la ejecución de la consulta
        $response['success'] = false;
        $response['message'] = "Error en la ejecución de la consulta: " . mysqli_error($conexion);
    }

    // Cierra la declaración
    mysqli_stmt_close($stmt);
} else {
    // Error en la preparación de la consulta
    $response['success'] = false;
    $response['message'] = "Error en la preparación de la consulta: " . mysqli_error($conexion);
}

// Cierra la conexión
mysqli_close($conexion);


}

// Devuelve la respuesta en formato JSON
echo json_encode($response);
