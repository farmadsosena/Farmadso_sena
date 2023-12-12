<?php

require_once('../config/Conexion.php');

// Inicializa la respuesta
$response = array("status" => "", "message" => "", "showAlert" => false);

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Accede al valor de idcompra
    $idcompra = $_POST['idcompra'];
    $idestadocompra = 4;

    // Verifica si el idcompra existe en la base de datos
    $consultaExistencia = "SELECT COUNT(*) as count, fechafinal, idestadocompra FROM reporteestadofinal WHERE idcompra = ?";
    $stmtExistencia = $conexion->prepare($consultaExistencia);
    $stmtExistencia->bind_param("s", $idcompra);
    $stmtExistencia->execute();
    $resultExistencia = $stmtExistencia->get_result();
    $existenciaData = $resultExistencia->fetch_assoc();
    $stmtExistencia->close();

    if ($existenciaData['count'] > 0) {
        // El idcompra existe, puedes continuar con la actualización del estado e imagen

        // Verifica si el estado de la compra es igual a 3
        if ($existenciaData['idestadocompra'] == 3) {
            // Verifica si la fechafinal es menor a la hora actual
            $fechafinal = strtotime($existenciaData['fechafinal']);
            $horaActual = strtotime(date('Y-m-d H:i:s'));

            if ($fechafinal > $horaActual) {
                // La fechafinal es mayor a la hora actual, no permitir la actualización
                $response["status"] = "error";
                $response["message"] = "No puedes actualizar la imagen antes de la fechafinal.";
                $response["showAlert"] = true;
            } else {
                // Obtiene información sobre el archivo
                $nombreArchivo = $_FILES['archivo']['name'];
                $rutaTemporal = $_FILES['archivo']['tmp_name'];

                // Mueve el archivo a la ubicación deseada
                $directorioDestino = "../assets/EvidenciaCompra/";
                $rutaDestino = $directorioDestino . $nombreArchivo;

                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    // Actualiza el estado y la imagen
                    $sqlUpdateReporte = "UPDATE reporteestadofinal SET idestadocompra = ?, imagen = ? WHERE idcompra = ?";
                    $stmtUpdateReporte = $conexion->prepare($sqlUpdateReporte);

                    // Vincula los parámetros
                    $stmtUpdateReporte->bind_param("sss", $idestadocompra, $nombreArchivo, $idcompra);

                    // Ejecuta la consulta
                    if ($stmtUpdateReporte->execute()) {
                        // La primera consulta fue exitosa, ahora realiza la segunda consulta
                        $sqlUpdateCompra = "UPDATE compra SET idestadocompra = 4 WHERE idcompra = ?";
                        $stmtUpdateCompra = $conexion->prepare($sqlUpdateCompra);
                        $stmtUpdateCompra->bind_param("s", $idcompra);

                        if ($stmtUpdateCompra->execute()) {
                            // Ambas consultas fueron exitosas
                            $response["status"] = "success";
                            $response["message"] = "Estado e imagen actualizados correctamente.";
                        } else {
                            // Hubo un error en la segunda consulta
                            $response["status"] = "error";
                            $response["message"] = "Error al actualizar el estado en la tabla compra: " . $stmtUpdateCompra->error;
                        }

                        // Cierra la conexión de la segunda consulta
                        $stmtUpdateCompra->close();
                    } else {
                        // Hubo un error en la primera consulta
                        $response["status"] = "error";
                        $response["message"] = "Error al actualizar estado e imagen en reporteestadofinal: " . $stmtUpdateReporte->error;
                    }

                    // Cierra la conexión de la primera consulta
                    $stmtUpdateReporte->close();
                } else {
                    // Hubo un error al mover el archivo
                    $response["status"] = "error";
                    $response["message"] = "Error al guardar el archivo.";
                }
            }
        } else {
            // El estado de la compra no es igual a 3, no permitir la actualización de la imagen
            $response["status"] = "error";
            $response["message"] = "No puedes subir la imagen";
            $response["showAlert"] = true;
        }
    } else {
        // El idcompra no existe en la base de datos
        $response["status"] = "error";
        $response["message"] = "El idcompra no existe en la base de datos.";
        $response["showAlert"] = true;
    }
} else {
    // Si se intenta acceder directamente a este archivo, emite un mensaje de error
    $response["status"] = "error";
    $response["message"] = "Acceso no autorizado";
    $response["showAlert"] = true;
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
