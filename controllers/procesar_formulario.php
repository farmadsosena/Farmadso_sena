<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilar datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tipo_documento = $_POST["tipo_documento"];
    $documento = $_POST["documento"];
    $correo = $_POST["correo"];
    $passwordusuario = $_POST["passwordusuario"];
    $telefono = $_POST["telefono"];
    $idEps = 1;
    // Establecer el valor de idrol como 2
    $idrol = 2;

    // Establecer el valor de estado como 1
    $estado = 1;

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
                    echo "<script>window.location='login.php'</script>";
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
} ?>


?>
