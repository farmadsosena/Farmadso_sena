<?php

include '../config/conexion.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Usa consultas preparadas para evitar la inyección de SQL
    $IdFormula = $_POST['idFormula'];
    $deleteQuery = "UPDATE formulas SET Estado = 0 WHERE IdFormula = ?";
    
    // Prepara la consulta
    if ($stmt = mysqli_prepare($conexion, $deleteQuery)) {
        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt, "i", $IdFormula);
        
        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            $response['success'] = true;
            $response['message'] = "Eliminación correcta";
        } else {
            $response['success'] = false;
            $response['message'] = "Error en la ejecución de la consulta: " . mysqli_error($conexion);
        }

        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        $response['success'] = false;
        $response['message'] = "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
}

// Devuelve la respuesta en formato JSON
echo json_encode($response);
?>
