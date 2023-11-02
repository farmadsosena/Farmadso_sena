<?php
session_start();
include "../config/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cantidadMedicamentos = $_POST["cantidadMedicamentos"];
  $diag = $_POST["diagnostico"];
  $medico = $_POST["medico"];
  $causa = $_POST["causa"];
  $archivo = $_FILES["Fotoformula"];
  $id = $_SESSION["id"];
  $eps = $_SESSION["eps"];
  $estadoFormula = "Recién Llegada";
  $estadoGeneral = "1";

  $ruta = "../uploads/pdfUsuario";
  $nombres_archivo = $archivo["name"];
  $rutaCompleta = $ruta . "/" . $nombres_archivo;
  move_uploaded_file($archivo["tmp_name"], $rutaCompleta);

  for ($i = 1; $i <= $cantidadMedicamentos; $i++) {
    $nombreMedicamento = $_POST["Medicamento" . $i];
    $codigoMedicamento = $_POST["codigo" . $i];
    $cantidadEstablecida = $_POST["cantidad" . $i];
    $concentracion = $_POST["concentracion" . $i];
    $viaMedicamento = $_POST["via" . $i];
    $posologia = $_POST["posologia" . $i];

    // Evitar posibles problemas de SQL Injection utilizando consultas preparadas
    $sql = "INSERT INTO formulas (idPaciente, idEPS, IdMedico, fechaOrden, CausaExterna, idDiagnostico, medicamento, CodigoMedica, CantidadMedi, Concentracion, Via, Posologia, EstadoFormula, pruebaFormula) 
            VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssssssss", $id, $eps, $medico, $causa, $diag, $nombreMedicamento, $codigoMedicamento, $cantidadEstablecida, $concentracion, $viaMedicamento, $posologia, $estadoFormula, $rutaCompleta);

    if ($stmt->execute()) {
      // Registro insertado con éxito
    } else {
      // Error en la inserción
      echo "Error al insertar el registro: " . $stmt->error;
    }
  }

  // Cerrar la conexión a la base de datos
  $stmt->close();
  $conexion->close();

  echo "<script>alert('Fórmula añadida con éxito')</script>";
  echo "<script>window.location='../views/Usuario.php'</script>";
}
?>
