
<?php
session_start();
include('../config/Conexion.php');

// Verifica si la solicitud es un método GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Inicia la sesión
    $where = '';
    // Verifica si está establecido el id de usuario en la sesión
    if (isset($_SESSION['id'])) {
        $where = $_SESSION['id'];
    } elseif (isset($_SESSION['idinvitado'])) {
        $where =  $_SESSION['idinvitado'];
    }

    $query = "SELECT medicamentos.precio, carrito.cantidadcarrito FROM carrito INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento WHERE carrito.idinvitado ='$where' or carrito.idusuario = '$where'";
    $result = $conexion->query($query);


    if ($result) {
        $dataAll = array();
      $Subtotal = 0;
        while ($productos = $result->fetch_assoc()) {

            $costo  = $productos['precio'] *  $productos['cantidadcarrito'];
            $Subtotal = $costo +$Subtotal;
        }
        $monto = intVal($Subtotal);
        $state = true;
        $data = array(
          'state' => $state,
          'amount' =>  $monto
        );
      
        echo json_encode ($data);
    } else {
        echo json_encode(array('error' => 'Error en la consulta'));
    }
}
?>