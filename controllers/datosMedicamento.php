<?php
require_once '../config/Conexion.php';

// Simulación de respuesta JSON desde tu servidor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idMedicamento = isset($_POST['id']) ? $_POST['id'] : null;

    if ($idMedicamento !== null) {
        // Realiza la consulta a las tablas utilizando un JOIN
        $query = "SELECT i.*, m.*
                  FROM inventario AS i
                  JOIN medicamentos AS m ON i.idmedicamento = m.idmedicamento
                  WHERE m.idmedicamento = $idMedicamento";

        $result = mysqli_query($conexion, $query);

        if ($result) {
            // Fetch the row from the result set
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                // Procesa los resultados y almacena los datos en variables
                $codigo = $row['codigo'];
                $nombre = $row['nombre'];
                $precio = $row['precio'];
                $descripcion = $row['descripcion'];
                $instrucciones = $row['instrucciones'];
                $lote = $row['lote'];
                $stock = $row['stock'];
                $formaadministracion = $row['formaadministracion'];
                $idcategoria = $row['idcategoria'];
                $idprovedor = $row['idprovedor'];
                $fechaexpira = $row['fechavencimiento'];
                
                $datos = array(
                    'status' => 'success',
                    'data' => array(
                        'codigo' => $codigo,
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'descripcion' => $descripcion,
                        'instruccions' => $instrucciones,
                        'lote' => $lote,
                        'stock' => $stock,
                        'fadmi' => $formaadministracion,
                        'idcategoria' => $idcategoria,
                        'idprovedor' => $idprovedor,
                        'fechaexp' => $fechaexpira
                    )
                );
            } else {
                // Si no se encuentra el medicamento, envía un mensaje de error
                $datos = array(
                    'status' => 'error',
                    'message' => 'No se encontró el medicamento con el ID proporcionado.'
                );
            }
        } else {
            // Error en la consulta SQL
            $datos = array(
                'status' => 'error',
                'message' => 'Error en la consulta: ' . mysqli_error($conexion)
            );
        }
    } else {
        // No se proporcionó el ID
        $datos = array(
            'status' => 'error',
            'message' => 'No se proporcionó el ID del medicamento.'
        );
    }

    // Puedes enviar una respuesta JSON
    echo json_encode($datos);
    exit; // Salir después de imprimir la respuesta JSON
}
?>
