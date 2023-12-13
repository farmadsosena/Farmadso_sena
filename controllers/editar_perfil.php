<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include("../config/Conexion.php");

// Maneja la solicitud de edición de perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['user'];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $cedula = $_POST["documento"];
    $celular = $_POST["telefono"];

    // Validación de números negativos en documento y teléfono
    if ($cedula < 0 || $celular < 0) {
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
            // Actualiza la información en la base de datos
            $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', documento='$cedula', apellido='$apellido', telefono='$celular' WHERE idusuario = $id_usuario";

            if ($conexion->query($sql) === TRUE) {
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Cambios guardados con éxito'
                });
                
                </script>";
                header("Location: ../views/configuracion.php");
            } else {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al guardar los cambios: " . mysqli_error($conexion) . "'
                });
                </script>";
            }
        }
    }
    $conexion->close();
}
