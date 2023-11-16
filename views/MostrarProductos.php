<?php
// Obtener el hash y el valor cifrado desde la URL
$hashRecibido = $_GET['hash'];
$cifradoRecibido = $_GET['cifrado'];

// Clave secreta para el descifrado (debe ser la misma que se utilizó para cifrar)
$claveSecreta = "mi_clave_secreta";

// Verificar el hash
$hashCalculado = hash('sha256', $cifradoRecibido);

if ($hashRecibido === $hashCalculado) {
    // Hash válido, proceder con el descifrado
    $valorOriginal = openssl_decrypt($cifradoRecibido, 'aes-256-cbc', $claveSecreta, 0, '1234567890123456');
    
    // Hacer algo con el valor original
    echo "Valor original: " . $valorOriginal;
} else {
    // Hash no válido, manejar el error
    echo "Error: Hash no válido";
}


// $sql = "SELECT * FROM medicamentosformulas WHERE IdFormula = '$valorRecibido'";
// $result = $conexion->query($sql);

// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     echo "Medicamento " . $row["medicamento"] . " Con la cantidad pedida " . $row["CantidadMedi"] . " Esta: " . $row["EstadoFRM"] . "<br>";
//   }
// }
