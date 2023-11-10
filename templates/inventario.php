
<html>
<div class="modal-inventario">
<div class="productos-container">
    <div class="opciones-vol-busc">
    <i class="bx bx-chevron-left" onclick="closeModalInventario()"></i>
    <h1>Inventario</h1>
    <input type="text" id="filtroNombre" placeholder="Filtrar por nombre o Categoria"></div>
    <div class="scroll-inventario">
    <div class="articles-inventario">
    <?php
require_once 'config/Conexion.php';
$bd = new Conexion();
$conexion = $bd->getConexion();  // Debes asegurarte de que esto devuelve una instancia de mysqli
// Verifica si esto imprime una instancia válida de mysqli

    $sql = "SELECT m.idmedicamento, m.codigo, m.precio, m.nombre, m.precio, i.descripcion, i.fechavencimiento,i.stock, i.formaadministracion, i.instrucciones, i.lote, c.nombrecategoria as categoria, p.nombreproveedor as proveedor, i.formaadministracion, m.imagenprincipal
                        FROM medicamentos m
                        INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento
                        INNER JOIN categoria c ON i.idcategoria = c.idcategoria
                        INNER JOIN proveedor p ON i.idprovedor = p.idproveedor";

$result = mysqli_query($conexion, $sql);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo '
        <div class="manilla">
        <img src="uploads/imgProductos/'. $row['imagenprincipal'].'" alt="">
        <section class="seccion">
            <div class="articulo">
                <p><strong>Nombre:</strong> <span class="nombre-medicamentos">'. $row['nombre'].'</span></p>
                <p><strong>Descripcion:</strong> <span class="descripcion-medicamento">'. $row['descripcion'].'</span></p>
                <p><strong>Vencimiento:</strong> <span class="vencimiento-medicamento">'. $row['fechavencimiento'].'</span></p>
                <p><strong>Instrucciones:</strong> <span class="instrucciones-medicamento">'. $row['instrucciones'] .'</span></p>
            </div>
            <div class="articulo">
            <p><strong>Via de administracion:</strong> <span class="administracion-medicamento">'. $row['formaadministracion'] .'</span></p>
                <p><strong>Codigo:</strong> <span class="codigo-medicamento">'. $row['codigo'] .'</span></p>
                <p><strong>Categoria:</strong> <span class="categoria-medicamento">'. $row['categoria'].'</span></p>
                <p><strong>Proveedor:</strong> <span class="proveedor-medicamento">'. $row['proveedor'] .'</span></p>
                <p><strong>Lote:</strong> <span class="lote-medicamento">'. $row['lote'] .'</span></p>
                <p><strong>Precio:</strong> <span class="precio-medicamento">'. $row['precio'].' COP</span></p>
                <p><strong>Stock:</strong> <span class="stock-medicamento">'. $row['stock'] .'</span></p>
            </div>
        </section>
        <section class="botones">
            <button class="boton" onclick="editarMedicamento(\''. $row['idmedicamento'].'\')">
                <span class="box-editar">Editar</span>
            </button>
            <button class="boton" onclick="eliminarMedicamento(\''. $row['idmedicamento'].'\')">
                <span class="box-eliminar">Eliminar</span>
            </button>
        </section>
    </div>
    
        ';
        // <button class="boton" onclick="eliminarMedicamento(\''. $row['idmedicamento'].'\')">

    }if (mysqli_num_rows($result) == 0) {
        echo '<p>Inventario vacio.</p>';
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}
mysqli_close($conexion);
?>
</div></div></div></div></div>
</html>