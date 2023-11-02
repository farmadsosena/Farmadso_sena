<?php

    require_once '../config/Conexion.php';

    // Consulta SQL para obtener datos de la base de datos
    $sql = "SELECT idcompra, fecha, estadocompra, email, total FROM compras";
    $result = $conexion->query($sql);

    // Crear un array para almacenar los datos
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Devolver los datos como respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);

?>