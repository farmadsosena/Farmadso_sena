<?php
require_once('./models/conexion.php');

$sql = "SELECT * FROM repartidores";
$resultado = mysqli_query($conexion, $sql);

while ($datos = $resultado->fetch_assoc()) {
    $idDomi = $datos["idrepartidor"];
    $nombre = $datos["nombre"];
    $apellido = $datos["apellido"];
    $estado = $datos["idEstado"];

    // Solo mostrar los domiciliarios activos (estado 1) o inactivos (estado 2)
    if ($estado == 1 || $estado == 2) {
        echo '<div class="statusDelivery">';
        echo '    <div class="imgStatusDelivery" onclick="openModal()">';
        echo '        <img src="assets/svg/user.svg" alt="">';
        echo '    </div>';
        echo '    <div class="fullName">';
        echo '        <p>' . $nombre . ' ' . $apellido . '</p>';
        echo '    </div>';
        echo '    <span class="status" style="background-color: ' . ($estado == 1 ? 'green' : 'red') . ';">';
        echo '        ' . ($estado == 1 ? 'ACTIVO' : 'INACTIVO') . '';
        echo '    </span>';
        echo '</div>';
    }
}
?>
