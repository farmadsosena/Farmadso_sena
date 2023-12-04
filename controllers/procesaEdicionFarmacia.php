<?php
include('../config/Conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
?>
   <div class="loader-container">
        <div class="loader"></div>
        <p>Procesando cambios...</p>
    </div>
<?php


    $idfarmacia = $_POST["idFarmacia"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $horario = $_POST["horario"];
    $codigopostal = $_POST["codigopostal"];
    $ciudad = $_POST["ciudad"];
    $departamento = $_POST["departamento"];

    // Verificar si se seleccionó una nueva imagen
    if ($_FILES["imagen"]["name"] != '') {
        // Si se seleccionó una nueva imagen, procesarla y actualizar la base de datos
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temp = $_FILES["imagen"]["tmp_name"];
        $ruta_destino = "../uploads/imgPerfilFarmacia/" . $imagen_nombre;

        move_uploaded_file($imagen_temp, $ruta_destino);

        // Actualizar la imagen en la base de datos junto con otros datos
        $query = "UPDATE farmacias SET Nombre = ?, Direccion = ?, correo = ?, telefono = ?, horario = ?, codigoPostal = ?, ciudad = ?, Departamento = ?, imgfarmacia = ? WHERE IdFarmacia = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("sssssssssi", $nombre, $direccion, $correo, $telefono, $horario, $codigopostal, $ciudad, $departamento, $imagen_nombre, $idfarmacia);
        $stmt->execute();
        $stmt->close();
    } else {
        // Si no se seleccionó una nueva imagen, actualizar la base de datos sin cambiar la imagen
        $query = "UPDATE farmacias SET Nombre = ?, Direccion = ?, correo = ?, telefono = ?, horario = ?, codigoPostal = ?, ciudad = ?, Departamento = ? WHERE IdFarmacia = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssssssssi", $nombre, $direccion, $correo, $telefono, $horario, $codigopostal, $ciudad, $departamento, $idfarmacia);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../views/panelAdmin.php");
    exit();
} else {
    // Manejar el caso en que el formulario no fue enviado
    echo "Formulario no enviado.";
}
?>
