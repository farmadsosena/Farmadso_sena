<?php

// Valor a validar
$valor = $id_solicit; // Cambia esto al valor que deseas validar
$numero= $_SESSION["telefono"];

// Consulta SQL para buscar el valor en la tabla
$sql = "SELECT * FROM medicamentosformulas WHERE IdFormula = '$valor'";

$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $NombreMedicamento= $row["medicamento"];
      $cantidad= $row["CantidadMedi"];
      $idMedicamentoFormuala= $row["IdMedi"];


      $ConsulMedi=mysqli_query($conexion,"SELECT * FROM medicamentos 
      INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
      WHERE nombre = '$NombreMedicamento'");
      $rf= mysqli_fetch_assoc($ConsulMedi);

  
      $Stiockcantidad= $rf["stock"];

      if($cantidad <= $Stiockcantidad){
        $insertar= mysqli_query($conexion,"UPDATE medicamentosformulas SET EstadoFRM= 'Disponible' WHERE IdMedi='$idMedicamentoFormuala'");

        if(mysqli_num_rows($ConsulMedi) > 0){
          // echo "Disponible". $NombreMedicamento ."<br>";
        }

      }else{
        $insertar=mysqli_query($conexion,"UPDATE medicamentosformulas SET EstadoFRM= 'Sin unidades necesarias' WHERE IdMedi='$idMedicamentoFormuala'");

        if(mysqli_num_rows($ConsulMedi) > 0){
          // echo "Sin unidades para". $NombreMedicamento."<br>";
        }
      }
  }
  
  //$hash = hash('sha256', $valor);

  //$claveSecreta = "2345"; // Cambia esto por tu clave real
  //$valorCifrado = openssl_encrypt($valor, 'aes-256-cbc', $claveSecreta, 0, $claveSecreta);

  require_once "../Whatsapp.php";


} else {
    echo "El valor no existe en la tabla.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
