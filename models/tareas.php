<?php

$idDomi = $_SESSION["id"];

require_once('../config/Conexion.php');

$consultaDomi = "SELECT * FROM domiciliario WHERE idusuario = $idDomi AND estadolaboral = 'Trabajando' ";
$resultadoDomi = mysqli_query($conexion, $consultaDomi);
$datosDomi = $resultadoDomi->fetch_assoc();

$idDomiciliario = $datosDomi["iddomiciliario"];

if ($idDomiciliario) {
    $sql = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $idDomiciliario";
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
        $direccionCompra = $datosCompra["direccion"];

        // Consulta para obtener información del paciente
        $consultaPaciente = "SELECT * FROM usuarios WHERE idusuario = " . $datosCompra["idPaciente"];
        $resultadoPaciente = mysqli_query($conexion, $consultaPaciente);
        $datosPaciente = $resultadoPaciente->fetch_assoc();

        // Resto del código para mostrar la información
        echo ' <section class="pendingTask">';
        echo '<div class="taskData">';
        echo '<div class="addressInformation">';
        echo '<img src="assets/img/domiciliario1.jpg" alt="" />';
        echo '<div class="addressData">';
        echo '<span>Cliente: ' . $datosPaciente["nombre"] . ' ' . $datosPaciente["apellido"] . '</span>';
        echo '<span>Direccion Cliente: '. $direccionCompra .' </span>';
        
        // Consulta para obtener direcciones únicas de los medicamentos
        $consultaDireccionesMedicamentos = "SELECT DISTINCT farmacias.Direccion
            FROM detallecompra
            INNER JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
            INNER JOIN farmacias ON medicamentos.idfarmacia = farmacias.IdFarmacia
            WHERE detallecompra.idcompra = $idcompra";

        $resultadoDireccionesMedicamentos = mysqli_query($conexion, $consultaDireccionesMedicamentos);

        // Mostrar todas las direcciones de los medicamentos
        $contadorDirecciones = 1;
        while ($datosDireccionMedicamento = $resultadoDireccionesMedicamentos->fetch_assoc()) {
            echo '<span>Dirección ' . $contadorDirecciones . ': ' . $datosDireccionMedicamento["Direccion"] . '</span>';
            $contadorDirecciones++;
        }

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
        echo '<form type="submit" class="formularioEntrega" action="" method="post">';
        echo '<input type="hidden" name="idcompra" value="' . $idcompra . '">';
        echo '<label class="upload">';
        echo 'Cargar Imagen';
        echo '<input type="file" name="archivo" />';
        echo '</label>';
        echo '<button class="deliver">ENTREGAR</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '  </section>';
    }
}

?>
