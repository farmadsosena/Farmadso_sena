<?php

    // Verifica si se ha proporcionado el parámetro idcompra en la solicitud GET
    if (isset($_GET['idcompra'])) {
        $idcompra = $_GET['idcompra'];

        // Realiza la consulta a la base de datos para obtener los detalles de la compra
        require_once '../config/Conexion.php';

        $sql = "SELECT fecha, idestadocompra, direccion, total, codigopostal,correo FROM compra WHERE idcompra = $idcompra";
        $result = $conexion->query($sql);

        // Crear un array para almacenar los detalles
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
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