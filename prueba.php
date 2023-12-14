<?php

$ann = [1, 1, 0, -1, -1];
$pos = 0;
$neg = 0;
$cer = 0;
$CuentaNumero = count($ann);

for ($i = 0; $i < $CuentaNumero; $i++) {
    if ($ann[$i] > 0) {
        $pos++;
    } elseif ($ann[$i] < 0) {
        $neg++;
    } else {
        $cer++;
    }
}

$TotalPos = $pos / $CuentaNumero;
$TotalNeg = $neg / $CuentaNumero;
$TotalCero = $cer / $CuentaNumero;

echo "Positivo: " . number_format($TotalPos, 6) . PHP_EOL;
echo "Negativo: " . number_format($TotalNeg, 6) . PHP_EOL;
echo "Cero: " . number_format($TotalCero, 6) . PHP_EOL;

?>
