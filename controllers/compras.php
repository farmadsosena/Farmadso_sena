<?php
    session_start();
    require_once '../config/Conexion.php';

    $UsuarioId= $_SESSION["id"];

    // Consulta SQL para obtener datos de la base de datos
    $sql = "SELECT idcompra, fecha, idestadocompra, correo, total FROM compra 
    INNER JOIN estadocompra ON compra.idestadocompra = estadocompra.id
    WHERE idPaciente='$UsuarioId'";
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