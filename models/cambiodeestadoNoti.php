<?php

session_start();

$idDomi = $_SESSION["id"];
require_once('../config/Conexion.php');
date_default_timezone_set('America/Bogota');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir el valor de idCompra desde la solicitud AJAX
    $idCompra = $_POST['idCompra'];

    $consultaDomi = "SELECT * FROM domiciliario WHERE idusuario = $idDomi AND estadolaboral = 'Trabajando' ";
    $resultadoDomi = mysqli_query($conexion, $consultaDomi);
    $datosDomi = $resultadoDomi->fetch_assoc();

    $idDomiciliario = $datosDomi["iddomiciliario"];

    if ($resultadoDomi) {
        // Verificar si el usuario ya tiene asignada una compra con estado 2
        $consultaVerificacion = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $idDomiciliario AND (idestadocompra = 2 OR idestadocompra = 3)";
        $resultadorepartidor = mysqli_query($conexion, $consultaVerificacion);
        $usuarioExiste = mysqli_num_rows($resultadorepartidor) > 0;

        if ($usuarioExiste) {
            echo json_encode(array("status" => "error", "message" => 'No puedes aceptar otro pedido'));
        } else {
            // Obtener la cantidad de direcciones únicas de farmacias asociadas a los productos de la compra
            $consultaCantidadDirecciones = "SELECT COUNT(DISTINCT farmacias.Direccion) as cantidadDirecciones
                FROM detallecompra
                INNER JOIN medicamentos ON detallecompra.idmedicamento = medicamentos.idmedicamento
                INNER JOIN farmacias ON medicamentos.idfarmacia = farmacias.IdFarmacia
                WHERE detallecompra.idcompra = $idCompra";

            $resultadoCantidadDirecciones = mysqli_query($conexion, $consultaCantidadDirecciones);
            $datosCantidadDirecciones = $resultadoCantidadDirecciones->fetch_assoc();
            $cantidadDirecciones = $datosCantidadDirecciones["cantidadDirecciones"];

            // Establecer la zona horaria a Colombia
            date_default_timezone_set('America/Bogota');

            // Obtener la hora actual en formato Hora:Minutos:Segundos

            // Calcular la hora de los medicamentos
            $horaMedicamentos = date('Y-m-d H:i:s', strtotime("+" . ($cantidadDirecciones * 10) . " minutes"));

            // Actualizar el estado de la compra
            $sql = "UPDATE compra SET idestadocompra = 2 WHERE idcompra = $idCompra";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo json_encode(array("status" => "success", "message" => "Excelente, Revisa tu bandeja de tareas"));

                // Obtener información necesaria para la inserción en reporteestadofinal
                $fechaFinal = date('Y-m-d H:i:s'); // Puedes ajustar el formato según sea necesario
                $idEstadoCompra = 2; // Puedes ajustar según sea necesario

                // Consulta de inserción en reporteestadofinal
                $consultaInsertar = "INSERT INTO reporteestadofinal (idrepartidor, idcompra, fechafinal, horaMedicamentos, idestadocompra) 
                                    VALUES ('$idDomiciliario', '$idCompra', '$fechaFinal', '$horaMedicamentos', '$idEstadoCompra')";

                $resultadoInsercion = mysqli_query($conexion, $consultaInsertar);

                if ($resultadoInsercion) {
                    // Insertar la cantidad de direcciones en la tabla comprasmasivas
                    $consultaInsertarCantidadDirecciones = "INSERT INTO comprasmasivas (idcompra, cantidadFarmacias, cantidadConfirmada, HoraReclamada, estadoReclamo) 
                                                             VALUES ('$idCompra', '$cantidadDirecciones', 0, NULL, 1)";
                    $resultadoInsertarCantidadDirecciones = mysqli_query($conexion, $consultaInsertarCantidadDirecciones);

                    if (!$resultadoInsertarCantidadDirecciones) {
                        echo json_encode(array("status" => "error", "message" => "Error al insertar en comprasmasivas: " . mysqli_error($conexion)));
                    }
                } else {
                    echo json_encode(array("status" => "error", "message" => "Error al insertar en reporteestadofinal: " . mysqli_error($conexion)));
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "No se actualizó: " . mysqli_error($conexion)));
            }
        }
    }
} else {
    // Manejo de caso cuando no es una solicitud POST
    echo json_encode(array("status" => "error", "message" => "No se realizó la consulta"));
}

?>
