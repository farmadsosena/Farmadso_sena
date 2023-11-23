<?php
require_once '../config/Conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMedicamento = $_POST['idMedicamento'];

    // Realiza la consulta para eliminar el medicamento
    $sql = "DELETE FROM medicamentos WHERE idmedicamento = $idMedicamento";

    if (mysqli_query($conexion, $sql)) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($conexion);
}
?>
