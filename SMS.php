<?php
define('BRAND_NAME', 'TuNombreDeMarca'); // Reemplaza 'TuNombreDeMarca' con el nombre de tu marca
require_once __DIR__ . '/vendor/autoload.php';

$basic  = new \Vonage\Client\Credentials\Basic("8510e706", "4IwW6wiFgGlkIJNL");
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("573142280319", BRAND_NAME, 'Su clave para acceder a las vistas es:'.$claveSecretaRecibida)
);

$message = $response->current();

if ($message->getStatus() == 0) {
   // echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
?>
