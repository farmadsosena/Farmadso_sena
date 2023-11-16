<!DOCTYPE html>
<html lang="en">

<?php
?>
<div class="cont-editar-medicamento">
    <!-- Cerrar Formulario -->
    <div class="options-form">
    <i class="bx bx-chevron-left" onclick="closeEditar()"></i>
    </div>
<form id="medicineEdit" method="post" class="formAM" enctype="multipart/form-data">
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
                    <input type="number" placeholder="CUM" name="cum" id="cumme" value=""/>
                </div>
                <div class="inputFormAM">
                    <label for="medicineName">Nombre:</label>
                    <input type="text" id="medicineNamee" placeholder="Medicina" name="medicineName" value="" />
                </div>
                <input type="hidden" id="expirationDatee" name="">
                <div class="inputFormAM">
                    <label for="priceMedicine">Precio:</label>
                    <input type="number" name="" id="priceMedicinee">
                </div>
                <div class="inputFormAM">
                    <label for="loteMedicine">Lote:</label>
                    <input type="number" id="loteMedicinee" name="loteMedicine" value="" />
                </div>
                <div class="inputFormAM">
                    <label for="StockMedicine">cantidad:</label>
                    <input type="number" id="StockMedicinee" name="StockMedicine" value="" />
                </div>
            </div>
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="descriptionMedicine">Descripción:</label>
                    <textarea id="descriptionMedicinee" cols="30" rows="10" name="description"></textarea>
                </div>
                <div class="inputFormAM">
                    <label for="instructionMedicine">Instrucciones:</label>
                    <textarea name="instructionMedicine" id="instructionMedicinee" cols="30" rows="10"></textarea>
                </div>
            </div>
        </div>
        <div class="Adjustment">
            
            <div class="distributecontent">
                <div class="inputFormAM">
                    <label for="formaAdminis">Forma Administracion:</label>
                    <input type="text" name="formaAdminis" id="administrae" value="" />
                </div>
            </div>
        </div>
        <div class="Adjustments">
            <div class="distributecontent">
                <div class="inputFormAMS">
                    <label for="category">Selecciona la categoria del medicamento:</label>
                    <select name="category" id="categorye" class="select-custom">
                        <?php 
                        // foreach ($categorias as $categoria) {
                        //     $selected = (isset($categoria) && $categoria == $categoria['nombrecategoria']) ? 'selected' : '';
                        //     echo '<option value="' . $categoria['idcategoria'] . '" ' . $selected . '>' . $categoria['nombrecategoria'] . '</option>';
                        // }
                        ?>
                    </select>
                </div>
            </div>
            <div class="distributecontent">
                <div class="inputFormAMS">
                    <label for="provideMedicine">Selecciona el proveedor:</label>
                    <select name="provideMedicine" id="provideMedicine" class="select-custom">
                        <?php 
                        // foreach ($proveedores as $proveedor) {
                        //     $selected = (isset($proveedor) && $proveedor == $proveedor['nombreproveedor']) ? 'selected' : '';
                        //     echo '<option value="' . $proveedor['idproveedor'] . '" ' . $selected . '>' . $proveedor['nombreproveedor'] . '</option>';
                        // }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn-registrar">Actualizar Medicamento</button>
</form>
                    </div>
</html>