<?php
session_start();
include "../config/Conexion.php";

if (isset($_POST["enviar"])) {
    $user = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Validar que el usuario sea una cadena de números válida 
    if (!preg_match("/^[0-9]{7,10}$/", $user)) {
        echo "<script>alert('Número de cédula no válido');
        window.location='../views/login.php'</script>";
    }
    // Validar que la contraseña no sea un número negativo
    else if ($contraseña < 0) {
        echo "<script>alert('La contraseña no es válida caracter negativo');
        window.location='../views/login.php'</script>";
    }
    else {
        $consul = mysqli_query($conexion, "SELECT * FROM usuarios WHERE documento='$user'");
        if (mysqli_num_rows($consul) > 0) {
            $des = mysqli_fetch_array($consul);
            $password_hash = $des["passwordusuario"];
            $id = $des["idusuario"];
            $rol = $des["idrol"];
            $eps = $des["IdEps"];
            $img = $des["imgUser"];
            $tel = $des["telefono"];

            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            // if (password_verify($contraseña, $password_hash)) {  Cuando se hace por hash
                if ($contraseña === $password_hash) {
                    // Contraseña correcta
                    $_SESSION["usu"] = $user;
                    $_SESSION["id"] = $id;
                    $_SESSION["eps"] = $eps;
                    $_SESSION["img"] = $img;
                    $_SESSION["telefono"] = $tel;
                    if ($rol == "1") {
                        echo "<script>window.location='../views/'</script>";
                       
                    } elseif ($rol == "2") {
                        echo "<script>window.location='../views/Usuario.php'</script>";
                       
                    }
                } else {
                    // Contraseña incorrecta
                    echo "<script>alert('Contraseña incorrecta');</script>";
                    echo "<script>window.location='../views/login.php'</script>";
                }
        } else {
            echo "<script>alert('El usuario no existe');</script>";
            echo "<script>window.location='../views/login.php'</script>";
        }
    }
}
