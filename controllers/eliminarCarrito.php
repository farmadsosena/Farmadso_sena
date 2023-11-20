<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    echo 'noSession';
    exit();
}
require_once('../models/conexion.php');
$conexionDataBase  = new Conexion();
$conexion = $conexionDataBase ->Getconexion();
if ($id_productos = $_POST['id_Productos']) {
    
    unset($_SESSION['subtotal']);
    foreach ($id_productos as $id_producto) {
        $eliminar = "DELETE  FROM carrito WHERE id_producto = '$id_producto'";
        $delete = mysqli_query($conexion, $eliminar);
       
    }
}
if ($id_producto = $_POST['id_Productounitario']) {
    
    $eliminarunitario = "DELETE  FROM carrito WHERE id_producto = '$id_producto'";
    $delete = mysqli_query($conexion, $eliminarunitario);
    unset($_SESSION['subtotal']);
}


?>