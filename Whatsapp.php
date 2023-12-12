<?php
require 'vendor/autoload.php'; // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php
    
$token="p1vah8ekxdrpmdql"; // Ultramsg.com token
$instance_id="instance71174"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
    
$to="+57".$numero; 

$body="Bienvenido!!!!\n
Hemos visto que tiene una formula medica por reclamar, entre al siguiente enlace para acceder a las funciones: localhost/ADSO/FARMADSO-GIT/views/validad.php?hash=" . urlencode($hash) . "&cifrado=" . urlencode($cifrado) . "&clave=" . urlencode($claveSecretaCodificada)."";

$api=$client->sendChatMessage($to,$body);

// print_r($api);
?>Ñ