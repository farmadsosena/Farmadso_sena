<?php

include "../config/Conexion.php";


if (isset($_POST["id_editar"])) {
  $id = $_POST["id_editar"];

  $sql = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario='$id'");

  if ($sql) {
    if (mysqli_num_rows($sql) > 0) {

      $row = mysqli_fetch_assoc($sql);
      $nombre = $row["nombre"];
      $apellido= $row["apellido"];
      $estado = $row["estado"];
      $img = $row["imgUser"];
      $correo = $row["correo"];
      $telefono = $row["telefono"];


      if (!empty($img)) {
        $img = $row["imgUser"];
      } else {
        $img = "../assets/img/aaaa.jpeg";
      }

      ?>
      <section class="perfil" id="perfil" data-id="<?php echo $id ?>">
        <header>
          <h3>Editar mi perfil</h3>
          <div class="x" id="x">
            <img
              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAzElEQVRIS+1T2w2DMBCDDToKbEBHYANGYKMyQjfoCh2FEbAlqCDcC6GoP0G6D5LIPvt8dZX5qzPjV4XAdfjvFg1ocTLafOCuQ721N5YCgr9QX1QrABD8g2pQvUZiEewBUpL07gmCWVLhzUAiCYOT0CPgmxSQZ7SFqtTONzURgpSE/yHwqAKNQBr8aQwRBZZFLolHIA2UXW7x1CL8U3IlpvuBWhE+2BRdNCkttxeNnYyoSVuiNcKdtsVXUiQtaejMG3IIxHpUCFwLs1u0AGgKLRkwP5Q0AAAAAElFTkSuQmCC" />
          </div>
        </header>
        <section class="cuerpo">
          <section class="scroll">
            <div class="sap">
              <h3>Nombre</h3>
              <input type="text" id="nombre_edit" value="<?php echo $nombre ?>">
            </div>
            <div class="sap">
              <h3>Apellido</h3>
              <input type="text" id="apellido_edit" value="<?php echo $apellido ?>">
            </div>
            <div class="img-f">
              <h3>Imagen de cuenta (Opcional)</h3>
              <div class="img-sd">
                <div class="reconocer" id="mostrar">
                  <img src="<?php echo $img ?>">
                </div>
                <div class="kl">
                  <label for="imagen" class="subir">Subir foto</label>
                  <input type="file" id="imagen" accept=".png, .jpg">
                </div>
              </div>
            </div>
            <div class="sap">
              <h3>Email</h3>
              <input type="email" id="email_edit" value="<?php echo $correo ?>">
            </div>
            <div class="sap">
              <h3>Telefono</h3>
              <input type="tel" id="telefono_edit" value="<?php echo $telefono ?>">
            </div>
            <h3>Tipo de documento de identidad</h3>
            <select id="documento_edit">
              <?php
              $slr = mysqli_query($conexion, "SELECT * FROM tipodocumento");
              if ($slr) {
                while ($row = mysqli_fetch_assoc($slr)) {
                  $id = $row["IdDocumento"];
                  $nombre = $row["NombreDocu"];
                  echo '<option value="' . $id . '">' . $nombre . '</option> ';
                }
              }
              ?>
            </select>
            <button class="enviar" name="enviado" id="hacerEnviado">
              <p>Enviar</p>
            </button>
          </section>
        </section>
      </section>
      <?php
    } else {
    }
  }
}
?>

<script>

  function cerrarXX() {
    const fileInput = document.getElementById('imagen');
    const imageContainer = document.getElementById('mostrar');
    const defaultImage = '"../assets/img/aaaa.jpeg';
    const checkbox = document.getElementById('perfil');
    var userId = checkbox.getAttribute('data-id');

    document.getElementById('x').addEventListener('click', () => {
      document.getElementById('EditarUsuario').classList.remove('flex');
    });


    fileInput.addEventListener('change', function () {
      const file = this.files[0];

      if (file) {
        const reader = new FileReader();

        reader.addEventListener('load', function () {
          const imageUrl = reader.result;
          const image = new Image();

          image.addEventListener('load', function () {
            imageContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar la nueva imagen
            imageContainer.appendChild(image);
          });

          image.src = imageUrl;
        });

        reader.readAsDataURL(file);
      } else {
        // Si no se selecciona ninguna imagen, mostrar la imagen por defecto
        imageContainer.innerHTML = `<img src="${defaultImage}">`;
      }
    });

    $(document).ready(function() {
    $('#hacerEnviado').click(function() {
      // Obtener los valores de los campos
      var id = $('#perfil').data('id');
      var nombre = $('#nombre_edit').val();
      var apellido = $('#apellido_edit').val();
      var img = $('#imagen').val(); // Considera manejar la imagen adecuadamente si es necesario
      var correo = $('#email_edit').val();
      var telefono = $('#telefono_edit').val();
      var documento = $('#documento_edit').val();

      // Crear un objeto con los datos
      var datos = {
        id: id,
        apellido: apellido,
        nombre: nombre,
        img: img,
        correo: correo,
        telefono: telefono,
        documento: documento
      };

      console.log(datos);
      // Enviar los datos mediante AJAX
      $.ajax({
        type: 'POST',
        url: '../controllers/perfil.php',
        data: datos,
        success: function (response) {
          document.getElementById('EditarUsuario').classList.remove('flex');
          $("#iniciar").html(response);
          alert("Datos actualizados con exito")
        },
        error: function (error) {
          console.error('Error en la solicitud AJAX:', error);
        }
      });
      
    });
  });





  }

  cerrarXX();
</script>