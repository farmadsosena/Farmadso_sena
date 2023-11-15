<?php
include("Conexion.php");

// Obtén el último ID procesado (si está disponible)
$anterior = 0;

while (true) {
    // Consulta nuevas entradas con un ID mayor al último procesado
    $resultado = mysqli_query($conexion, "SELECT MAX(idFormula) FROM formulas");
    $fila = mysqli_fetch_array($resultado);

    if ($fila[0] > $anterior) {
        // Se ha agregado una nueva entrada
        $nueva_entrada = $fila[0] - $anterior;
        echo "Nueva entrada agregada. Total de nuevas entradas: $nueva_entrada\n";

        // Actualiza el último ID procesado
        $anterior = $fila[0];
    }

    // Pausa la ejecución durante un tiempo antes de la próxima comprobación
    sleep(30); // Consulta cada 5 segundos (ajusta el valor según tus necesidades)
}
?>
