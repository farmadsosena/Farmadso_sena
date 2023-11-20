
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

?>
<!DOCTYPE html>
<html lang="en">

<?php
?>
<div class="cont-editar-medicamento">
    <!-- Cerrar Formulario -->
    <div class="options-form">
    <i class="bx bx-chevron-left" onclick="closeEditar()"></i>
    </div>
<form id="medicineEdit" onsubmit="sendForm(event, 'medicineEdit', 'controllers/medicineEdit.php' )" class="formAM" enctype="multipart/form-data"  >


    <div class="content-inputall">
        <div class="Adjustment">
            <div class="distributecontent">
                <div class="inputFormAM">
                    <input type="hidden" id="fechaexp" name="expirationDate" value="">
                    <input type="hidden" id="medimanetId" name="idmedicamento" value="">
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
                    <input type="number" name="priceMedicine" id="priceMedicinee">
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
                    <select name="categorye" id="categorye" class="select-custom">
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
                    <select name="provideMedicine" id="provideMedicinee" class="select-custom">
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

    <button class="btn-registrar">Actualizar Medicamento</button>
</form>
                    </div>
</html>