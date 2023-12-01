<?php
include "../config/Conexion.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $tel = $_POST["telefono"];
    $desc = $_POST["documento"];

    if (!empty($_FILES["imagen"]["name"])) {
        $img = $_FILES["imagen"];

        // Definir la ruta de destino para los archivos cargados
        $dir_subida = "../uploads/imgUsuario";
        $nombre_archivo = $img["name"];
        $ruta_archivo = $dir_subida . '/' . $nombre_archivo;
        move_uploaded_file($img["tmp_name"], $ruta_archivo);
        
        $forte = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', telefono='$tel', correo='$correo', imgUser='$ruta_archivo', documento='$desc' WHERE idusuario='$id'";
    } else {
        $forte = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', telefono='$tel', correo='$correo',documento='$desc' WHERE idusuario='$id'";
    }

    if (mysqli_query($conexion, $forte)) {
        include "../models/UsuarioSuper-admin.php";
    } else {
      include "../models/UsuarioSuper-admin.php";
    }
}
?>