<?php
try {
    $sql = "SELECT p.*, m.*,I.*, f.Nombre as nombre_farmacia
        FROM promocion p
        INNER JOIN medicamentos m ON p.id_medicamento = m.idmedicamento
        INNER JOIN farmacias f ON m.idFarmacia = f.idFarmacia
        INNER JOIN inventario I ON I.idinventario = m.idmedicamento
        WHERE valordescuento >= 25 AND I.stock > 0";

    $result = $conexion->query($sql);

    // Verifica si hay resultados en la consulta
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_medicamento = $row['id_medicamento'];
            $precio_antes = $row['precio'];
            $descuento = $row['valordescuento'];
            $id_ofuscado = base64_encode($id_medicamento);
            echo "<div class='mejores_ofertas_medicamentos top-product' data-im='$id_ofuscado'>";
            echo "<img src='../uploads/imgProductos/" . $row['imagenprincipal'] . "' class='abrirDetalles_medicamentos' alt=''>";
            echo "<i>Hasta el $descuento% de descuento</i>";
            echo "</div>";
        }
    } else {
        echo "No hay ofertas disponibles.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cierra la conexión
    if (isset($conexion)) {
        $conexion->close();
    }
}