<?php
require 'vendor/autoload.php'; // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php
    
$token="p4qjpq72hqq399wp"; // Ultramsg.com token
$instance_id="instance68248"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
    
$to="+57".$numero; 

$body="Bienvenido!!!!\nHemos visto que tiene una formula medica por reclamar, entre al siguiente enlace para acceder a las funciones: https://localhost/ADSO/FARMADSO-GIT/views/MostrarProductos.php?valor=".$valor." 
";

$api=$client->sendChatMessage($to,$body);
print_r($api);
?>