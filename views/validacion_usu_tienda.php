<?php
session_start();
include "../config/Conexion.php";

if (isset($_SESSION["usu"])) {
    // header("Location: login.php");
    $id = $_SESSION["id"];

    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id'");
    $rr = mysqli_fetch_assoc($consulta);
}
