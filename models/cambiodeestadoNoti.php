<?php

session_start();

$idDomi = $_SESSION["id"];
require_once('../config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir el valor de idCompra desde la solicitud AJAX
    $idCompra = $_POST['idCompra'];

    $consultaDomi = "SELECT * FROM domiciliario WHERE iddomiciliario = $idDomi AND estadolaboral = 'Trabajando' ";
    $resultadoDomi = mysqli_query($conexion, $consultaDomi);
    $datosDomi = $resultadoDomi->fetch_assoc();

    

    if ($resultadoDomi) {
        // Verificar si el usuario ya tiene asignada una compra con estado 2
        $consultaVerificacion = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $idDomi AND idestadocompra = 2";
        $resultadorepartidor = mysqli_query($conexion, $consultaVerificacion);
        $usuarioExiste = mysqli_num_rows($resultadorepartidor) > 0;

        if ($usuarioExiste) {
            echo 'No puedes aceptar otro pedido';
        } else {
            // Actualizar el estado de la compra
            $sql = "UPDATE compra SET idestadocompra = 2 WHERE idcompra = $idCompra";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "Excelente, Revisa tu bandeja de tareas";

                // Obtener información necesaria para la inserción
                $fechaFinal = date('Y-m-d H:i:s'); // Puedes ajustar el formato según sea necesario
                $idEstadoCompra = 2; // Puedes ajustar según sea necesario

                // Consulta de inserción en reporteestadofinal
                $consultaInsertar = "INSERT INTO reporteestadofinal (idrepartidor, idcompra, fechafinal, idestadocompra) VALUES ('$IdDomiciliario', '$idCompra', '$fechaFinal', '$idEstadoCompra')";

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
