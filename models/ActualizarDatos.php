<?php
include "../config/Conexion.php";


if (isset($_POST["enviado"])) {
  $id = $_POST["enviado"];
  $nombre = $_POST["nombre"];
  $correo = $_POST["email"];
  $tel = $_POST["telefono"];
  $desc = $_POST["documento"];

  if (!empty($_FILES["imagen"]["name"])) {
    $img = $_FILES["imagen"];

    // Definir la ruta de destino para los archivos cargados
    $dir_subida = "../documents";
    $nombre_archivo = $img["name"];
    $ruta_archivo = $dir_subida . '/' . $nombre_archivo;
    move_uploaded_file($img["tmp_name"], $ruta_archivo);

    $forte = "UPDATE usuarios SET nombre='$nombre', telefono='$tel', correo='$correo', imgUser='$ruta_archivo'  WHERE idusuario='$id'";
  } else {
    $forte = "UPDATE usuarios SET nombre='$nombre', telefono='$tel', correo='$correo', imgUser='$desc' WHERE idusuario='$id'";
  }

  if (mysqli_query($conexion, $forte)) {
    echo "Datos insertados correctamente";
  } else {
    echo "Algo salió mal con los datos insertados";
  }
}
?>