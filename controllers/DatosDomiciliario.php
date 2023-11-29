<?php
include "../config/Conexion.php";

if (isset($_POST['id'])) {
  $id = $_POST["id"];

  $consulta=mysqli_query($conexion, "SELECT * FROM domiciliario 
  INNER JOIN usuarios ON domiciliario.idusuario = usuarios.idusuario
  WHERE iddomiciliario='$id'");

  if($consulta){
    if(mysqli_num_rows($consulta) > 0){
      while($row= mysqli_fetch_assoc($consulta)){

        $idUser= $row["idusuario"];
       $SacarId= mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario='$idUser'");
       $raw= mysqli_fetch_assoc($SacarId);
      echo '
        <i class="bx bx-x cerrarr" id="cerrarr"></i>
        <div class="datos_menu_parte2">
          <div class="datos_mp2_contacto">
            <div class="contain_datos_circulo">
              <div class="circulo_externo">
                <div class="circulo_interno">
                  <img src="'.$row["imagen"].'" alt="">
                </div>
              </div>
            </div>
            <div class="contain_contacto">
              Contacto
            </div>
            <div class="contain_info">
              <p>+57 '.$raw["telefono"].'</p>
              <p>' . $row["correo"] . '</p>
              <p>Direccion</p>
              <div class="redirec">' . $row["direccion"]. '</div>
            </div>
          </div>
          <div class="datos_mp2_infoGeneral">
            <section class="infoG_nombre">
              <h2>' . $raw["nombre"]. " ".$raw["apellido"]. '</h2>
              <h4>Aspirante a Domiciliario</h4>
            </section>
            <section class="infoG_datos">
              <section class="infoG_parte1 ecoeco">
                <div class="IGparte1_contain">
                  <p>Tipo de vehiculo</p>
                  <p>' . $row["tipovehiculo"].'</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Tarjeta de propiedad</p>
                  <a href="'.$row["tarjetaPropiedad"].'" target="_blank">Visualizar archivo</a>
                </div>
                <h2>Datos Bancarios</h2>
                <div class="IGparte1_contain">
                  <p>Tipo de cuenta</p>
                  <p>'.$row["tipoCuenta"].'</p>
                </div>
              </section>
              <section class="infoG_parte2 ecoeco">
                <div class="IGparte1_contain">
                  <p>Soat</p>
                   <a href="'.$row["soat"].'" target="_blank">Visualizar archivo</a>
                </div>
                <div class="IGparte1_contain">
                  <p>Licencia</p>
                   <a href="'.$row["licencia"].'" target="_blank">Visualizar archivo</a>
                </div>
                <div class="IGparte1_contain">
                  <p>Numero de cuenta</p>
                  <p>'.$row["numeroCuenta"].'</p>
                </div>
              </section>
              <section class="infoG_parte3">
                <div class="IGparte3_imagen">
                  <div class="contain_imagen_parte3">
                    <img src="'.$row["fotovehiculo"].'" alt="">
                  </div>
                </div>
                <div class="IGparte3_botones">
                <button class="IGparte3_boton_rechazar add" id="confirmo-rechazar-domi" data-id="' . $id . '">Rechazar</button>
                <button class="IGparte3_boton_aceptar ree" id="confirm-accept-domi" data-id="' . $id . '">Aceptar</button>
                </div>

              </section>
            </section>

          </div>
        </div>
        </div>
      ';
      }
    }
  }
}
?>

<script>

  function cerrar() {
    document.getElementById('cerrarr').addEventListener('click', () => {
      document.querySelector('.viltrum').classList.remove('flex');
    });
  }

  var tabla = "Domiciliario";
  var diseño = document.getElementById("CargaDiseño");


  // Agregar evento clic al botón "Aceptar"
  document.getElementById('confirm-accept-domi').addEventListener('click', () => {
    // Mostrar la alerta
    document.getElementById('datos-solicitud').classList.add('none');
    document.getElementById('alerta-ac').classList.add('show');

    // Agregar evento clic al botón "Cancelar" en la alerta
    document.getElementById('cancel-accept').addEventListener('click', () => {
      document.getElementById('alerta-ac').classList.remove('show');
      document.getElementById('datos-solicitud').classList.remove('none');
    });

    // Agregar evento clic al botón "Aceptar" en la alerta
    document.getElementById('confirm-acceptboton').addEventListener('click', () => {
      // Recuperar el ID de la solicitud
      const solicitudId = document.getElementById('confirm-accept-domi').getAttribute('data-id');
      diseño.classList.add("flex");

      // Realizar una llamada AJAX para actualizar la base de datos
      $.ajax({
        type: "POST",
        url: "../controllers/AceptarSolicitud.php", // Asegúrate de tener el controlador adecuado
        data: {
          id_domiciliario: solicitudId,
          tabla: tabla,
        },
        success: function (response) {
          diseño.classList.remove("flex");
          document.querySelector('.viltrum').classList.remove('flex');
          document.getElementById('alerta-ac').classList.remove('show');
          document.getElementById('datos-solicitud').classList.remove('none');
          // Lógica después de la actualización (puedes recargar la página o realizar otras acciones)
          alert(response);
        },
        error: function (error) {
          console.error("Error al aceptar la solicitud:", error);
        }
      });

      // Ocultar la alerta
    });
  });

  // Agregar evento clic al botón "Rechazar"
  document.getElementById('confirmo-rechazar-domi').addEventListener('click', () => {

    document.getElementById('datos-solicitud').classList.add('none');
    document.getElementById('alerta-dene').classList.add('show');

    // Agregar evento clic al botón "Cancelar" en la alerta
    document.getElementById('cancel-rechazar').addEventListener('click', () => {
      document.getElementById('alerta-dene').classList.remove('show');
      document.getElementById('datos-solicitud').classList.remove('none');
    });

    document.getElementById('confirm-rechazar').addEventListener('click', () => {
      // Recuperar el ID de la solicitud
      const solicitudId = document.getElementById('confirmo-rechazar-domi').getAttribute('data-id');
      // Recuperar el motivo de rechazo
      const motivoRechazo = document.getElementById('miTextarea').value;

      console.log(motivoRechazo);

      diseño.classList.add("flex");

      // Realizar una llamada AJAX para manejar el rechazo
      $.ajax({
        type: "POST",
        url: "../controllers/rechazarSolicitud.php", // Asegúrate de tener el controlador adecuado
        data: {
          id_domicc: solicitudId,
          motivo: motivoRechazo,
          tabla: tabla
        },
        success: function (response) {
          diseño.classList.remove("flex");
          document.querySelector('.viltrum').classList.remove('flex');
          document.getElementById('alerta-dene').classList.remove('show');
          document.getElementById('datos-solicitud').classList.remove('none');
          // Lógica después de manejar el rechazo
          alert("Solicitud rechazada correctamente.");
        },
        error: function (error) {
          console.error("Error al rechazar la solicitud:", error);
        }
      });
    });
  });

  // Agregar evento clic al botón "Cancelar" en la alerta de rechazo
  document.getElementById('cancel-rechazar').addEventListener('click', () => {
    document.getElementById('alerta-dene').classList.remove('show');
    document.getElementById('datos-solicitud').classList.remove('none');
  });

  cerrar();
</script>