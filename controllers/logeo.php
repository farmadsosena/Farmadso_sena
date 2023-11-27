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
    } else {
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
                if (isset($_POST["miFarm_tienda"])) {
                    $stmt_farmacia = $conexion->prepare("SELECT * FROM farmacias WHERE idusuario = ?");
                    $stmt_farmacia->bind_param("i", $id);
                    $stmt_farmacia->execute();
                    $result_farmacia = $stmt_farmacia->get_result();

                    $id_encriptado_miFarm = 0;
                    if ($result_farmacia->num_rows > 0) {
                        $fila_farmacia = $result_farmacia->fetch_assoc();
                        $id_encriptado_miFarm = base64_encode($fila_farmacia["IdFarmacia"]);
                    }else{
                        echo "<script>alert('No tienes farmacia no eres...');</script>";
                        echo "<script>window.location='../views/inicio_tienda.php'</script>";
                        return;                        
                    }
                    echo "<script>window.location='../views/productos.php?AsPZ=$id_encriptado_miFarm'</script>";
                    return;
                }
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
