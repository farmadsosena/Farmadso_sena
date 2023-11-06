<?php
session_start();
include("../config/conexion.php"); // Asegúrate de que la conexión a la base de datos esté configurada en "conexion.php"

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nueva_contrasena = $_POST['nueva_contrasena'];

    if (!empty($nueva_contrasena)) {
        // Actualiza la contraseña en la base de datos (deberás implementar tu propia lógica de base de datos)
        $usuario_id = $_SESSION["id"]; // Supongamos que guardas el ID del usuario en la sesión

        $stmt = mysqli_query($conexion, "UPDATE usuarios SET passwordusuario = '$nueva_contrasena' WHERE idusuario = $usuario_id");
        
        if ($stmt) {
            echo "<script>window.location='../views/Usuario.php'</script>";
        } else {
            echo 'Error al actualizar la contraseña: ' . mysqli_error($conexion);
        }
    } else {
        echo 'Por favor, complete el campo de nueva contraseña.';
    }
}
?>
