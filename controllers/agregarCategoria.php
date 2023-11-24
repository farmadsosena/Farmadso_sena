<?php
require_once '../config/Conexion.php';
require_once '../models/Log.php';
session_start();


// ESO DEBE IR DENTRO DE EL CUMPLIMIENTO TOTAL DE LA CONSULTA (guarda backlog de cambio realizado o agregamiento jijija de categoria miking)

           $ip = $log::getIp();
        $type = $log::typeDispositive();
        $info = array(
            'nivel' => 'SUCCESS',   
            'mensaje' => "Se ha registrado un nuevo medicamento con el nombre  " . $medicine['nombre']  . " ",
            'ip' => $ip,
            'id_usuario' => $_SESSION['id'],
            'tipo' => $type 
        );
        $resultt = $log->insert($info);

// HASTA AQUI DEBEMOS ESTAR NITIDO y continua else en caso de que no se realizo la consulta correctamente

   
     