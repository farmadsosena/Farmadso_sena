<?php
require_once('./models/conexion.php');

$sql = "SELECT * FROM compra";
$resultado = mysqli_query($conexion, $sql);

while ($datosCompra = $resultado->fetch_assoc()) {
    $idpaciente = $datosCompra["idPaciente"];
    $ideps = $datosCompra["ideps"];

    if ($datosCompra["idestadocompra"] != 1) {
        // no haces nada si el estado de compra no es 1
    } else {
        // Consulta para obtener nombre y apellido del paciente
        $consultaPaciente = "SELECT nombre, apellido FROM usuarios WHERE id = $idpaciente";
        $resultadoconsultaPaciente = mysqli_query($conexion, $consultaPaciente);

        if ($resultadoconsultaPaciente->num_rows > 0) {
            $filaUsuarios = $resultadoconsultaPaciente->fetch_assoc();
            $nombrePaciente = $filaUsuarios["nombre"];
            $apellidoCliente = $filaUsuarios["apellido"];
        }

        // Consulta para obtener nombre de la EPS
        $consultaEPS = "SELECT nombre FROM proveedores WHERE id = $ideps";
        $resultadoconsultaEPS = mysqli_query($conexion, $consultaEPS);

        if ($resultadoconsultaEPS->num_rows > 0) {
            $filaEPS = $resultadoconsultaEPS->fetch_assoc();
            $nombreEPS = $filaEPS["nombre"];
        }

        // Mostrar la información
        echo '<article data-id="' . $datosCompra["idcompra"] . '" class="orderAvailable">';
        echo '<p> 000' . $datosCompra["idcompra"] . '</p>';
        echo '<div class="nameEPS">';
        echo '<img src="assets/img/logoEPS.png" alt="" />';
        echo $nombreEPS; // Muestra el nombre de la EPS
        echo '</div>';
        echo '<hr />';
        echo '<div class="customerData">';
        echo '<span>Dirección: B/' . $datosCompra["direccion"] . '</span>';
        echo '<span>Cliente: ' . $nombrePaciente . ' ' . $apellidoCliente . ' </span>';
        echo '</div>';
        echo '<div class="buttonSeeMore" onclick="abrirNoti(' . $datosCompra["idcompra"] . ')">';
        echo '<a href="#" class="seeMore" >Ver más</a>';
        echo '</div>';
        echo '</article>';
    }
}
?>
