<?php

// Recibir una petición post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asegurarse de que los parámetros POST estén presentes y no estén vacíos
    if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        include('../config/Conexion.php');

        $dataReturn = array();

        // Utiliza consultas preparadas para prevenir inyección SQL
        $sql = "SELECT * FROM compra 
                INNER JOIN detallecompra ON compra.idcompra = detallecompra.idcompra 
                WHERE DATE(compra.fecha) BETWEEN ? AND ?";
        
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Obtén los datos en un array asociativo
            while ($dato = $result->fetch_assoc()) {
                $dataReturn[] = $dato;
            }
            // Enviar la respuesta como JSON
            echo json_encode($dataReturn);
        } else {
            // Si no hay resultados, envía un mensaje indicando que no hay datos
            echo json_encode(null);
        }

        // Cierra la conexión y la sentencia preparada
        $stmt->close();
        $conexion->close();
    } else {
        // Si falta algún parámetro, enviar una respuesta de error
        echo json_encode(array('error' => 'Faltan parámetros'));
    }
}
?>
