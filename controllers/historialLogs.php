<?php

require_once '../config/Conexion.php';



// Obten el ID del usuario de la sesión
$idusuaF = $_SESSION['id'];

// Llama a la función pasando la conexión y el ID del usuario de la sesión
traerDatos($conexion, $idusuaF);

function traerDatos($conexion, $idusuaF)
{
    $consultarHistorial = $conexion->query("SELECT h.*, u.nombre as nombre_usuario 
                                           FROM historial h 
                                           LEFT JOIN usuarios u ON h.id_usuario = u.idusuario 
                                           WHERE u.idusuario = $idusuaF");

    if ($consultarHistorial->num_rows > 0) {
        echo '
        <div class="itemHistorial">
            <i class="fa-solid fa-circle-info"></i>
            <div>Fecha</div>
            <div>Mensaje</div>
            <div>Usuario</div>
            <div>Ip</div>
            <div>Tipo dispositivo</div>
        </div>';

        while ($fila = $consultarHistorial->fetch_assoc()) {

            if ($fila['nivel'] === 'INFO') {
                $icono = "fa-triangle-exclamation";
            } elseif ($fila['nivel'] === 'ERROR') {
                $icono = 'fa-xmark';
            } elseif ($fila['nivel'] === 'SUCCESS') {
                $icono = 'fa-check';
            }

            echo '
            <div class="itemHistorial">
                <i class="fa-solid ' . $icono . '"></i>
                <div>' . $fila['fecha'] . '</div>
                <div>' . $fila['mensaje'] . '</div>
                <div>' . $fila['nombre_usuario'] . '</div>
                <div>' . $fila['ip'] . '</div>
                <div>' . $fila['tipo_dispositivo'] . '</div>
            </div>
            ';
        }
    } else {
        echo "<p>No existe nada en historial</p>";
    }
}


// $consultarHistorial = $conexion->query("SELECT * FROM historial
// INNER JOIN cliente ON historial.id_usuario = cliente.id_cliente ORDER BY idHistorial DESC");

?>

