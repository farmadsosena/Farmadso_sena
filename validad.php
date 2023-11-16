<?php
// Obtener el hash, el valor cifrado y la clave secreta desde la URL
$hashRecibido = $_GET['hash'];
$cifradoRecibido = $_GET['cifrado'];
$claveSecretaRecibidaCodificada = $_GET['clave'];

// Decodificar la clave secreta recibida
$claveSecretaRecibida = base64_decode($claveSecretaRecibidaCodificada);
ECHO $claveSecretaRecibida;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Clave</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Introduce la Clave Secreta</h2>
        <form method="POST">
            <label for="clave">Clave:</label>
            <input type="text" id="clave" name="clave" required>
            <button type="submit" name="claveEscrita">Validar</button>
        </form>
        
    </div>
</body>

</html>

<?php
if (isset($_POST["claveEscrita"])) {
    $claveRegistrada = $_POST["clave"];
    if ($claveRegistrada == $claveSecretaRecibida) {
        // Verificar el hash
        $hashCalculado = hash('sha256', $cifradoRecibido);

        if ($hashRecibido === $hashCalculado) {
            // Hash válido, proceder con el descifrado
            $valorOriginal = openssl_decrypt($cifradoRecibido, 'aes-256-cbc', $claveSecretaRecibida, 0, '1234567890123456');

            if ($valorOriginal !== false) {
                // Hacer algo con el valor original
                echo "Valor original: " . $valorOriginal;
            } else {
                // Error en el descifrado
                echo "Error: No se pudo descifrar el valor.";
            }
        } else {
            // Hash no válido, manejar el error
            echo "Error: Hash no válido";
        }
    } else {
        echo "La clave es incorrecta, por favor revise el número de clave.";
    }
}
?>
