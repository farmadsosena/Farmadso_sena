
<?php
require_once 'config/Conexion.php';

try {
    $conexion = new PDO('mysql:host=localhost;dbname=farmadso', 'root', '');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los nombres de las categorías
    $result_categorias = $conexion->query("SELECT idcategoria, nombrecategoria FROM categoria");
    $categorias = $result_categorias->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener los nombres de los proveedores
    $result_proveedores = $conexion->query("SELECT idproveedor, nombreproveedor FROM proveedor");
    $proveedores = $result_proveedores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conexion = null; // Cerrar la conexión
?>

<div class="cont-form">
    <!-- Cerrar Formulario -->
    <i class="bx bx-chevron-left" onclick="closeFormMedicine()"></i>

    <form id="medicineAdd" onsubmit="sendForm(event, 'medicineAdd', 'controllers/medicineAdd.php' )" class="formAM"
        enctype="multipart/form-data">
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
                        <input type="number" placeholder="CUM" name="cum" id="cum" />
                    </div>
                    <div class="inputFormAM">
                        <label for="medicineName">Nombre:</label>
                        <input type="text" id="medicineName" placeholder="Medicina" name="medicineName" />
                    </div>



                    <div class="inputFormAM">
                        <label for="priceMedicine">Precio:</label>
                        <input type="number" name="priceMedicine" />
                    </div>
                    <div class="inputFormAM">
                        <label for="loteMedicine">Lote:</label>
                        <input type="number" id="loteMedicine" name="loteMedicine" />
                    </div>
                    <div class="inputFormAM">
                        <label for="StockMedicine">cantidad:</label>
                        <input type="number" id="StockMedicine" name="StockMedicine" />
                    </div>
                </div>
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="descriptionMedicine">Descripción:</label>
                        <textarea id="descriptionMedicine" cols="30" rows="10" name="description"></textarea>
                    </div>
                    <div class="inputFormAM">
                        <label for="instructionMedicine">Instrucciones:</label>
                        <textarea name="instructionMedicine" id="instructionMedicine" cols="30" rows="10"></textarea>
                    </div>

                </div>

            </div>
            <div class="Adjustment">
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="expirationDate">Fecha de expiración:</label>
                        <input type="date" name="expirationDate" />
                    </div>
                </div>
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="formaAdminis">Forma Administracion:</label>
                        <input type="text" id="formaAdminis" name="formaAdminis" />
                    </div>
                </div>
            </div>


            <div class="Adjustments">
            <div class="distributecontent">
                <div class="inputFormAMS">
                    <label for="category">Selecciona la categoria del medicamento:</label>
                    <select name="category" id="category" class="select-custom">
                        <?php 
                        foreach ($categorias as $categoria) {
                            echo '<option value="' . $categoria['idcategoria'] . '">' . $categoria['nombrecategoria'] . '</option>';
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
                            echo '<option value="' . $proveedor['idproveedor'] . '">' . $proveedor['nombreproveedor'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>


        </div>

        <button type="submit" class="btn-registrar">Registrar medicamento</button>

    </form>
</div>

<?php

?>