<?php
include "../config/Conexion.php";
if (isset($_POST["id_activar"])) {
  // Obtener el ID del usuario desde la solicitud POST
  $userId = $_POST['id_activar'];

  // Realizar la actualización en la base de datos
  $sql = "UPDATE usuarios SET estado = '2' WHERE idusuario = $userId";

  if ($conexion->query($sql) === TRUE) {
    include("../models/UsuarioSuper-admin.php");
  } else {
    echo 'Error en la actualización: ' . $conn->error;
  }

 
} 


if (isset($_POST["id_desactivar"])) {
  // Obtener el ID del usuario desde la solicitud POST
  $userId = $_POST['id_desactivar'];

  // Realizar la actualización en la base de datos
  $sql = "UPDATE usuarios SET estado = '3' WHERE idusuario = $userId";

  if ($conexion->query($sql) === TRUE) {
    include("../models/UsuarioSuper-admin.php");
  } else {
    echo 'Error en la actualización: ' . $conn->error;
  }

 
}
?>
