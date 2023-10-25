
<html>
<div class="modal-inventario">
<div class="productos-container">
    <div class="opciones-vol-busc">
    <i class="bx bx-chevron-left" onclick="closeModalInventario()"></i>
    <input type="text" id="filtroNombre" placeholder="Filtrar por nombre o código"></div>
    <div class="scroll-inventario">
    <div class="articles-inventario">
    <?php
require_once 'config/Conexion.php';
$bd = new Conexion();
$conexion = $bd->getConexion();  // Debes asegurarte de que esto devuelve una instancia de mysqli
// Verifica si esto imprime una instancia válida de mysqli

    $sql = "SELECT m.codigo, m.nombre, m.precio, i.descripcion, i.fechavencimiento,i.stock, i.instrucciones, i.lote, c.nombrecategoria as categoria, p.nombreproveedor as proveedor, i.formaadministracion, m.imagenprincipal
                        FROM medicamentos m
                        INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento
                        INNER JOIN categoria c ON i.idcategoria = c.idcategoria
                        INNER JOIN proveedor p ON i.idprovedor = p.idproveedor";

$result = mysqli_query($conexion, $sql);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo '
            <div class="manilla">
            <img src="uploads/imgProductos/' . $row["imagenprincipal"] . '" alt="">
                <section class="seccion">
                <div class="articulo">
                                        <p><strong>Nombre:</strong> <span class="nombre-medicamentos">' . $row["nombre"] . '</span></p>
                                        <p><strong>Descripcion:</strong> ' . $row["descripcion"] . '</p>
                                        <p><strong>Vencimiento:</strong> ' . $row["fechavencimiento"] . '</p>
                                        <p><strong>Instrucciones:</strong> ' . $row["instrucciones"] . '</p>
                                    </div>
                                    <div class="articulo">
                                        <p><strong>Categoria:</strong> <span class="categoria-medicamento">' . $row["categoria"] . '</span></p>
                                        <p><strong>Proveedor:</strong> ' . $row["proveedor"] . '</p>
                                        <p><strong>Lote:</strong> ' . $row["lote"] . '</p>
                                        <p><strong>Stock:</strong> ' . $row["stock"] . '</p>
                                    </div>
                </section>
                <section class="botones">
                    <button class="boton">
                        <span class="box-editar">
                            Editar
                        </span>
                    </button>
                    <button class="boton">
                        <span class="box-eliminar">
                            Eliminar
                        </span>
                    </button>
                </section>
            </div>
        ';
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
mysqli_close($conexion);
?>

</html>