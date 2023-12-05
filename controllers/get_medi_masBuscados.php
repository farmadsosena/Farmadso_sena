<?php

$sql_medi_masBusca = "SELECT medicamentos.*, COUNT(*) as cantidad_busquedas
    FROM medicamentos_mas_busca
    INNER JOIN medicamentos ON medicamentos_mas_busca.id_medicamento = medicamentos.idmedicamento
    INNER JOIN inventario I ON I.idinventario = medicamentos.idmedicamento
    WHERE I.stock > 0
    GROUP BY medicamentos.idmedicamento
    ORDER BY cantidad_busquedas DESC
    LIMIT 6";

$result_medi_masBusca = $conexion->query($sql_medi_masBusca);

// Verifica si hay resultados en la consulta
if ($result_medi_masBusca->num_rows > 0) {
    while ($row_medi_masBusca = $result_medi_masBusca->fetch_assoc()) {
        $id_medicamento_medi_masBusca = $row_medi_masBusca['idmedicamento'];
        $id_ofuscado_medi_masBusca = base64_encode($id_medicamento_medi_masBusca);
?>
        <button class="abrirDetalles_medicamentos" data-im='<?php echo $id_ofuscado_medi_masBusca; ?>'>
            <?php echo $row_medi_masBusca['nombre']; ?>
        </button>
<?php
    }
} else {
    echo "No se encontraron medicamentos mas buscados.";
}
