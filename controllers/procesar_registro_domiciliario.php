<?php
include("../config/Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
    $id_usuario = $_POST["user"];
    $direccion= $_POST["direccion"];
    $fecha_inicio = $_POST["fechainicio"];
    $historial = $_POST["historial"];
    $disponibilidad = $_POST["disponibilidad"];
    $tipo_vehiculo = $_POST["tipovehiculo"];
    $tipoCuenta = $_POST["tipo_cuenta"];

    if ($tipoCuenta === "nequi" || $tipoCuenta === "paypal" || $tipoCuenta === "bancolombia") {
        $numeroCuenta = $_POST["numeroCuenta"];
        
        if ($tipoCuenta === "nequi") {
         $cuentanequi = $_POST["numeroCuenta"];

        } elseif ($tipoCuenta === "paypal") {
            $cuentapaypal = $_POST["numeroCuenta"];

        } elseif ($tipoCuenta === "bancolombia") {
            $cuentaban= $_POST["numeroCuenta"];
        }
    } 
    
    // Validar que la imagen se haya cargado correctamente
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $carpeta_destino = "../uploads/imgUsuario/";
        $nombre_archivo = $_FILES['imagen']['name'];
        $archivo_subido = $_FILES['imagen']['tmp_name'];
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($archivo_subido, $ruta_archivo)) {
            $ruta_imagen = $ruta_archivo;
        } else {
            echo "<div class='alert error'>Ha ocurrido un error al guardar la imagen. Por favor, inténtelo de nuevo.</div>";
            exit; // Detener la ejecución del código si hay un error al guardar la imagen
        }
    } else {
        echo "<div class='alert error'>Error al cargar la imagen. Por favor, inténtelo de nuevo.</div>";
        exit; // Detener la ejecución del código si hay un error al cargar la imagen
    }

    // Insertar los datos en la base de datos (debes ajustar la consulta SQL según tu base de datos)
    $sql = "INSERT INTO tabla_nombre (id_usuario, direccion, fechainicio, historial,disponibilidad, tipovehiculo tipo_cuenta, numero_cuenta, ruta_imagen)
            VALUES ('$id_usuario','$direccion','$fecha_inicio', '$historial','$disponibilidad','$tipo_vehiculo', '$tipoCuenta', '$numeroCuenta', '$ruta_imagen')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Registro exitoso'
        });
        </script>";
        // Redireccionar a la página de éxito o a donde sea necesario
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al registrar los datos: " . $conexion->error . "'
        });
        </script>";
    }
}
?>
