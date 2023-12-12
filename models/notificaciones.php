<?php
$conexion = mysqli_connect("localhost", "root", "", "farmadsovoce");

$sql = "SELECT * FROM compra";
$resultado = mysqli_query($conexion, $sql);

while ($datosCompra = $resultado->fetch_assoc()) {

    $idpaciente = $datosCompra["idUsuario"];
    $idCompra = $datosCompra["idcompra"];
    $direccionpaciente = $datosCompra["direccion"];

    if ($datosCompra["idestadocompra"] != 1) {
        // No haces nada si el estado de compra no es 1
        continue;
    }

    // Obtener nombre y apellido del paciente
    $consultaPaciente = "SELECT nombre, apellido, telefono FROM usuarios WHERE idusuario = ?";
    $stmtPaciente = mysqli_prepare($conexion, $consultaPaciente);
    mysqli_stmt_bind_param($stmtPaciente, "i", $idpaciente);
    mysqli_stmt_execute($stmtPaciente);
    $resultadoconsultaPaciente = mysqli_stmt_get_result($stmtPaciente);

    if ($resultadoconsultaPaciente->num_rows > 0) {
        $filaUsuarios = $resultadoconsultaPaciente->fetch_assoc();
        $nombrePaciente = $filaUsuarios["nombre"];
        $apellidoCliente = $filaUsuarios["apellido"];
        $telefonoCliente = $filaUsuarios["telefono"];
    }

    if ($idCompra) {
        // Consulta para obtener todos los idmedicamento asociados a la compra
        $consultaMedicamentos = "SELECT idmedicamento FROM detallecompra WHERE idcompra = ?";
        $stmtMedicamentos = mysqli_prepare($conexion, $consultaMedicamentos);
        mysqli_stmt_bind_param($stmtMedicamentos, "i", $idCompra);
        mysqli_stmt_execute($stmtMedicamentos);
        $resultadoMedi = mysqli_stmt_get_result($stmtMedicamentos);

        // Verificar si la consulta fue exitosa
        if ($resultadoMedi->num_rows > 0) {
            $row = $resultadoMedi->fetch_assoc();
            $idmedicamento = $row["idmedicamento"];

        
           

            // Consulta para obtener idfarmacia del primer medicamento
            $consultaIdFarmacia = "SELECT idmedicamento, idfarmacia FROM medicamentos WHERE idmedicamento = ?";
            $stmtIdFarmacia = mysqli_prepare($conexion, $consultaIdFarmacia);
            mysqli_stmt_bind_param($stmtIdFarmacia, "i", $idmedicamento);
            mysqli_stmt_execute($stmtIdFarmacia);
            $resultadoIdFarmacia = mysqli_stmt_get_result($stmtIdFarmacia);

            // Verificar si la consulta fue exitosa
            if ($resultadoIdFarmacia->num_rows > 0) {
                $rowIdFarmacia = $resultadoIdFarmacia->fetch_assoc();
                $idmedicamento = $rowIdFarmacia["idmedicamento"];
                $idfarmacia = $rowIdFarmacia["idfarmacia"];

               

                // Consulta para obtener la información de la farmacia
                $consultaInfoFarmacia = "SELECT Nombre AS nombreFarmacia, Direccion FROM farmacias WHERE IdFarmacia = ?";
                $stmtInfoFarmacia = mysqli_prepare($conexion, $consultaInfoFarmacia);
                mysqli_stmt_bind_param($stmtInfoFarmacia, "i", $idfarmacia);
                mysqli_stmt_execute($stmtInfoFarmacia);
                $resultadoInfoFarmacia = mysqli_stmt_get_result($stmtInfoFarmacia);

                // Verificar si la consulta de información de farmacia fue exitosa
                if ($resultadoInfoFarmacia->num_rows > 0) {
                    $rowInfoFarmacia = $resultadoInfoFarmacia->fetch_assoc();
                    $nombreFarmacia = $rowInfoFarmacia["nombreFarmacia"];
                    $direccionFarmacia = $rowInfoFarmacia["Direccion"];
                    

                    // Mostrar la información
                    echo '<article data-id="' . $datosCompra["idcompra"] . '" class="orderAvailable">';
                    echo '<p> 000' . $datosCompra["idcompra"] . '</p>';
                    echo '<div class="nameEPS">';
                    echo '<img class="ImgOrderAvailable" src="../assets/img/latido-del-corazon.png" alt="" />';
                    echo $nombreFarmacia; // Mostrar el nombre de la farmacia
                    echo '</div>';
                    echo '<hr />';
                    echo '<div class="customerData">';
                    echo '<span>Dirección: B/' . $direccionpaciente . '</span>';
                    echo '<span>Cliente: ' . $nombrePaciente . ' ' . $apellidoCliente . ' </span>';
                    echo '<a href="tel: + ' . $telefonoCliente . '">' . $telefonoCliente . '</a>';
                    echo '</div>';
                    echo '<div class="buttonSeeMore" onclick="abrirNoti(' . $datosCompra["idcompra"] . ')">';
                    echo '<a href="#" class="seeMore" >Ver más</a>';
                    echo '</div>';
                    echo '</article>';
                } else {
                    // Manejar el caso de error en la consulta de información de farmacia
                    echo 'Error en la consulta de información de farmacia.';
                }
            } else {
                // Manejar el caso de que no haya medicamentos asociados a la compra
                echo 'No hay medicamentos asociados a la compra.';
            }
        }
    }
}
?>
