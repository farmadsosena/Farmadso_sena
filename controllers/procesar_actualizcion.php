<?php
require_once('../config/Conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];

    $tipo_vehiculo = $_POST['tipo_vehiculo'];

   
  

    // Actualizar datos en la tabla domiciliario
    $sqlDomiciliario = "UPDATE domiciliario SET tipovehiculo = '$tipo_vehiculo' WHERE idusuario = '$id_usuario'";
    $resultadoDomiciliario = mysqli_query($conexion, $sqlDomiciliario);

    if (!$resultadoDomiciliario) {
        // Manejar error de actualización de datos de domiciliario
        echo "Error al actualizar datos de domiciliario: " . mysqli_error($conexion);
        exit;
    }

    // Verificar si se subió una nueva imagen y procesarla si es necesario
    if ($_FILES['imagen_moto']['error'] == 0) {
        // Puedes procesar la imagen aquí, por ejemplo, moverla a la carpeta deseada y actualizar el nombre de la imagen en la base de datos
        $nombreImagen = $_FILES['imagen_moto']['name'];
        $rutaDestino = "../assets/imagenesDomi/" . $nombreImagen;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($_FILES['imagen_moto']['tmp_name'], $rutaDestino)) {
            // Actualizar el nombre de la imagen en la base de datos
            $sqlActualizarImagen = "UPDATE domiciliario SET imagen = '$nombreImagen' WHERE idusuario = '$id_usuario'";
            $resultadoActualizarImagen = mysqli_query($conexion, $sqlActualizarImagen);

            if (!$resultadoActualizarImagen) {
                // Manejar error de actualización de nombre de imagen
                echo "Error al actualizar nombre de imagen: " . mysqli_error($conexion);
                exit;
            }
        } else {
            // Manejar error al mover la imagen
            echo "Error al mover la imagen a la carpeta de destino";
            exit;
        }
    }

    echo '<script>window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";</script>';
}
?>
