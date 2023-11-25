<?php
include "../config/Conexion.php";

if (isset($_POST['id'])) {
  $id = $_POST["id"];

  $consulta=mysqli_query($conexion, "SELECT * FROM domiciliario 
  WHERE EstadoAcept='$id'");

  if($consulta){
    if(mysqli_num_rows($consulta) > 0){
      while($row= mysqli_fetch_assoc($consulta)){

        $idUser= $row["idusuario"];
       $SacarId= mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario='$idUser'");
       $raw= mysqli_fetch_assoc($SacarId);
      echo '
      <section class="ventana-datos">
        <i class="bx bx-x cerrarr"></i>
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
              <p>+57 '.$raw["telfono"].'</p>
              <p>' . $row["correo"] . '</p>
              <p>Direccion</p>
              <div class="redirec">' . $row["Ddireccion"]. '</div>
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
                  <p>' . $raw["tipovehiculo"].'</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Tarjeta de propiedad</p>
                  <a href="'.$raw["tarjetaPropiedad"].'" target="_blank">Visualizar archivo</a>
                </div>
                <h2>Datos Bancarios</h2>
                <div class="IGparte1_contain">
                  <p>Tipo de cuenta</p>
                  <p>'.$raw["tipoCuenta"].'</p>
                </div>
              </section>
              <section class="infoG_parte2 ecoeco">
                <div class="IGparte1_contain">
                  <p>Soat</p>
                   <a href="'.$raw["soat"].'" target="_blank">Visualizar archivo</a>
                </div>
                <div class="IGparte1_contain">
                  <p>Licencia</p>
                   <a href="'.$raw["licencia"].'" target="_blank">Visualizar archivo</a>
                </div>
                <div class="IGparte1_contain">
                  <p>Numero de cuenta</p>
                  <p>'.$raw["numeroCuenta"].'</p>
                </div>
              </section>
              <section class="infoG_parte3">
                <div class="IGparte3_imagen">
                  <div class="contain_imagen_parte3">
                    <img src="'.$raw["fotovehiculo"].'" alt="">
                  </div>
                </div>
                <div class="IGparte3_botones">
                  <button class="IGparte3_boton_rechazar add">Rechazar</button>
                  <button class="IGparte3_boton_aceptar ree">Aceptar</button>
                </div>

              </section>
            </section>

          </div>
        </div>
        </div>
      </section>
      ';
      }
    }
  }
}
?>