<?php
// cambiadorEstado.php
require_once '../config/Conexion.php';


// Verifica si la solicitud es POST y si se proporcionó el idcompra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idcompra'])) {
    $idcompra = $_POST['idcompra'];

    // Aquí realiza las operaciones necesarias para cambiar el estado en la tabla compra
    $bd = new Conexion();
    $conexion = $bd->getConexion();

    // Verifica la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Verifica el estado actual antes de actualizar
    $estado_actual = obtenerEstadoActual($conexion, $idcompra);

    if ($estado_actual === 3) {
        // Si el estado actual ya es 3, responde indicando que ya está en tránsito
        echo 'El estado ya está en tránsito.';
    } else {
        // Actualiza el estado en la tabla compra
        $nuevo_estado = 3; // Reemplaza con el estado que deseas establecer
        $sql = "UPDATE compra SET idestadocompra = $nuevo_estado WHERE idcompra = $idcompra";

        if (mysqli_query($conexion, $sql)) {
            // Envía una respuesta al cliente
            echo 'Estado cambiado correctamente';
        } else {
            // Si hay un error en la consulta, envía un mensaje de error
            echo 'Error al cambiar el estado: ' . mysqli_error($conexion);
        }
    }

    // Cierra la conexión
    mysqli_close($conexion);
} else {
    // Si la solicitud no es POST o no se proporcionó el idcompra, responde con un error
    header('HTTP/1.1 400 Bad Request');
    echo 'Solicitud incorrecta';
}

// Función para obtener el estado actual de una compra
function obtenerEstadoActual($conexion, $idcompra)
{
    $sql = "SELECT idestadocompra FROM compra WHERE idcompra = $idcompra";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['idestadocompra'];
    } else {
        // Si hay un error en la consulta, regresa -1
        return -1;
    }
}
?>
