<?php


require_once '../config/Conexion.php';
traerDatos($conexion);


function traerDatos($conexion)
{

    // Botón para borrar todo el historial
echo " <button id='borrarHistorial'>Borrar todo el historial</button>";

// Consulta para obtener el historial con nombres de usuario
$consultarHistorial = $conexion->query("SELECT h.*, u.nombre as nombre_usuario FROM historial h LEFT JOIN usuarios u ON h.id_usuario = u.idusuario");

if ($consultarHistorial->num_rows > 0) {
    echo '<div class="itemHistorial">
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

        echo '<div class="itemHistorial">
                <i class="fa-solid ' . $icono . '"></i>
                <div>' . $fila['fecha'] . '</div>
                <div>' . $fila['mensaje'] . '</div>
                <div>' . $fila['nombre_usuario'] . '</div>
                <div>' . $fila['ip'] . '</div>
                <div>' . $fila['tipo_dispositivo'] . '</div>
              </div>';
    }
} else {
    echo "<p>No existe nada en historial</p>";
}


}