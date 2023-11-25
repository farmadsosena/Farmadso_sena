<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "../config/Conexion.php";

    // Evitar inyección SQL usando mysqli_real_escape_string
    $id = mysqli_real_escape_string($conexion, $_POST['idCompra']);

    // Usar marcadores de posición para evitar inyección SQL en la consulta
    $idEstado = 3;
    $consulta = $conexion->prepare("UPDATE compra SET idestadocompra = ? WHERE idcompra = ?");
    $consulta->bind_param("ii", $idEstado, $id);
    $consulta->execute();

    // Redireccionar de manera adecuada utilizando window en lugar de windows
    echo "<script>window.location.href='../views/PanelAdmin.php';</script>";

    // Cerrar la conexión y liberar recursos
    $consulta->close();
    $conexion->close();
}
?>
