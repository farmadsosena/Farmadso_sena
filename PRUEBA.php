<?php
// Función para generar una clave secreta de máximo 5 números
function generarClaveSecreta() {
    $claveSecreta = '';
    for ($i = 0; $i < 4; $i++) {
        $claveSecreta .= rand(0, 9); // Genera un número aleatorio entre 0 y 9
    }
    return $claveSecreta;
}

// Generar una clave secreta
$claveSecretaGenerada = generarClaveSecreta();

// Valor original que quieres cifrar
$valorOriginal = "30";

// Cifrar el valor original usando la clave secreta generada
$cifrado = openssl_encrypt($valorOriginal, 'aes-256-cbc', $claveSecretaGenerada, 0, '1234567890123456');

// Generar el hash del valor cifrado
$hash = hash('sha256', $cifrado);

// Codificar la clave secreta antes de enviarla
$claveSecretaCodificada = base64_encode($claveSecretaGenerada);

// Construir la URL con el hash, el valor cifrado y la clave secreta codificada
$url = "validad.php?hash=" . urlencode($hash) . "&cifrado=" . urlencode($cifrado) . "&clave=" . urlencode($claveSecretaCodificada);

// Redirigir o imprimir la URL
header("Location: " . $url);
?>

