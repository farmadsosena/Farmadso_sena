<?php
include "../config/Conexion.php";

if (isset($_POST["im"])) {
    $id_medicamento = intval($_POST["im"]);

    $stmt = $conexion->prepare("SELECT * FROM medicamentos 
                                LEFT JOIN promocion ON medicamentos.idmedicamento = promocion.id_medicamento 
                                INNER JOIN farmacias ON farmacias.IdFarmacia = medicamentos.idfarmacia 
                                WHERE medicamentos.idmedicamento = ?");

    $stmt->bind_param("i", $id_medicamento);
    $stmt->execute();

    $result = $stmt->get_result();

    $fila = $result->fetch_assoc();

    $stmt2 = $conexion->prepare("SELECT * FROM inventario WHERE idmedicamento = ?");

    $stmt2->bind_param("i", $id_medicamento);
    $stmt2->execute();

    $result2 = $stmt2->get_result();

    $fila2 = $result2->fetch_assoc();

    $datos_enviar = [
        "medicamento" => $fila,
        "inventario" => $fila2
    ];

    echo json_encode($datos_enviar);

    $stmt->close();
    $conexion->close();
}
