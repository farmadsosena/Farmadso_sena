<?php
session_start();

$id = $_SESSION['idusaurioCambio'];

require_once '../config/Conexion.php';

if (isset($_POST['newPassword'])) {
    $newPassword = $_POST['newPassword'];

    $consulta = $conexion->query("UPDATE  usuarios  SET passwordusuario ='$newPassword' WHERE idusuario ='$id'");

    if ($consulta) {
        echo '<script>alert("Se ha restablecido correctamente tu contraseña")</script>';
        echo '<script>window.location.href="../views/login.php"</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/Rlogo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/recuperarContrasea.css">
    <title>Recuperar contraseña</title>
</head>

<body>
    <div class="sombra">
        .
    </div>
    <div class="popup">
        <form class="form" method="POST">
            <div class="icon">
                <img src="../assets/img/candado.svg" alt="" width="100%">
            </div>
            <div class="note">
                <label class="title">Ingresa una nueva contraseña</label>
                <span class="subtitle"></span>
            </div>
            <input placeholder="Ingresa contraseña" title="Ingresa tu correo personal" name="newPassword"
                type="password" class="input_field">
            <button class="submit" type="submit">Guardar</button>
        </form>
    </div>
</body>

</html>