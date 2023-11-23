<?php

require_once('../models/conexion.php');

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Accede al valor de idcompra
    $idcompra = $_POST['idcompra'];
    $idestadocompra = 4;

    // Verifica si el idcompra existe en la base de datos
    $consultaExistencia = "SELECT COUNT(*) as count FROM reporteestadofinal WHERE idcompra = ?";
    $stmtExistencia = $conexion->prepare($consultaExistencia);
    $stmtExistencia->bind_param("s", $idcompra);
    $stmtExistencia->execute();
    $resultExistencia = $stmtExistencia->get_result();
    $existenciaData = $resultExistencia->fetch_assoc();
    $stmtExistencia->close();

    if ($existenciaData['count'] > 0) {
        // El idcompra existe, puedes continuar con la actualización del estado e imagen

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
                $sqlUpdateCompra = "UPDATE compra SET idestadocompra = 4 WHERE idcompra = $idcompra";
                $resultadoUpdateCompra = mysqli_query($conexion, $sqlUpdateCompra);

                if ($resultadoUpdateCompra) {
                    // Ambas consultas fueron exitosas
                    $response = array("status" => "success", "message" => "¡Estado e imagen actualizados correctamente!");
                } else {
                    // Hubo un error en la segunda consulta
                    $response = array("status" => "error", "message" => "Error al actualizar el estado en la tabla compra: " . mysqli_error($conexion));
                }
            } else {
                // Hubo un error en la primera consulta
                $response = array("status" => "error", "message" => "Error al actualizar estado e imagen en reporteestadofinal: " . $stmtUpdateReporte->error);
            }

            // Cierra la conexión
            $stmtUpdateReporte->close();
        } else {
            // Hubo un error al mover el archivo
            $response = array("status" => "error", "message" => "Error al guardar el archivo.");
        }
    } else {
        // El idcompra no existe en la base de datos
        $response = array("status" => "error", "message" => "El idcompra no existe en la base de datos.");
    }
} else {
    // Si se intenta acceder directamente a este archivo, emite un mensaje de error
    $response = array("status" => "error", "message" => "Acceso no autorizado");
}

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
