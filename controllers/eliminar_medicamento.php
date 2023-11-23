<?php
require_once '../config/Conexion.php';
require_once '../models/Log.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMedicamento = $_POST['idMedicamento'];
    $sqll = $conexion->query("SELECT medicamentos.nombre, medicamentos.codigo, inventario.imagendescrip FROM medicamentos INNER JOIN  inventario ON medicamentos.idmedicamento = inventario.idmedicamento WHERE medicamentos.idmedicamento = '$idMedicamento' ");
    $medicamento = $sqll->fetch_assoc();
    $imagenesE = explode(", ", $medicamento['imagendescrip']);

    foreach ($imagenesE as $img) {
        unlink("../uploads/imgProductos/".$img);
    }
    // Realiza la consulta para eliminar el medicamento
    $sql = "DELETE FROM medicamentos WHERE idmedicamento = $idMedicamento";
    $sqlazo = "DELETE FROM inventario WHERE idmedicamento = $idMedicamento";

    if (mysqli_query($conexion, $sql) && mysqli_query($conexion, $sqlazo)) {


        echo "success";
    } else {
        echo "error";
    }

}
?>
