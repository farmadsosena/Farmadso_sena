<?php
    require_once('../models/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el ID enviado por AJAX
    $idCompra = $_POST['idCompra'];

    $sql = "SELECT * FROM compra WHERE idcompra = $idCompra";
    $resultado = mysqli_query($conexion, $sql);
    $datoscompra = $resultado->fetch_assoc();

    // datos que necesitamos de la tabla compra
    $fechaCompra = $datoscompra["fecha"];
    $idpaciente = $datoscompra["idPaciente"];
    $idEps = $datoscompra["ideps"];
    $direccionPaciente = $datoscompra["direccion"];


// consulta para los datos del paciente
    if ($idpaciente) {
        $consultapaciente = "SELECT * FROM usuarios WHERE id = $idpaciente";
        $respuesta = mysqli_query($conexion, $consultapaciente);
        $datospaciente = $respuesta->fetch_assoc();

        $nombrePaciente = $datospaciente["nombre"];
        $apellidoPaciente = $datospaciente["apellido"];
    }
// consulta para la eps principal
    if($idEps) {
        $consultaEps = "SELECT * FROM proveedores WHERE id = $idEps";
        $resultadoEps = mysqli_query($conexion, $consultaEps);
        $datosEps = $resultadoEps->fetch_assoc();
        $nombreeps = $datosEps["nombre"];
    }

// consulta para la tabla detalles de compra
    if($idCompra) {
        $consutaDetalles = "SELECT * FROM detallecompra WHERE idcompra = $idCompra";
        $resultadoDetalles = mysqli_query($conexion, $consutaDetalles);
        $datosDetalles = $resultadoDetalles->fetch_assoc();

        $idDirecciones = $datosDetalles["idDirecciones"];

        if ($idDirecciones) {
            $consultaDireccion = "SELECT * FROM epsdireccion WHERE id = $idDirecciones";
            $resultadoDireccion = mysqli_query($conexion, $consultaDireccion);
            $datosDireccion = $resultadoDireccion->fetch_assoc();

            $IDdireccionPrincipal = $datosDireccion["idEpsPrincipal"];
            $IDdireccionTwo = $datosDireccion["idEpsTwo"];


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
        }
    }


    // Crear un array con los datos que deseas enviar
    $dataToSend = array(
        'idCompra' => $idCompra,
        'fechaCompra' => $fechaCompra,
        'nombrePaciente' => $nombrePaciente,
        'nombreeps' => $nombreeps,
        'apellidoPaciente' => $apellidoPaciente,
        'direccionPaciente' => $direccionPaciente,
        'direccionPrincipal' => $direccionPrincipal,
        'direccionTwo' => $direccionTwo
        // Agrega más datos según sea necesario
    );

    // Puedes enviar una respuesta JSON
    $response = array('status' => 'success', 'data' => $dataToSend);
    echo json_encode($response);
}
?>

