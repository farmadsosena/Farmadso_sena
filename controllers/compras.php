<?php
    session_start();
    require_once '../config/Conexion.php';

    $UsuarioId= $_SESSION["id"];

    // Consulta SQL para obtener datos de la base de datos
    $sql = "SELECT idcompra, fecha, estadocompra, email, total FROM compras WHERE idusuario='$UsuarioId'";
    $result = $conexion->query($sql);

    // Crear un array para almacenar los datos
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }else{
       '<div class="imgBusqueda flex">
        <img src="../assets/img/notas.png" alt="">
        Sin compras en el sistema(Reorganizar foto)
      </div>';
    }

    // Devolver los datos como respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);

?>