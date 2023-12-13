<?php
define('BRAND_NAME', 'TuNombreDeMarca'); // Reemplaza 'TuNombreDeMarca' con el nombre de tu marca
require_once __DIR__ . '/vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic("6bcebbec", "H87TJsY11rtCSqec");
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("573142280319", BRAND_NAME, 'Tu clave para acceder es: '.$claveSecretaRecibida)
);

$message = $response->current();

if ($message->getStatus() == 0) {
   // echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
?>
