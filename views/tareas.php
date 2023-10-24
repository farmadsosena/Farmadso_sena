<?php
require_once('./models/conexion.php');

$sql = "SELECT * FROM reporteestadofinal";
$resultado = mysqli_query($conexion, $sql);

while ($datosReporte = $resultado->fetch_assoc()) {
    $idcompra = $datosReporte["idcompra"];

    // Si el estado de compra no es 2, no mostrar nada
    if ($datosReporte["idestadocompra"] != 2) {
        continue; // Salta a la siguiente iteración del bucle
    }

    $consultaCompras = "SELECT * FROM compra WHERE idcompra = $idcompra";
    $resultadocompra = mysqli_query($conexion, $consultaCompras);
    $datosCompra = $resultadocompra->fetch_assoc();

    $idpaciente = $datosCompra["idPaciente"];
    $direccionPaciente = $datosCompra["direccion"];

    if ($idcompra) {
        $consultaDetallesCompra = "SELECT * FROM detallecompra WHERE idcompra = $idcompra";
        $resultadoDetalleCompra = mysqli_query($conexion, $consultaDetallesCompra);
        $datosDetalleCompra = $resultadoDetalleCompra->fetch_assoc();
        $idDirecciones = $datosDetalleCompra["idDirecciones"];

        // Resto del código para obtener datos...
    }

    if ($idDirecciones) {
        $consultaDireccion = "SELECT * FROM epsdireccion WHERE id = $idDirecciones";
        $resultadoDireccion = mysqli_query($conexion, $consultaDireccion);
        $datosDireccion = $resultadoDireccion->fetch_assoc();

        $IDdireccionPrincipal = $datosDireccion["idEpsPrincipal"];
        $IDdireccionTwo = $datosDireccion["idEpsTwo"];

        // Resto del código para obtener datos...
    }

    if ($IDdireccionPrincipal) {
        $consultaDprincipal = "SELECT * FROM proveedores WHERE id = $IDdireccionPrincipal";
        $resultadoDprincipal = mysqli_query($conexion, $consultaDprincipal);
        $datosProveedores = $resultadoDprincipal->fetch_assoc();
        $direccionPrincipal = $datosProveedores["direccion"];
    }

    if ($IDdireccionTwo) {
        $consultaDprincipal = "SELECT * FROM proveedores WHERE id = $IDdireccionTwo";
        $resultadoDprincipal = mysqli_query($conexion, $consultaDprincipal);
        $datosProveedores = $resultadoDprincipal->fetch_assoc();
        $direccionTwo = $datosProveedores["direccion"];
    }

    if ($idpaciente) {
        $consultapaciente = "SELECT * FROM usuarios WHERE id = $idpaciente";
        $respuesta = mysqli_query($conexion, $consultapaciente);
        $datospaciente = $respuesta->fetch_assoc();

        $nombrePaciente = $datospaciente["nombre"];
        $apellidoPaciente = $datospaciente["apellido"];
    }

    // Resto del código para mostrar la información
    echo ' <section class="pendingTask">';
    echo '<div class="taskData">';
    echo '<div class="addressInformation">';
    echo '<img src="assets/img/domiciliario1.jpg" alt="" />';
    echo '<div class="addressData">';
    echo '<span>Cliente: ' . $nombrePaciente . ' ' . $apellidoPaciente . '</span>';
    echo '<span>Dirección: ' . $direccionPaciente . '</span>';
    echo '<span>Dirección Principal: ' . $direccionPrincipal . '</span>';
    echo '<span>Dirección 2: ' . $direccionTwo . '</span>';
    echo '</div>';
    echo '</div>';
    echo '<p>TIEMPO ESTIMADO: 30MIN</p>';
    echo '</div>';
    echo '<div class="shippingStatus">';
    echo '<p>Número de pedido: 000' . $datosCompra["idcompra"] . '</p>';
    echo '<div class="stateDelivery">';
    echo '<span>ESTADO:</span>';
    echo '<div class="DETE">';
    echo '<span class="material-symbols-outlined"> electric_moped </span>';
    echo '<p>EN CAMINO</p>';
    echo '</div>';
    echo '<div class="optionsStateDelivery">';
    echo'<form class="formularioEntrega" action="" method="post">';
    echo '<label class="upload">';
    echo 'Cargar Imagen';
    echo '<input type="file" />';
    echo '</label>';
    echo '<button class="deliver">ENTREGAR</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '  </section>';
}
?>
