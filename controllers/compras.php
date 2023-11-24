<?php

    session_start();
    require_once '../config/Conexion.php';

    $UsuarioId = $_SESSION["id"];

    // Consulta SQL para obtener datos de la base de datos
    $sql = "SELECT c.idcompra, c.total, c.idestadocompra, c.correo, c.fecha, u.correo AS correo_usuario
            FROM compra c
            INNER JOIN usuarios u ON c.idPaciente = u.idUsuario
            WHERE c.idPaciente='$UsuarioId'";
    $result = $conexion->query($sql);

    // Crear un array para almacenar los datos
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $estadoID = $row['idestadocompra'];
    
            // Realizar una consulta para obtener el nombre del estado
            $sqlEstado = "SELECT estado FROM estadocompra WHERE id = $estadoID";
            $resultEstado = $conexion->query($sqlEstado);
    
            if ($resultEstado->num_rows > 0) {
                $rowEstado = $resultEstado->fetch_assoc();
                $nombreEstado = $rowEstado['estado'];
                // Agregar el nombre del estado al arreglo de datos
                $row['estado'] = $nombreEstado;
            }
    
            $data[] = $row;
        }
    } else {
        // Agregar un mensaje de "Sin compras" al arreglo de datos si no hay resultados
        $data[] = array(
            'mensaje' => 'Sin compras en el sistema'
        );
    }

    // Devolver los datos como respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);

?>