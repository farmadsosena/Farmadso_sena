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

    if (mysqli_query($conexion, $sql)) {


        $log = new Log();

        $ip = $log::getIp();
        $type = $log::typeDispositive();
        $info = array(
            'nivel' => 'ERROR',
            'mensaje' => "Se ha eliminado el medicamento con el codigo " . $medicamento['codigo'] . " y nombre  " . $medicamento['nombre'] . " ",
            'ip' => $ip,
            'id_usuario' => 1, //$_SESSION['id_farmacia']
            'tipo' => $type
        );
        $resultt = $log->insert($info);

        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($conexion);
}
?>
