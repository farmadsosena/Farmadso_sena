<html lang="en">



    <div class="categoriasedit">
        <i class="bx bx-chevron-left" onclick="closeFormCategories()"></i>

        <form id="categoryedit"  > 
            <!-- Recibe datos por medio de consulta -->
            <section class="separadores">
                <label for="">Nombre categoria</label>
                <input type="text" name="nombrecategoria" placeholder="Ingresa nombre categoria" class="input" id="nombrecategoria">
            </section>
            <section class="separadores">
                <label for="">Descripcion</label>
                <input type="text" name="descripcion" placeholder="Descripción" class="input" id="descripcion">
            </section>
            <section class="separadores">
                <label for=""> Agregar imagen:</label>
                <input type="file"  name="imgCategory" accept="image/*" id="imagen" />
            </section>


            <input type="submit" value="Actualizar Categoria" class="boton_aggcategoria">

        </form>

</div>
<script src="../assets/js/medicamentos-Form.js"></script>
</html>