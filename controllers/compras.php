<?php
    session_start();
    require_once '../config/Conexion.php';

    $UsuarioId = $_SESSION["id"];

    $sql = "SELECT c.idcompra, c.total, c.idestadocompra, c.fecha, u.correo AS correo_usuario, ec.estado
            FROM compra c
            INNER JOIN usuarios u ON c.idUsuario = u.idusuario
            LEFT JOIN estadocompra ec ON c.idestadocompra = ec.id
            WHERE c.idUsuario='$UsuarioId'";
    $result = $conexion->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        $data[] = array(
            'mensaje' => 'Sin compras en el sistema'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>