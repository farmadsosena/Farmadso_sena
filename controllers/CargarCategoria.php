<?php
include '../config/Conexion.php';
require_once '../models/Log.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $html = '';

    $consulta = mysqli_query($conexion, "SELECT * FROM categoria WHERE Estado = 1");
    while ($row = mysqli_fetch_assoc($consulta)) {
        $html .= "<div class='category'>
                    <div class='nombre'>
                        <h1>{$row['nombrecategoria']}</h1>
                    </div>
                    <div class='descripcion'>
                        <h1>{$row['descripcion']}</h1>
                    </div>
                    <div class='buttons'>
                        <button class='btn-editar'onclick='openEditCategoria({$row['idcategoria']})'>Editar<i class='bx bx-pencil'></i> </button>
                        <button class='btn-eliminar' onclick='eliminarCategoria({$row['idcategoria']})' data-delete='{$row['idcategoria']}' >Eliminar <i class='bx bx-trash'></i> </button>
                    </div>
                </div>";
    }

    echo $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Este bloque manejará la solicitud de eliminación
    $idCategoria = $_POST['idCategoria'];
    $consul = mysqli_query($conexion, "SELECT * FROM categoria WHERE idcategoria = $idCategoria");
    $logy = mysqli_fetch_assoc($consul);
    
    // Utilizando una consulta preparada para evitar inyección SQL
    $deleteQuery = mysqli_prepare($conexion, "UPDATE categoria SET Estado = 0 WHERE idcategoria = ?");
    mysqli_stmt_bind_param($deleteQuery, "i", $idCategoria);
    $result = mysqli_stmt_execute($deleteQuery);

    if ($result) {
        echo "Eliminación exitosa";
       
        $log  = new Log();
 
        $ip = $log::getIp();
        $type = $log::typeDispositive();
        $info = array(
            'nivel' => 'ERROR',   
            'mensaje' => "Se ha eliminado la categoria  (" . $logy['nombrecategoria']  . ") ",
            'ip' => $ip,
            'id_usuario' => $_SESSION['id'],
            'tipo' => $type 
        );
        $resultt = $log->insert($info);

    } else {
        echo "Error al eliminar la categoría";
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($deleteQuery);
}
?>
