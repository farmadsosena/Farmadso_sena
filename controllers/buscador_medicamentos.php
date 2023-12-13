<?php
require_once "../config/Conexion.php";

$dato = array();
$contador = 0;
$campoBuscar = (isset($_POST["campoBuscar"])) ? $_POST["campoBuscar"] : '';

if (empty($campoBuscar)) {
    $dato = array(
        'noexiste' => true
    );
    echo json_encode($dato);
    exit();
}

$consulta_general = "SELECT nombre, imagenprincipal, idmedicamento FROM medicamentos WHERE nombre LIKE ?";
$stmt = mysqli_prepare($conexion, $consulta_general);
$param = "%$campoBuscar%";
mysqli_stmt_bind_param($stmt, "s", $param);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if ($resultado->num_rows > 0) {
    while ($medicamento_relacionado = $resultado->fetch_assoc()) {
        $contador++;
        $datos = array(
            'idmedicamento' => $medicamento_relacionado['idmedicamento'],
            'nombre' => $medicamento_relacionado['nombre'],
            'imagenprincipal' => $medicamento_relacionado['imagenprincipal'],
            'coinciden' => $resultado->num_rows
        );
        if($contador <= 6){
            $dato[] = $datos;
        }
    }
} else {
    $dato = array(
        'noconincide' => true
    );
}

echo json_encode($dato);
?>