<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $response = array();
    if(empty($_POST['nombre'])){
        $response['error'] = 'El campo nombre no puede estar vacio'; 
    }
}