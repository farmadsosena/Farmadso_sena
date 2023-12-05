<?php

$sql_ofertas_buscador = "SELECT p.*, m.*,I.*, f.Nombre as nombre_farmacia
        FROM promocion p
        INNER JOIN medicamentos m ON p.id_medicamento = m.idmedicamento
        INNER JOIN farmacias f ON m.idFarmacia = f.idFarmacia
        INNER JOIN inventario I ON I.idinventario = m.idmedicamento
        WHERE valordescuento >= 25 AND I.stock > 0";

$result_ofertas_buscador = $conexion->query($sql_ofertas_buscador);

// Verifica si hay resultados en la consulta
if ($result_ofertas_buscador->num_rows > 0) {
    while ($row_ofertas_buscador = $result_ofertas_buscador->fetch_assoc()) {
        $id_medicamento = $row_ofertas_buscador['id_medicamento'];
        $precio_antes = $row_ofertas_buscador['precio'];
        $descuento = $row_ofertas_buscador['valordescuento'];
        $id_ofuscado = base64_encode($id_medicamento);
        echo "<div class='mejores_ofertas_medicamentos top-product' data-im='$id_ofuscado'>";
        echo "<img src='../uploads/imgProductos/" . $row_ofertas_buscador['imagenprincipal'] . "' class='abrirDetalles_medicamentos' alt=''>";
        echo "<i>Hasta el $descuento% de descuento</i>";
        echo "</div>";
    }
} else {
    echo "No hay ofertas disponibles.";
}
