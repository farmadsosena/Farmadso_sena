<?php
require_once('../config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si el ID de compra está presente en la solicitud
    if (!isset($_POST['idCompra'])) {
        $response = array('status' => 'error', 'message' => 'ID de compra no proporcionado');
        echo json_encode($response);
        exit;
    }

    // Recuperar el ID enviado por AJAX
    $idCompra = $_POST['idCompra'];

    $sql = "SELECT * FROM compra WHERE idcompra = $idCompra";
    $resultado = mysqli_query($conexion, $sql);

    // Verificar si la consulta fue exitosa
    if (!$resultado) {
        $error_message = 'Error en la consulta a la base de datos: ' . mysqli_error($conexion);
        $response = array('status' => 'error', 'message' => $error_message);
        echo json_encode($response);
        exit;
    }

    $datoscompra = $resultado->fetch_assoc();

    // Verificar si se encontraron datos para el ID de compra proporcionado
    if (!$datoscompra) {
        $response = array('status' => 'error', 'message' => 'No se encontraron datos para el ID de compra proporcionado');
        echo json_encode($response);
        exit;
    }

    // datos que necesitamos de la tabla compra
    $fechaCompra = $datoscompra["fecha"];
    $idpaciente = $datoscompra["idUsuario"];
    $direccionPaciente = $datoscompra["direccion"];

    // consulta para los datos del paciente
    if ($idpaciente) {
        $consultapaciente = "SELECT * FROM usuarios WHERE idusuario = $idpaciente";
        $respuesta = mysqli_query($conexion, $consultapaciente);
        $datospaciente = $respuesta->fetch_assoc();
        $nombrePaciente = $datospaciente["nombre"];
        $apellidoPaciente = $datospaciente["apellido"];
    }else{
        $consultapacientecompra = "SELECT * FROM compra WHERE idcompra = $idCompra";
        $resultadoPacientecompra = mysqli_query($conexion, $consultapacientecompra);
        $datosUsuarioCompra = $resultadoPacientecompra->fetch_assoc();
        $nombrePaciente = $datosUsuarioCompra["nombre"];
        $apellidoPaciente = $datosUsuarioCompra["apellido"];
    }

    // consulta para la tabla detalles de compra
    if ($idCompra) {
        $consutaDetalles = "SELECT * FROM detallecompra WHERE idcompra = $idCompra";
        $resultadoDetalles = mysqli_query($conexion, $consutaDetalles);

        // Verificar si la consulta fue exitosa
        if (!$resultadoDetalles) {
            $error_message = 'Error en la consulta a la base de datos: ' . mysqli_error($conexion);
            $response = array('status' => 'error', 'message' => $error_message);
            echo json_encode($response);
            exit;
        }

        // Array para almacenar direcciones de medicamentos
        $direccionesMedicamentos = array();

        while ($datosDetalles = $resultadoDetalles->fetch_assoc()) {
            $idMedicamento = $datosDetalles["idmedicamento"];

            // Consulta para obtener idfarmacia del medicamento
            $consultaIdFarmacia = "SELECT idfarmacia FROM medicamentos WHERE idmedicamento = $idMedicamento";
            $resultadoIdFarmacia = mysqli_query($conexion, $consultaIdFarmacia);

            // Verificar si la consulta fue exitosa
            if (!$resultadoIdFarmacia) {
                $error_message = 'Error en la consulta a la base de datos: ' . mysqli_error($conexion);
                $response = array('status' => 'error', 'message' => $error_message);
                echo json_encode($response);
                exit;
            }

            $rowIdFarmacia = $resultadoIdFarmacia->fetch_assoc();
            $idfarmacia = $rowIdFarmacia["idfarmacia"];

            // Consulta para obtener dirección de la farmacia
            $consultaDireccionFarmacia = "SELECT Direccion FROM farmacias WHERE IdFarmacia = $idfarmacia";
            $resultadoDireccionFarmacia = mysqli_query($conexion, $consultaDireccionFarmacia);

            // Verificar si la consulta fue exitosa
            if (!$resultadoDireccionFarmacia) {
                $error_message = 'Error en la consulta a la base de datos: ' . mysqli_error($conexion);
                $response = array('status' => 'error', 'message' => $error_message);
                echo json_encode($response);
                exit;
            }

            $datosDireccionFarmacia = $resultadoDireccionFarmacia->fetch_assoc();
            $direccionFarmacia = $datosDireccionFarmacia["Direccion"];

            // Agregar dirección de la farmacia al array solo si no está ya presente
            if (!in_array($direccionFarmacia, $direccionesMedicamentos)) {
                $direccionesMedicamentos[] = $direccionFarmacia;
            }
        }
    }

    // Formatear la fecha como cadena en formato ISO 8601
    $fechaFormateada = date("c", strtotime($fechaCompra));

    // Crear un array con los datos que deseas enviar
    $dataToSend = array(
        'idCompra' => $idCompra,
        'fechaCompra' => $fechaFormateada,
        'nombrePaciente' => $nombrePaciente,
        'apellidoPaciente' => $apellidoPaciente,
        'direccionPaciente' => $direccionPaciente,
        'direccionesMedicamentos' => $direccionesMedicamentos
        // Agrega más datos según sea necesario
    );

    // Puedes enviar una respuesta JSON
    $response = array('status' => 'success', 'data' => $dataToSend);
    echo json_encode($response);
}
?>
