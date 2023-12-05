<?php
// Valor a validar
$valor = $id_solicit; // Cambia esto al valor que deseas validar
$numero = $_SESSION["telefono"];

// Consulta SQL para buscar el valor en la tabla
$sql = "SELECT * FROM medicamentosformulas 
INNER JOIN formulas ON  medicamentosformulas.IdFormula = formulas.idFormula
WHERE medicamentosformulas.IdFormula = '$valor'";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $NombreMedicamento = $row["medicamento"];
    $cantidad = $row["CantidadMedi"];
    $idMedicamentoFormuala = $row["IdMedi"];
    $EPSusuario = $row["idEPS"];

    $ConsulMedi = mysqli_query($conexion, "SELECT * FROM medicamentos 
      INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
      INNER JOIN farmacias ON medicamentos.idfarmacia = farmacias.idfarmacia
      WHERE medicamentos.nombre = '$NombreMedicamento' AND farmacias.IdEps = '$EPSusuario'  
      ORDER BY inventario.precio ASC LIMIT 1");

    if (mysqli_num_rows($ConsulMedi) > 0) {
      $rf = mysqli_fetch_assoc($ConsulMedi);
      $idMedicamento = $rf['idmedicamento']; // Obtén el ID del medicamento
      $Stiockcantidad = $rf["stock"];

      if ($cantidad <= $Stiockcantidad) {
        $insertar = mysqli_query($conexion, "UPDATE medicamentosformulas SET EstadoFRM= 'Disponible' WHERE IdMedi='$idMedicamentoFormuala'");

      } else {
        $insertar = mysqli_query($conexion, "UPDATE medicamentosformulas SET EstadoFRM= 'Sin unidades necesarias' WHERE IdMedi='$idMedicamentoFormuala'");
      }
    }else{// If para corroborar la existencia del medicamento
      $insertar = mysqli_query($conexion, "UPDATE medicamentosformulas SET EstadoFRM= 'Medicamento inexistente' WHERE IdMedi='$idMedicamentoFormuala'");
    }
  }

  //CODIGO PARA GENERAR LA CLAVE DEL ESPACIO A RELLENAR EN LA URL
  function generarClaveSecreta()
  {
    $claveSecreta = '';
    for ($i = 0; $i < 4; $i++) {
      $claveSecreta .= rand(0, 9); // Genera un número aleatorio entre 0 y 9
    }
    return $claveSecreta;
  }

  // Generar una clave secreta
  $claveSecretaGenerada = generarClaveSecreta();

  $valorOriginal = $valor; //Id de la formula que corresponde en la base de datos

  // Cifrar el valor original usando la clave secreta generada
  $cifrado = openssl_encrypt($valorOriginal, 'aes-256-cbc', $claveSecretaGenerada, 0, '1234567890123456');

  // Generar el hash del valor cifrado
  $hash = hash('sha256', $cifrado);

  // Codificar la clave secreta antes de enviarla
  $claveSecretaCodificada = base64_encode($claveSecretaGenerada);

  require_once "../Whatsapp.php";
} else {
  echo "El valor no existe en la tabla.";
}

// Cierra la conexión a la base de datos
$conexion->close();
