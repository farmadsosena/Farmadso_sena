<?php
session_start();
include "../config/Conexion.php";

if (isset($_SESSION["usu"])) {
    // header("Location: login.php");
    $id = $_SESSION["id"];

    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id'");
    $rr = mysqli_fetch_assoc($consulta);
}


if (!isset($_SESSION['id'])) {
  if (!isset($_SESSION['id_invitado'])) {
   $_SESSION['id_invitado'] = generarIDInvitadoUnico(); // Generar un ID único para el invitado si no hay sesión de usuario
  }
} else {
  // Si hay un usuario autenticado, utilizar su ID
  $idUsuario = $_SESSION['id'];
  // Haz lo que necesites con el ID del usuario autenticado
}

function generarIDInvitadoUnico()
{
  $prefix = 'INVITADO_'; // Prefijo para identificar al invitado
  $uniqueID = $prefix . uniqid(); // Generar un identificador único

  return $uniqueID;
}
?>


