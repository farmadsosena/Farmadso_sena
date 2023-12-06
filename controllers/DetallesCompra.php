<?php
   // Verifica si se ha proporcionado el parámetro idcompra en la solicitud GET
    if (isset($_GET['idcompra'])) {
        $idcompra = $_GET['idcompra'];

        // Realiza la consulta a la base de datos para obtener los detalles de la compra
        require_once '../config/Conexion.php';

        // Consulta para obtener los detalles de la compra desde las tablas relacionadas
        $sqlDetalles = "SELECT dc.id, m.nombre as nombre_medicamento, dc.cantidad, dc.preciototal
                        FROM detallecompra dc
                        INNER JOIN compra c ON dc.idcompra = c.idcompra
                        INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
                        WHERE dc.idcompra = ?";

        // Preparar la consulta
        $stmt = $conexion->prepare($sqlDetalles);

        if ($stmt) {
            // Vincular parámetro
            $stmt->bind_param("i", $idcompra);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener resultados
            $resultDetalles = $stmt->get_result();

            // Crear un array para almacenar los detalles
            $data = array();

            if ($resultDetalles->num_rows > 0) {
                while ($rowDetalle = $resultDetalles->fetch_assoc()) {
                    $data[] = $rowDetalle;
                }
            } else {
                $data[] = array(
                    'mensaje' => 'No se encontraron detalles de compra para el ID proporcionado.'
                );
            }

            // Devolver los detalles de la compra como respuesta en formato JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "Error en la preparación de la consulta.";
        }
    } else {
        // Si no se proporcionó idcompra, puedes manejar el error de alguna manera
        echo "ID de compra no proporcionado.";
    }
?>