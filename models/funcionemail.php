<?php
// Supongamos que has almacenado el ID del usuario que ha iniciado sesión en una variable de sesión
// Reemplaza '$_SESSION['user_id']' con la forma en que guardas el ID del usuario en tu aplicación
$idusuario = $_SESSION['id'];

// Consulta para obtener el correo del usuario
$consulta = "SELECT correo FROM usuarios WHERE idusuario = $idusuario";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $correo_usuario = $fila['correo'];
} else {
    $correo_usuario = "Correo no encontrado";
}
   

?>
