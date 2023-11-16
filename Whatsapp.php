<?php
require 'vendor/autoload.php'; // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php
    
$token="d8exqbesu3e75iho"; // Ultramsg.com token
$instance_id="instance68554"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
    
$to="+57".$numero; 

$body="Bienvenido!!!!\nHemos visto que tiene una formula medica por reclamar, entre al siguiente enlace para acceder a las funciones: localhost/ADSO/FARMADSO-GIT/views/MostrarProductos.php?valor=".urlencode($valorCifrado)."";

$api=$client->sendChatMessage($to,$body);

// print_r($api);
?>