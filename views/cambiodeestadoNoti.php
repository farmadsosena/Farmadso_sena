<?php
// tu_script_php.php

require_once('../models/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir el valor de idCompra desde la solicitud AJAX
    $idCompra = $_POST['idCompra'];
    $idUusuario = 1;

    if ($idUusuario) {
        $consultaVerificacion = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $idUusuario";
        $resultadorepartidor = mysqli_query($conexion, $consultaVerificacion);
        $usuarioExiste = mysqli_num_rows($resultadorepartidor) > 0;

        if ($usuarioExiste) {
            echo 'No puedes aceptar otro pedido';
        } else {
            $sql = "UPDATE compra SET idestadocompra = 2 WHERE idcompra = $idCompra";
            $resultado = mysqli_query($conexion, $sql);
        
            if ($resultado) {
                echo "Excelente, Revisa tu bandeja de tareas";

                // Obtener información necesaria para la inserción
                $fechaFinal = date('Y-m-d H:i:s'); // Puedes ajustar el formato según sea necesario
                $idEstadoCompra = 2; // Puedes ajustar según sea necesario

                // Consulta de inserción
                $consultaInsertar = "INSERT INTO reporteestadofinal (idrepartidor, idcompra, fechafinal, idestadocompra) VALUES ('$idUusuario', '$idCompra', '$fechaFinal', '$idEstadoCompra')";
                
                $resultadoInsercion = mysqli_query($conexion, $consultaInsertar);

                if ($resultadoInsercion) {
                    // echo "Se insertó en reporteestadofinal correctamente";
                } else {
                    echo "Error al insertar en reporteestadofinal: " . mysqli_error($conexion);
                }
            } else {
                echo "No se actualizó: " . mysqli_error($conexion);
            }
        }
    }

} else {
    // Manejo de caso cuando no es una solicitud POST
    echo "No se realizó la consulta";
}
?>
