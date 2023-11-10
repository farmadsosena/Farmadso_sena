<?php
require_once 'config/Conexion.php';
$bd = new Conexion();
$conexion = $bd->getConexion();  // Obtener la conexión a la base de datos

// Consulta para obtener los nombres de las categorías
$result_categorias = mysqli_query($conexion, "SELECT idcategoria, nombrecategoria FROM categoria");
$categorias = mysqli_fetch_all($result_categorias, MYSQLI_ASSOC);

// Consulta para obtener los nombres de los proveedores
$result_proveedores = mysqli_query($conexion, "SELECT idproveedor, nombreproveedor FROM proveedor");
$proveedores = mysqli_fetch_all($result_proveedores, MYSQLI_ASSOC);

if(isset($_GET['id'])) {
    $idMedicamento = $_GET['id'];
    
    $sql = "SELECT m.codigo, m.precio, m.nombre, i.descripcion, i.fechavencimiento, i.stock, i.instrucciones, i.lote, c.nombrecategoria as categoria, p.nombreproveedor as proveedor, i.formaadministracion, m.imagenprincipal
            FROM medicamentos m
            INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento
            INNER JOIN categoria c ON i.idcategoria = c.idcategoria
            INNER JOIN proveedor p ON i.idprovedor = p.idproveedor
            WHERE m.idmedicamento = $idMedicamento";
    
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $codigo = 123;
        $precio = $row['precio'];
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $fechavencimiento = $row['fechavencimiento'];
        $stock = $row['stock'];
        $instrucciones = $row['instrucciones'];
        $lote = $row['lote'];
        $categoria = $row['categoria'];
        $proveedor = $row['proveedor'];
        $formaadministracion = $row['formaadministracion'];
        $imagenprincipal = $row['imagenprincipal'];
    }
}

mysqli_close($conexion); // Cerrar la conexión
?>
<div class="cont-editar-medicamento">
    <!-- Cerrar Formulario -->
    <div class="options-form">
    <i class="bx bx-chevron-left" onclick="closeEditar()"></i>
    </div>
<form id="medicineEdit" onsubmit="EditMedicament(event, 'medicineEdit', 'controllers/medicineEdit.php' )" class="formAM" enctype="multipart/form-data">
    <div class="inputallimg">
        <div class="cont-inputimg">
            <div class="inputImg">
                <label for="fotoFrontal" class="custom-button">Foto Frontal</label>
                <input type="file" id="fotoFrontal" name="img[]" class="custom-file-input" accept="image/*" />
                <span class="no-file-selected">Selecciona una imagen.</span>
            </div>
            <div class="inputImg">
                <label for="fotoTrasera" class="custom-button">Foto Trasera</label>
                <input type="file" id="fotoTrasera" name="img[]" class="custom-file-input" accept="image/*" />
                <span class="no-file-selected">Selecciona una imagen.</span>
            </div>
        </div>
        <div class="cont-inputimg">
            <div class="inputImg">
                <label for="fotoIzquierda" class="custom-button">Foto Izquierda</label>
                <input type="file" id="fotoIzquierda" name="img[]" class="custom-file-input" accept="image/*" />
                <span class="no-file-selected">Selecciona una imagen.</span>
            </div>
            <div class="inputImg">
                <label for="fotoDerecha" class="custom-button">Foto Derecha</label>
                <input type="file" id="fotoDerecha" name="img[]" class="custom-file-input" accept="image/*" />
                <span class="no-file-selected">Selecciona una imagen.</span>
            </div>
        </div>
    </div>

    <div class="content-inputall">
        <div class="Adjustment">
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="cum">Código:</label>
                    <input type="number" placeholder="CUM" name="cum" id="cumme" value="<?php echo isset($codigo) ? $codigo : ''; ?>" required/>
                </div>
                <div class="inputFormAM">
                    <label for="medicineName">Nombre:</label>
                    <input type="text" id="medicineNamee" placeholder="Medicina" name="medicineName" value="<?php echo isset($nombre) ? $nombre : ''; ?>" />
                </div>

                <div class="inputFormAM">
                    <label for="priceMedicine">Precio:</label>
                    <input type="number" id="priceMedicinee" name="priceMedicine" placeholder="COP" value="<?php echo isset($precio) ? $precio : ''; ?>" />
                </div>
                <div class="inputFormAM">
                    <label for="loteMedicine">Lote:</label>
                    <input type="number" id="loteMedicinee" name="loteMedicine" value="<?php echo isset($lote) ? $lote : ''; ?>" />
                </div>
                <div class="inputFormAM">
                    <label for="StockMedicine">cantidad:</label>
                    <input type="number" id="StockMedicinee" name="StockMedicine" value="<?php echo isset($stock) ? $stock : ''; ?>" />
                </div>
            </div>
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="descriptionMedicine">Descripción:</label>
                    <textarea id="descriptionMedicinee" cols="30" rows="10" name="description"><?php echo isset($descripcion) ? $descripcion : ''; ?></textarea>
                </div>
                <div class="inputFormAM">
                    <label for="instructionMedicine">Instrucciones:</label>
                    <textarea name="instructionMedicine" id="instructionMedicinee" cols="30" rows="10"><?php echo isset($instrucciones) ? $instrucciones : ''; ?></textarea>
                </div>
            </div>
        </div>
        <div class="Adjustment">
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="expirationDate">Fecha de expiración:</label>
                    <input type="date" name="expirationDatee" value="<?php echo isset($fechavencimiento) ? $fechavencimiento : ''; ?>" />
                </div>
            </div>
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="formaAdminis">Forma Administracion:</label>
                    <input type="text" id="administrae" name="formaAdminis" value="<?php echo isset($formaadministracion) ? $formaadministracion : ''; ?>" />
                </div>
            </div>
        </div>
        <div class="Adjustments">
            <div class="distributecontent">
                <div class="inputFormAMS">
                    <label for="category">Selecciona la categoria del medicamento:</label>
                    <select name="category" id="categorye" class="select-custom">
                        <?php 
                        foreach ($categorias as $categoria) {
                            $selected = (isset($categoria) && $categoria == $categoria['nombrecategoria']) ? 'selected' : '';
                            echo '<option value="' . $categoria['idcategoria'] . '" ' . $selected . '>' . $categoria['nombrecategoria'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="distributecontent">
                <div class="inputFormAMS">
                    <label for="provideMedicine">Selecciona el proveedor:</label>
                    <select name="provideMedicine" id="provideMedicine" class="select-custom">
                        <?php 
                        foreach ($proveedores as $proveedor) {
                            $selected = (isset($proveedor) && $proveedor == $proveedor['nombreproveedor']) ? 'selected' : '';
                            echo '<option value="' . $proveedor['idproveedor'] . '" ' . $selected . '>' . $proveedor['nombreproveedor'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn-registrar" onclick="actualizaxDatos()">Actualizar Medicamento</button>
</form>
                    </div>