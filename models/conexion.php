<?php

$conexion = mysqli_connect("localhost", "root", "", "domiciliario2");

if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}
?>