<?php
require_once '../config/Conexion.php';
$bd = new Conexion();
$conexion = $bd->getConexion();  // Obtener la conexión a la base de datos


// Consulta para obtener los nombres de las categorías
$result_categorias = mysqli_query($conexion, "SELECT idcategoria, nombrecategoria FROM categoria");
$categorias = mysqli_fetch_all($result_categorias, MYSQLI_ASSOC);

// Consulta para obtener los nombres de los proveedores
$result_proveedores = mysqli_query($conexion, "SELECT idproveedor, nombreproveedor FROM proveedor");
$proveedores = mysqli_fetch_all($result_proveedores, MYSQLI_ASSOC);


?>
<div class="cont-form">
    <!-- Cerrar Formulario -->
    <div class="options-form">
    <i class="bx bx-chevron-left" onclick="closeFormMedicine()"></i>
    <!-- <i class="bx bx-brush" onclick="cleanFormMedicine()"></i> -->
    </div>
    <form id="medicineAdd" onsubmit="sendForm(event, 'medicineAdd', '../controllers/medicineAdd.php' )" class="formAM"
        enctype="multipart/form-data">
        <div class="inputallimg">
            <div class="cont-inputimg">
                <div class="inputImg">
                    <label for="fotoFrontal" class="custom-button">Foto Frontal</label>
                    <input type="file" id="fotoFrontal" name="img[]" class="custom-file-input" accept="image/*" required />
                    <span class="no-file-selected">Selecciona una imagen.</span>
                </div>
                <div class="inputImg">
                    <label for="fotoTrasera" class="custom-button">Foto Trasera</label>
                    <input type="file" id="fotoTrasera" name="img[]" class="custom-file-input" accept="image/*" required />
                    <span class="no-file-selected">Selecciona una imagen.</span>
                </div>
            </div>
            <div class="cont-inputimg">
                <div class="inputImg">
                    <label for="fotoIzquierda" class="custom-button">Foto Izquierda</label>
                    <input type="file" id="fotoIzquierda" name="img[]" class="custom-file-input" accept="image/*" required />
                    <span class="no-file-selected">Selecciona una imagen.</span>
                </div>
                <div class="inputImg">
                    <label for="fotoDerecha" class="custom-button">Foto Derecha</label>
                    <input type="file" id="fotoDerecha" name="img[]" class="custom-file-input" accept="image/*" required />
                    <span class="no-file-selected">Selecciona una imagen.</span>
                </div>
            </div>
        </div>

        <div class="content-inputall">
            <div class="Adjustment">

                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="cum">Código:</label>
                        <input type="number" placeholder="CUM" name="cum" id="cum" required/>
                    </div>
                    <div class="inputFormAM">
                        <label for="medicineName">Nombre:</label>
                        <input type="text" id="medicineName" placeholder="Medicina" name="medicineName" require/>
                    </div>



                    <div class="inputFormAM">
                        <label for="priceMedicine">Precio:</label>
                        <input type="number" name="priceMedicine" placeholder="COP" required/>
                    </div>
                    <div class="inputFormAM">
                        <label for="loteMedicine">Lote:</label>
                        <input type="number" id="loteMedicine" name="loteMedicine" required/>
                    </div>
                    <div class="inputFormAM">
                        <label for="StockMedicine">cantidad:</label>
                        <input type="number" id="StockMedicine" name="StockMedicine" required/>
                    </div>
                </div>
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="descriptionMedicine">Descripción:</label>
                        <textarea id="descriptionMedicine" cols="30" rows="10" name="description" required></textarea>
                    </div>
                    <div class="inputFormAM">
                        <label for="instructionMedicine">Instrucciones:</label>
                        <textarea name="instructionMedicine" id="instructionMedicine" cols="30" rows="10" required></textarea>
                    </div>

                </div>

            </div>
            <div class="Adjustment">
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="expirationDate">Fecha de expiración:</label>
                        <input type="date" name="expirationDate"  required/>
                    </div>
                </div>
                <div class="distributecontent">
                    <div class="inputFormAM">
                        <label for="formaAdminis">Forma Administracion:</label>
                        <input type="text" id="formaAdminis" name="formaAdminis" required/>
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

