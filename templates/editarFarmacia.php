

<div class="modalEditF">


<div class="containerEditarFarmacia">
<i class="bx bx-chevron-left bx-x" onclick="closeModalFarmaciaP()"></i>
    <h2 class="form-header">Tu Farmacia</h2>
    <form class="formularioFarmacia" action="../controllers/procesaEdicionFarmacia.php" method="post" enctype="multipart/form-data">
        <!-- Campos existentes en la tabla farmacias -->
        <div class="ajustaForm">
        <div class="datos-container">
            <input type="hidden" value="<?php echo $_SESSION["farm"]; ?>" name="idFarmacia">
        <div class="form-group">
            <label class="label-group" for="nombre">Nombre:</label>
            <input class="input-group" type="text" name="nombre" value="<?php echo $row["Nombre"]; ?>">
        </div>

        <div class="form-group">
            <label class="label-group" for="direccion">Dirección:</label>
            <input class="input-group" type="text" name="direccion" value="<?php echo $row["Direccion"]; ?>">
        </div>
        <div class="form-group">
            <label class="label-group" for="nombre">Correo:</label>
            <input class="input-group" type="text" name="correo" value="<?php echo $row["correo"]; ?>">
        </div>

        <div class="form-group">
            <label class="label-group" for="direccion">telefono:</label>
            <input class="input-group" type="text" name="telefono" value="<?php echo $row["telefono"]; ?>">
        </div>
        <div class="form-group">
            <label class="label-group" for="direccion">horario:</label>
            <input class="input-group" type="text" name="horario" value="<?php echo $row["horario"]; ?>">
        </div>

        <div class="form-group">
            <label class="label-group" for="direccion">codigo postal:</label>
            <input class="input-group" type="text" name="codigopostal" value="<?php echo $row["codigoPostal"]; ?>">
        </div>
        <div class="form-group">
            <label class="label-group" for="direccion">Ciudad:</label>
            <input class="input-group" type="text" name="ciudad" value="<?php echo $row["ciudad"]; ?>">
        </div>
        <div class="form-group">
            <label class="label-group" for="direccion">Departamento:</label>
            <input class="input-group" type="text" name="departamento" value="<?php echo $row["Departamento"]; ?>">
        </div>

        
        </div>
        <!-- Campo para cambiar la imagen -->
        <div class="imgandbuton">

        <img  src="../uploads/imgPerfilFarmacia/<?php echo $row["imgfarmacia"]; ?>" alt="">
        <div class="form-group2">
            <input class="input-group" type="file" name="imagen" accept="image/*" id="imagenInput" style="display: none;">
            <label class="custom-file-upload" for="imagenInput" id="customFileLabel">Cambiar imagen</label>
            <span id="selectedFileName"></span>

            <script>
            document.getElementById('imagenInput').addEventListener('change', function() {
                var input = this;
                var label = document.getElementById('customFileLabel');
                var fileNameSpan = document.getElementById('selectedFileName');

                if (input.files && input.files.length > 0) {
                    var fileName = input.files[0].name;
                    fileNameSpan.textContent = 'Imagen seleccionada: ' + fileName;
                } else {
                    fileNameSpan.textContent = '';
                }
            });
            </script>
        </div>
        </div>
        </div><div class="form-group2">
            <input class="btn-editar" type="submit" value="Guardar Cambios">
        </div>
    </form>
</div>
</div>