<?php
 require_once('../models/conexion.php');

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el ID enviado por AJAX
    $idCompra = $_POST['idCompra'];

    $sql = "SELECT * FROM compra WHERE idcompra = $idCompra";
    $resultado = mysqli_query($conexion, $sql);
    $datosCompra = $resultado->fetch_assoc();

    // sacamos los datos de la tabla compra

    $idpaciente = $datosCompra["idPaciente"];
    $direccionCliente = $datosCompra["direccion"];

    // consulta para los datos del paciente
    if ($idpaciente) {
        $consultapaciente = "SELECT * FROM usuarios WHERE id = $idpaciente";
        $respuesta = mysqli_query($conexion, $consultapaciente);
        $datospaciente = $respuesta->fetch_assoc();

        $nombrePaciente = $datospaciente["nombre"];
        $apellidoPaciente = $datospaciente["apellido"];
    }

    


    // consulta paraas direcciones
    if ($idCompra) {
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

            // direccion 1
            if ($IDdireccionPrincipal) {
                $consultaDprincipal = "SELECT * FROM proveedores WHERE id = $IDdireccionPrincipal";
                $resultadoDprincipal = mysqli_query($conexion, $consultaDprincipal);
                $datosProveedores = $resultadoDprincipal->fetch_assoc();
                $direccionPrincipal = $datosProveedores["direccion"];
            }
            // direccion 2
            if ($IDdireccionTwo) {
                $consultaDprincipal = "SELECT * FROM proveedores WHERE id = $IDdireccionTwo";
                $resultadoDprincipal = mysqli_query($conexion, $consultaDprincipal);
                $datosProveedores = $resultadoDprincipal->fetch_assoc();
                $direccionTwo = $datosProveedores["direccion"];
            }
        }
    }

    if ($direccionTwo) {
       $consultaFinal = "SELECT * FROM reporteestadofinal";
       $resultadoFinal = mysqli_query($conexion, $consultaFinal);
       $datoFinal = $resultadoFinal->fetch_array();

       $Fechafinal = $datoFinal["fechafinal"];
       $imagen = $datoFinal["imagen"];
    }


  // Crear un array con los datos que deseas enviar
  $dataToSend = array(
    'idCompra' => $idCompra,
    'direccionPrincipal' => $direccionPrincipal,
    'direccionTwo' => $direccionTwo,
    'nombreUsuario' => $nombrePaciente,
    'apellidoPaciente' => $apellidoPaciente,
    'direccionCliente' => $direccionCliente,
    'fechaFinal' => $Fechafinal,
    'imagen' => $imagen
    // Agrega más datos según sea necesario
);
  // Puedes enviar una respuesta JSON
  $response = array('status' => 'success', 'data' => $dataToSend);
  echo json_encode($response);


}
