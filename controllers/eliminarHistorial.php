<?php
session_start();
require_once '../config/Conexion.php';


$bd = new Conexion();
if($_SERVER['REQUEST_METHOD'] === 'POST' ){
    // $id =$_SESSION['id_admin'];
    $id = 1;

    $delete = $bd->Getconexion()->query("DELETE FROM historial WHERE id_usuario = '$id' ");
    if($delete){

        echo json_encode('Correcto');
    }
    $bd->Getconexion()->close();
    
}


?>