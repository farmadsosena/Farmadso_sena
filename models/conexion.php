<?php

$conexion = mysqli_connect("localhost", "root", "", "farmadso");

if (!$conexion) {
    die("La conexión a la base de datos falló: " . mysqli_connect_error());
}
?>