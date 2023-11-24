<?php
use modeloMedicina\MedicineModel;

require_once '../models/MedicineModel.php';
require_once '../config/Conexion.php';
require_once '../models/Log.php';
session_start();
// Validar solicitud 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $modelMedicinaa = new MedicineModel($conexion); 
    $medicamentos = array();
    // Datos de la tabla de medicamentos
    $medicamentos['codigo'] = $_POST['cum'];
    $medicamentos['nombre']= $_POST['medicineName'];
    $medicamentos['precio'] = $_POST['priceMedicine'];


    //Datos de la tabla de inventario
    $inventario['lote'] = $_POST['loteMedicine'];
    $inventario['stock']  = $_POST['StockMedicine'];
    $inventario['descripcion']  = $_POST['description'];
    $inventario ['instrucciones'] = $_POST['instructionMedicine'];
    $inventario ['fechavencimiento'] = $_POST['expirationDate'];
    $inventario['formaadministracion'] = $_POST['formaAdminis'];
    $inventario ['idcategoria'] = $_POST['categorye'];
    $inventario ['idprovedor'] = $_POST['provideMedicine'] ;

    
    $idMedicamento = $_POST['idmedicamento'];

   
    $status  = $modelMedicinaa->medicineUpdate($idMedicamento, $medicamentos, $inventario);
    if($status){
        $log  = new Log();

        $ip = $log::getIp();
        $type = $log::typeDispositive();
        $info = array(
            'nivel' => 'INFO',   
            'mensaje' => "Se ha editado un nuevo medicamento con el nombre  " . $medicamentos['nombre']  . " ",
            'ip' => $ip,
            'id_usuario' => $_SESSION['id'],
            'tipo' => $type 
        );
        $resultt = $log->insert($info);

        echo json_encode("Success");
    }else{
        echo json_encode("Error");
    }
}
?>
