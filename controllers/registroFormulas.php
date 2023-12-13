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
    $estadoFormula = 1;
    $estado = 1;
    $ruta = "../uploads/pdfUsuario";
    $nombres_archivo = $archivo["name"];
    $rutaCompleta = $ruta . "/" . $nombres_archivo;
    move_uploaded_file($archivo["tmp_name"], $rutaCompleta);

    // Insertar la fórmula principal en la tabla "formulas"
    $sql = "INSERT INTO formulas (idPaciente, idEPS, IdMedico, fechaOrden, CausaExterna, idDiagnostico, EstadoFormula, pruebaFormula, Estado) 
            VALUES (?, ?, ?, NOW(), ?, ?, ?, ? , ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $id, $eps, $medico, $causa, $diag, $estadoFormula, $rutaCompleta, $estado);

    if ($stmt->execute()) {
        $id_solicit = mysqli_insert_id($conexion);
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


            // Obtener ID de la jornada
            $stmt_get_jornada_id = $conexion->prepare("SELECT idmedicamento FROM medicamentos WHERE nombre = ?");
            $stmt_get_jornada_id->bind_param("i", $nombreMedicamento);
            $stmt_get_jornada_id->execute();
            $result_jornada_id = $stmt_get_jornada_id->get_result();
            if ($result_jornada_id->num_rows === 0) {
                $response['error'] = 'J no encontrada en fila: ' . $dataKey;
                break;
            } else {
                $row_jornada_id = $result_jornada_id->fetch_assoc();
                $medicamento_id = $row_jornada_id['id_jornada'];
            }

            $sqlMedicamento = "INSERT INTO medicamentosformulas (IdFormula, medicamento, CodigoMedicamento, CantidadMedi, Concentracion, Via, Posologia)
                                VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmtMedicamento = $conexion->prepare($sqlMedicamento);
            $stmtMedicamento->bind_param("issssss", $formulaId, $nombreMedicamento, $codigoMedicamento, $cantidadEstablecida, $concentracion, $viaMedicamento, $posologia);

            if ($stmtMedicamento->execute()) {
                // Registro de medicamento insertado con éxito
                $response['success'] = true;
                $response['message'] = "Fórmula añadida con éxito";
            } else {
                // Error en la inserción del medicamento
                echo "Error al insertar el registro de medicamento: " . $stmtMedicamento->error;
            }
        }
        $stmtMedicamento->close();
    } else {
        $response['success'] = false;
        $response['message'] = "Error al insertar el registro de la fórmula: " . $stmt->error;
    }

    require_once "ContarProductos.php";


    // Cerrar la conexión a la base de datos

    // echo "<script>alert('Fórmula añadida con éxito')</script>";
    // echo "<script>window.location='../views/Usuario.php'</script>";
    header('Content-Type: application/json');
    echo json_encode($response);
}
