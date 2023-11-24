<?php
    // Verifica si se ha proporcionado el parámetro idcompra en la solicitud GET
    if (isset($_GET['idcompra'])) {
        $idcompra = $_GET['idcompra'];

        // Realiza la consulta a la base de datos para obtener los detalles de la compra
        require_once '../config/Conexion.php';

        // Consulta para obtener los detalles de la compra y la fecha desde la tabla detallecompra y compra
        $sqlDetalles = "SELECT dc.id, m.nombre as nombre_medicamento, dc.cantidad, dc.preciototal, dc.idDirecciones, c.fecha as fecha_compra
                        FROM detallecompra dc
                        INNER JOIN compra c ON dc.idcompra = c.idcompra
                        INNER JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
                        WHERE dc.idcompra = $idcompra";

        $resultDetalles = $conexion->query($sqlDetalles);

        // Crear un array para almacenar los detalles
        $data = array();

        if ($resultDetalles->num_rows > 0) {
            // Obtener la fecha de la compra (será la misma para todos los detalles de compra relacionados)
            $fechaCompra = null;
            while ($rowDetalle = $resultDetalles->fetch_assoc()) {
                // Establecer la fecha de compra para todos los detalles de compra
                if ($fechaCompra === null) {
                    $fechaCompra = $rowDetalle['fecha_compra'];
                }

                // Formatear la cantidad y el precio total con separadores de miles
                $rowDetalle['cantidad'] = number_format($rowDetalle['cantidad'], 0, ',', '.');
                $rowDetalle['preciototal'] = number_format($rowDetalle['preciototal'], 0, ',', '.');


                // Agregar la fecha de compra y el nombre del medicamento al detalle de compra
                $rowDetalle['fecha_compra'] = $fechaCompra;
                $data[] = $rowDetalle;
            }
        }

        // Devolver los detalles de la compra como respuesta en formato JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        // Si no se proporcionó idcompra, puedes manejar el error de alguna manera
        echo "ID de compra no proporcionado.";
    }
?>