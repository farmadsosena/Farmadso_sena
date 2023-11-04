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

    $ruta = "../uploads/pdfUsuario";
    $nombres_archivo = $archivo["name"];
    $rutaCompleta = $ruta . "/" . $nombres_archivo;
    move_uploaded_file($archivo["tmp_name"], $rutaCompleta);

    // Insertar la fórmula principal en la tabla "formulas"
    $sql = "INSERT INTO formulas (idPaciente, idEPS, IdMedico, fechaOrden, CausaExterna, idDiagnostico, EstadoFormula, pruebaFormula) 
            VALUES (?, ?, ?, NOW(), ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssss", $id, $eps, $medico, $causa, $diag, $estadoFormula, $rutaCompleta);

    if ($stmt->execute()) {
        // Obtener el ID de la fórmula recién insertada
        $formulaId = $stmt->insert_id;

        // Insertar los medicamentos en la tabla "medicamentosformulas"
        for ($i = 1; $i <= $cantidadMedicamentos; $i++) {
            $nombreMedicamento = $_POST["Medicamento" . $i];
            $codigoMedicamento = $_POST["codigo" . $i];
            $cantidadEstablecida = $_POST["cantidad" . $i];
            $concentracion = $_POST["concentracion" . $i];
            $viaMedicamento = $_POST["via" . $i];
            $posologia = $_POST["posologia" . $i];

            $sqlMedicamento = "INSERT INTO medicamentosformulas (IdFormula, medicamento, CodigoMedicamento, CantidadMedi, Concentracion, Via, Posologia)
                                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmtMedicamento = $conexion->prepare($sqlMedicamento);
            $stmtMedicamento->bind_param("issssss", $formulaId, $nombreMedicamento, $codigoMedicamento, $cantidadEstablecida, $concentracion, $viaMedicamento, $posologia);

            if ($stmtMedicamento->execute()) {
                // Registro de medicamento insertado con éxito
            } else {
                // Error en la inserción del medicamento
                echo "Error al insertar el registro de medicamento: " . $stmtMedicamento->error;
            }
        }
        $stmtMedicamento->close();
    } else {
        // Error en la inserción de la fórmula principal
        echo "Error al insertar el registro de la fórmula: " . $stmt->error;
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conexion->close();

    echo "<script>alert('Fórmula añadida con éxito')</script>";
    echo "<script>window.location='../views/Usuario.php'</script>";
}
?>
