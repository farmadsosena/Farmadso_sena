<?php
require_once('./models/conexion.php');

$sql = "SELECT * FROM repartidores";
$resultado = mysqli_query($conexion, $sql);

while ($datos = $resultado->fetch_assoc()) {
    $idDomi = $datos["idrepartidor"];
    $nombre = $datos["nombre"];
    $apellido = $datos["apellido"];
    $estado = $datos["idEstado"];

    // Mostrar solo los repartidores con estado 3 (pendiente)
    if ($estado == 3) {
        echo '<div class="persona">';
        echo '    <i class="fa-solid fa-circle-user"></i>';
        echo '    <div class="nombre">' . $nombre . ' ' . $apellido . '</div>';
        echo '    <button id="but" onclick="abrirGa('. $idDomi . ')" class="openModalButton">';
        echo '        Ver';
        echo '    </button>';
        echo '</div>';
    }
}
?>
