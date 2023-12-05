<?php
session_start();
include "../config/Conexion.php";

// Si hay una sesión de usuario activa, obtener su información
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id'");
    $rr = mysqli_fetch_assoc($consulta);

    // Destruir la sesión de invitado si existe al iniciar sesión como usuario
    if (isset($_SESSION['idinvitado'])) {
        unset($_SESSION['idinvitado']);
    }
}

// Si no hay sesión de usuario, pero existe la sesión de invitado
if (!isset($_SESSION['id'])) {
  if (!isset($_SESSION['idinvitado'])) {
    $_SESSION['idinvitado'] = generarIDInvitadoUnico(); // Generar un ID único para el invitado si no hay sesión de usuario
   }
 } else {
     unset($_SESSION['idinvitado']);
 }

function generarIDInvitadoUnico()
{
    $prefix = 'INVITADO_'; // Prefijo para identificar al invitado
    $uniqueID = $prefix . uniqid(); // Generar un identificador único
    return $uniqueID;
}
?>
