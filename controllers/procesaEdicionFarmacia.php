<?php
include('../config/Conexion.php');
require_once '../models/Log.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {


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
    
        // Eliminar el archivo anterior
        $query_select = "SELECT imgfarmacia FROM farmacias WHERE IdFarmacia = ?";
        $stmt_select = $conexion->prepare($query_select);
        $stmt_select->bind_param("i", $idfarmacia);
        $stmt_select->execute();
        $stmt_select->bind_result($imagen_anterior);
        $stmt_select->fetch();
        $stmt_select->close();
    
        if ($imagen_anterior != null && file_exists("../uploads/imgPerfilFarmacia/" . $imagen_anterior)) {
            unlink("../uploads/imgPerfilFarmacia/" . $imagen_anterior);
        }
    
        // Mover la nueva imagen
        move_uploaded_file($imagen_temp, $ruta_destino);
    
        // Actualizar la imagen en la base de datos junto con otros datos
        $query_update = "UPDATE farmacias SET Nombre = ?, Direccion = ?, correo = ?, telefono = ?, horario = ?, codigoPostal = ?, ciudad = ?, Departamento = ?, imgfarmacia = ? WHERE IdFarmacia = ?";
        $stmt_update = $conexion->prepare($query_update);
        $stmt_update->bind_param("sssssssssi", $nombre, $direccion, $correo, $telefono, $horario, $codigopostal, $ciudad, $departamento, $imagen_nombre, $idfarmacia);
        $stmt_update->execute();
        $stmt_update->close();
    }
     else {
        // Si no se seleccionó una nueva imagen, actualizar la base de datos sin cambiar la imagen
        $query = "UPDATE farmacias SET Nombre = ?, Direccion = ?, correo = ?, telefono = ?, horario = ?, codigoPostal = ?, ciudad = ?, Departamento = ? WHERE IdFarmacia = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ssssssssi", $nombre, $direccion, $correo, $telefono, $horario, $codigopostal, $ciudad, $departamento, $idfarmacia);
        $stmt->execute();
        $stmt->close();
    }
    echo'
    <style>
    
.loader-container {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: center;
    height: 100%;
    flex-direction: column;
    text-align: center;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #3498db;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
    margin: 20px auto;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    </style>
    <div class="loader-container">
    <div class="loader"></div>
    <p>Procesando cambios...</p>
</div>';

       
$log  = new Log();
 
$ip = $log::getIp();
$type = $log::typeDispositive();
$info = array(
    'nivel' => 'INFO',   
    'mensaje' => "Se han realizado un cambios en tus datos de farmacia ",
    'ip' => $ip,
    'id_usuario' => $_SESSION['id'],
    'tipo' => $type 
);
$resultt = $log->insert($info);

    header("Location: ../views/panelAdmin.php");
    exit();
} else {
    // Manejar el caso en que el formulario no fue enviado
    echo "Formulario no enviado.";
}
?>
