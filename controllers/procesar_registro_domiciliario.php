<?php
include("../config/Conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
    $id_usuario = $_POST["user"];
    $direccion = $_POST["direccion"];
    $fecha_inicio = $_POST["fechainicio"];
    $disponibilidad = $_POST["disponibilidad"];
    $tipo_vehiculo = $_POST["tipovehiculo"];
    $estadolaboral = "Trabajando";
    $estadoAcep = 1;

    $consulta= mysqli_query($conexion,"SELECT * FROM domiciliario WHERE idusuario= '$id_usuario' and EstadoAcept='1'");

    if(mysqli_num_rows($consulta) > 0){
        echo "<script> 
        alert('Usted ya hizo una solicitud para pedir ser una farmacia, por tanto tiene que esperar la respuesta por su correo')
        window.location= '../views/Usuario.php'
        </script>";
        exit; // Detener la ejecución del código si hay un error al guardar la imagen
    }
    
    if (isset($_POST["tipoCuenta"])) {
        $tipoCuenta = $_POST["tipoCuenta"];

        // Validar que el tipo de cuenta seleccionado es válido
        $cuentaValida = false;

        if ($tipoCuenta === "nequi" || $tipoCuenta === "paypal" || $tipoCuenta === "bancolombia") {
            $cuentaValida = true;
        }

        if ($cuentaValida) {
            // Utilizar el tipo de cuenta para construir el nombre del campo correspondiente
            $campoNumeroCuenta = "numeroCuenta " . ucfirst($tipoCuenta);
            $numeroCuenta = $campoNumeroCuenta;

            // Resto del código para insertar en la base de datos
        } else {
            echo "<div class='alert'>Tipo de cuenta no válido.</div>";
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
    $sql = "INSERT INTO domiciliario (idusuario, estadolaboral, direccion, fechainicio, disponibilidad, tipovehiculo, tarjetaPropiedad, soat, licencia, tipoCuenta, numeroCuenta, EstadoAcept, imagen, fotovehiculo)
            VALUES ('$id_usuario', '$estadolaboral', '$direccion','$fecha_inicio','$disponibilidad','$tipo_vehiculo', '$ruta_imagen', '$ruta_imagen','$ruta_imagen', '$tipoCuenta','$numeroCuenta','$estadoAcep','$ruta_imagen', '$ruta_imagen')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Registro exitoso'
        });
        </script>";
        // Redireccionar a la página de éxito o a donde sea necesario
        header("location:../views/Usuario.php");
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
