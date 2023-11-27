<?php
include "../config/Conexion.php";

if (isset($_POST['id'])) {
  $id = $_POST["id"];

  $consulta=mysqli_query($conexion, "SELECT * FROM farmacias 
  WHERE IdFarmacia='$id'");

  if($consulta){
    if(mysqli_num_rows($consulta) > 0){
      while($row= mysqli_fetch_assoc($consulta)){

        $idUser= $row["idusuario"];
       $SacarId= mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario='$idUser'");
       $raw= mysqli_fetch_assoc($SacarId);
      echo '
      <section class="ventana-datos">
        <i class="bx bx-x cerrarr" id="cerrar-ventanda-datos"></i>
        <div class="datos_menu_parte2">
          <div class="datos_mp2_contacto">
            <div class="contain_datos_circulo">
              <div class="circulo_externo">
                <div class="circulo_interno">
                  <img src="' . $raw["imgUser"] . '" alt="">
                </div>
              </div>
            </div>
            <div class="contain_contacto">
              Contacto
            </div>
            <div class="contain_info">
              <p>' . $row["correo"] . '</p>
              <p>' . $row["telefono"] . '</p>
              <p>Direccion</p>
              <div class="redirec">' . $row["Direccion"]. '</div>
            </div>
          </div>
          <div class="datos_mp2_infoGeneral">
            <section class="infoG_nombre">
              <h2>' . $raw["nombre"]. " ".$raw["apellido"]. '</h2>
              <h4>Aspirante a cuenta para Farmaceutico</h4>
            </section>
            <section class="infoG_datos">
              <section class="infoG_parte1 ecoeco">
                <div class="IGparte1_contain">
                  <p> Nombre farmacia</p>
                  <p>' .$row["Nombre"]. '</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Codigo NIT de la EPS</p>
                  <p> ' . $row["nitEPS"] . '</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Direccion Farmacia</p>
                  <p>' . $row["Direccion"] . '</p>
                </div>
              </section>
              <section class="infoG_parte2 ecoeco">
                <div class="IGparte1_contain">
                  <p>Codigo Postal</p>
                  <p>'.$row["codigoPostal"].'</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Departamento</p>
                  <p>'.$row["Departamento"].'</p>
                </div>
                <div class="IGparte1_contain">
                  <p>Ciudad</p>
                  <p>'.$row["ciudad"].'</p>
                </div>
              </section>
              <section class="infoG_parte3">
                <div class="IGparte3_imagen">
                  <div class="contain_imagen_parte3">
                    <img src="' . $row["imgfarmacia"] . '" alt="">
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
      </section>
      
      
      ';
      }
    }
  }
}
?>