<?php
include("../config/Conexion.php");
if (isset($_GET['valor'])) {
    $valor = $_GET['valor'];
    // Aquí puedes usar la variable $valor para realizar operaciones

    $sql = "SELECT * FROM medicamentosformulas WHERE IdFormula = '$valor'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "Medicamento ". $row["medicamento"] ." Con la cantidad pedida ". $row["CantidadMedi"]." Esta: ".$row["EstadoFRM"]."<br>";
      }
    }
} else {
    echo "No se pasó ningún valor en la URL.";
}
?>
