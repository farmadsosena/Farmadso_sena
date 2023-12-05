<?php
session_start();
if (!isset($_SESSION['id'])) {
    $idinvitado = $_SESSION['idinvitado'];
}
require_once('../config/conexion.php');
$conexionDataBase  = new Conexion();
$conexion = $conexionDataBase->Getconexion();

// $query = "SELECT * FROM carrito WHERE idinvitado = '$idinvitado'";
// $resultado = $conexion->query($query);

// if ($resultado->num_rows > 0) {
//     $eliminar = "DELETE  FROM carrito WHERE idmedicamento = '$id_producto'";
//     $delete = mysqli_query($conexion, $eliminar);
// } 



if ($id_productos = $_POST['id_Productos']) {
    unset($_SESSION['subtotal']);
    foreach ($id_productos as $id_producto) {
        $eliminar = "DELETE  FROM carrito WHERE idmedicamento = '$id_producto'";
        $delete = mysqli_query($conexion, $eliminar);
    }
} 
if ($id_productoo = $_POST['id_Productounitario']){
    $eliminarunitario = "DELETE FROM carrito WHERE idmedicamento = '$id_productoo'";
    $delete = mysqli_query($conexion, $eliminarunitario);
    unset($_SESSION['subtotal']);
}

