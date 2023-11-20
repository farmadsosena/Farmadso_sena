<?php
include "../config/Conexion.php";

$resul = $_POST["query"];
$resul = mysqli_real_escape_string($conexion, $resul);

$buscarCodigo = mysqli_query($conexion, "SELECT * FROM diagnosticos WHERE codeDiag LIKE '%$resul%' ORDER BY nombreDiag");

if ($buscarCodigo) {
  if (mysqli_num_rows($buscarCodigo) > 0) {
    while ($fi = mysqli_fetch_assoc($buscarCodigo)) {
      echo '<div class="mauso-diagnee" data-codigo="'.$fi["codeDiag"].'"  data-nombre="'.$fi["nombreDiag"].'" data-ids="'.$fi["idDiag"].'">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
        <p>'.$fi["nombreDiag"].'</p>
      </div>';
    }
  } else {
    echo "No se han encontrado resultados parecidos";
  }
} else {
  echo "Error en la consulta: " . mysqli_error($conexion);
}
?>


