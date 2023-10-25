<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "farmadso";

// Realiza la conexión a la base de datos
$conexion = mysqli_connect($server, $username, $password, $database);

// Verifica si la conexión se estableció correctamente
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipo_documento = $_POST["tipo_documento"];
    $documento = $_POST["documento"];
    $correo = $_POST["correo"];
    $passwordusuario = $_POST["passwordusuario"];
    $telefono = $_POST["telefono"];
    $idEps = $_POST["IdEps"];
    // Establecer el valor de idrol como 2
    $idrol = 2;

    // Establecer el valor de estado como 1
    $estado = 1;
    echo $telefono;

    // Validación de contraseña y confirmar contraseña
    $confirmar_password = $_POST["passwordusuario"];
    if ($passwordusuario != $confirmar_password) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas no coinciden. Por favor, inténtelo de nuevo.'
            });
        </script>";
    } else {
        // Validación de números negativos en documento y teléfono
        if ($documento < 0 || $telefono < 0) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El documento y el teléfono no pueden ser números negativos.'
                });
            </script>";
        } else {
            // Validación de correo
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo no es válido. Por favor, ingrese un correo válido.'
                    });
                </script>";
            } else {
                // Insertar datos en la base de datos
                $sql = "INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, correo, passwordusuario, telefono, idEps, idrol) VALUES ('$nombre', '$apellido', '$tipo_documento', '$documento', '$correo', '$passwordusuario', '$telefono', '$idEps', '$idrol')";
                if (mysqli_query($conexion, $sql)) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Registro exitoso'
                        });
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al registrar: " . mysqli_error($conexion) . "'
                        });
                    </script>";
                }
            }
        }
    }
} else {
    // Redirigir si alguien intenta acceder directamente a este archivo
    header("Location: ../views/login.php");
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
