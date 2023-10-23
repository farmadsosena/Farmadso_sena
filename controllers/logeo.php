<?php
session_start();
include "../config/Conexion.php";
if (isset($_POST["enviar"])) {
    $user = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    $consul = mysqli_query($conexion, "SELECT * FROM usuarios WHERE documento='$user' and passwordusuario='$contraseña'");
    if (mysqli_num_rows($consul) > 0) {
        $des = mysqli_fetch_array($consul);
        $rol = $des["idrol"];
        $id = $des["idusuario"];
        $_SESSION["usu"] = $user;
        $_SESSION["rol"] = $rol;
        $_SESSION["id"] = $id;
        if ($rol == "1") {
            echo "<script> window.location='../views/administrador_ve.php'</script>";
        } else if ($rol == "2") {
            echo "<script> window.location='../views/Usuario.php'</script>";
        } 
    } else {
        echo "<script> 
        alert('No existe la cuenta de usuario')
        window.location='../views/administrador_ve.php'
        </script>";
    }
}

?>