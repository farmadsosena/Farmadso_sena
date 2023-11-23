<?php


$conexion = mysqli_connect("localhost", "root", "", "asignacionv1.1.1");

// Conexion a base de datos
// $conexion = mysqli_connect("localhost", "c1601882_asignar", "keGOtude02", "c1601882_asignar");

if (!$conexion) {
  die("algo salio mal" . mysqli_connect_error());
}

// Configurar la conexión para usar utf8mb4
if (!$conexion->set_charset("utf8mb4")) {
  die("Error al establecer el conjunto de caracteres utf8mb4: " . $conexion->error);
}
?>