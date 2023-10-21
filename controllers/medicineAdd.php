<?php
use modeloMedicina\MedicineModel;

require_once '../models/MedicineModel.php';
require_once '../config/Conexion.php';


// Validar solicitud 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelMedicinaa = new MedicineModel($conexion);

    $medicine['codigo'] = mysqli_real_escape_string($conexion, $_POST['cum']);
    $medicine['nombre'] = mysqli_real_escape_string($conexion, $_POST['medicineName']);
    $medicine['precio'] = mysqli_real_escape_string($conexion, $_POST['priceMedicine']);
    $medicine['lote'] = mysqli_real_escape_string($conexion, $_POST['loteMedicine']);
    $medicine['descripcion'] = mysqli_real_escape_string($conexion, $_POST['description']);
    $medicine['instrucciones'] = mysqli_real_escape_string($conexion, $_POST['instructionMedicine']);
    $medicine['fechavencimiento'] = mysqli_real_escape_string($conexion, $_POST['expirationDate']);
    $medicine['administracion'] = mysqli_real_escape_string($conexion, $_POST['formaAdminis']);
    $medicine['idcategoria'] = 1;
    $medicine['idproveedor'] = 1;
    $medicine['idpromocion'] = 1;
    $medicine['imagenprincipal'] = 'default.jpg';
    $medicine['imagen'] = null;

    // Procesar las imagenes del medicamento
    $imagenes = $_FILES['img']['name'];
    $rutaFinal = '../uploads/imgProductos/';
    $imagenesBd = array();
    
    for ($i = 0; $i < count($imagenes); $i++) {
        $nombreOriginal = $imagenes[$i];
        $nombreUnico = uniqid() . '_' . $nombreOriginal; // Genera un nombre único
        $rutaDestino = $rutaFinal . $nombreUnico;
    
        if (move_uploaded_file($_FILES['img']['tmp_name'][$i], $rutaDestino)) {
            $imagenesBd[] = $nombreUnico;
        } else {
            echo "Error al mover el archivo: " . $_FILES['img']['error'][$i];
        }
    }
    
    

    // Insertar en el modelo
    $result = $modelMedicinaa->medicineInsert($medicine, $imagenesBd);
    $response = ($result) ? true : 
    (($result === null) ? null : false)
    ;
    $message = match($response){
        true => 'Medicamento agregado correctamente pero la bd pailas',
        null => 'El medicamento ya existe con ese codigo',
        false => 'Paso algo'
    };
    $response = array(
        'status' => $response,
        'message' => $message
    );
    echo json_encode($response);

}