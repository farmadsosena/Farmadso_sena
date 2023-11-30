<?php
include "../config/Conexion.php";

function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
{
    global $conexion;
    $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
    $stmt = $conexion->prepare($consulta);

    // Cambié "ss" a "is" para reflejar que $usuario es un número (asumiendo que es numérico).
    $stmt->bind_param("ii", $usuario, $valorEstado);

    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
}

$roles = array();

if (isset($_POST["id_pedido"])) {
    $id = $_POST["id_pedido"];

    if (existe_en_tabla('usuarios', $id, 'estado', 3)) {
        $roles[] = '<option value="Usuario EPS">Usuario EPS</option>';
    }
    if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 3)) {
        $roles[] = '<option value="Farmacia">Farmacias</option>';
    }
    if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 3)) {
        $roles[] = '<option value="Domiciliario">Domiciliario</option>';
    }

    echo json_encode($roles);
}
?>
