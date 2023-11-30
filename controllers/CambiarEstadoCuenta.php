<?php
include "../config/Conexion.php";
if (isset($_POST["id_activar"])) {
  // Obtener el ID del usuario desde la solicitud POST
  $userId = $_POST['id_activar'];
  if (isset($_POST["selected_role"])) {
    $selectedRole = $_POST['selected_role'];

    // Realizar la actualización en la base de datos según el rol
    switch ($selectedRole) {
      case 'Usuario EPS':
        $sql = "UPDATE usuarios SET estado = '2' WHERE idusuario = $userId";
        break;
      case 'Farmacia':
        $sql = "UPDATE farmacias SET EstadoSolicitud = '2' WHERE idusuario = $userId";
        break;
      case 'Domiciliario':
        $sql = "UPDATE domiciliario SET EstadoAcept = '2' WHERE idusuario = $userId";
        break;
      // Agrega casos para otros roles si es necesario
      default:
        return;
    }

    if ($conexion->query($sql) === TRUE) {
      include("../models/UsuarioSuper-admin.php");
    } else {
      echo 'Error en la actualización: ' . $conn->error;
    }
  }else {
    $sql = "UPDATE usuarios SET estado = '2' WHERE idusuario = $userId";

    if ($conexion->query($sql) === TRUE) {
      include("../models/UsuarioSuper-admin.php");
    } else {
      echo 'Error en la actualización: ' . $conn->error;
    }
  }
}


if (isset($_POST["id_desactivar"])) {
  // Obtener el ID del usuario desde la solicitud POST
  $userId = $_POST['id_desactivar'];
  if (isset($_POST["selected_role"])) {
    $selectedRole = $_POST['selected_role'];

    // Realizar la actualización en la base de datos según el rol
    switch ($selectedRole) {
      case 'Usuario EPS':
        $sql = "UPDATE usuarios SET estado = '3' WHERE idusuario = $userId";
        break;
      case 'Farmacia':
        $sql = "UPDATE farmacias SET EstadoSolicitud = '3' WHERE idusuario = $userId";
        break;
      case 'Domiciliario':
        $sql = "UPDATE domiciliario SET EstadoAcept = '3' WHERE idusuario = $userId";
        break;
      // Agrega casos para otros roles si es necesario

      default:
        return;
    }

    if ($conexion->query($sql) === TRUE) {
      include("../models/UsuarioSuper-admin.php");
    } else {
      echo 'Error en la actualización: ' . $conn->error;
    }
  } else {
    $sql = "UPDATE usuarios SET estado = '3' WHERE idusuario = $userId";

    if ($conexion->query($sql) === TRUE) {
      include("../models/UsuarioSuper-admin.php");
    } else {
      echo 'Error en la actualización: ' . $conn->error;
    }
  }
}
?>