<?php
session_start(); // Iniciar la sesión
include("../config/Conexion.php");
$id_usuario = $_SESSION['id'];
$con1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id_usuario'");
$user = mysqli_fetch_assoc($con1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi cuenta</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../assets/css/configuracion.css" />
</head>

<body>

<?php echo  $id_usuario ?>
  <div id="menu">
    <h2 class="title-cuenta">Mi cuenta</h2>

    <div class="contenedor-pestañas cuenta">
      <h4>Tu cuenta</h4>

      <div class="opc">
        <div class="tab" onclick="mostrarContenido('miperfil')">
          <img src="../assets/svg/perfil-usuario.svg" alt="" /> Mi perfil
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('misdirecciones')">
          <img src="../assets/svg/direccion.svg" alt="" /> Mis direcciones
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick="mostrarContenido('cambiarcontrasena')">
          <img src="../assets/svg/candado.svg" alt="" /> Cambia tu contraseña
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('notificaciones')">
          <img src="../assets/svg/notificaciones.svg" alt="" /> Notificaciones
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick="mostrarContenido('misfavoritos')">
          <img src="../assets/svg/favorite.svg" alt="" /> Mis favoritos
        </div>
      </div>
    </div>

    <div class="contenedor-pestañas ayuda">
      <h4>Ajustes y ayuda</h4>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('politicas')">
          <img src="../assets/svg/privacidad.svg" alt="" /> Politicas de
          privacidad
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('soporte')">
          <img src="../assets/svg/soporte.svg" alt="" /> Soporte
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('contactenos')">
          <img src="../assets/svg/contacto.svg" alt="" /> Contáctenos
        </div>
      </div>

      <div class="opc">
        <div class="tab" onclick=" mostrarContenido('cerrarsesion')">
          Cerrar sesión
        </div>
      </div>
    </div>
  </div>

  <div id="contenido">
    <div id="miperfil" class="contenido-pestaña">
      <div class="vane">
        <div class="perfil">
          <img src="./assets/svg/perfil-usuario.svg" alt="" />
          <div class="datos">
            <p class="nn"><?php echo $user['nombre'];?> <?php echo $user['apellido']; ?></p>
            <p><?php echo $user['correo']; ?></p>
          </div>
        </div>

        <form class="formdatos" action="../controllers/editar_perfil.php" method="POST">

        <input type="hidden" name="user" value='<?php echo $id_usuario ?>'>

          <div class="left">
            <div class="dato">
              <p>Nombre</p>
              <input class="nn" name="nombre" type="text" value="<?php echo $user['nombre']; ?>">
            </div>

            <div class="dato">
              <p>Correo</p>
              <input class="nn" name="correo" type="text" value="<?php echo $user['correo']; ?>">
            </div>

            <div class="dato">
              <p>Documento</p>
              <input class="nn" name="documento" type="text" value="<?php echo $user['documento']; ?>">
              <!-- <p>Para solicitar el cambio de su cedula haz clic aqui</p> -->
            </div>

            <!-- <div class="genero">
                <p>Genero</p>
                <div class="gnr-campo">
                  <input type="radio" />
                  <label for="">Maculino</label>
                  <input type="radio" />
                  <label for="">Femenino</label>
                </div>
              </div> -->
          </div>

          <div class="right">
            <div class="dato">
              <p>Apellido</p>
              <input class="nn" name="apellido" type="text" value="<?php echo $user['apellido']; ?>">
            </div>

            <div class="celu">
              <p>Celular</p>

              <div class="pais">
                <!-- <select name="" id="">
                    <option value="">+57</option>
                    <option value="">+1</option>
                    <option value="">+58</option>
                  </select> -->

                  <input class="nn" name="telefono" type="text" value="<?php echo $user['telefono']; ?>">
              </div>

              <div class="nacimiento">
                <!-- <p>Fecha de nacimiento</p>

                  <div>
                    <select name="" id="">
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select>

                    <select name="" id="">
                      <option value="">Enero</option>
                      <option value="">Febrero</option>
                      <option value="">Marzo</option>
                    </select>

                    <select name="" id="">
                      <option value="">2000</option>
                      <option value="">2002</option>
                      <option value="">2004</option>
                    </select>
                  </div> -->

                <span>
                  <button>Guardar cambios</button>
                </span>

              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div id="misdirecciones" class="contenido-pestaña">
      <div class="direcciones">
        <h3>Mis direcciones</h3>

        <div class="btn-direccion">
          <button id="openModalBtn">Agregar nueva dirección</button>
        </div>
      </div>

      <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close">&times;</span>
          <h2>Agregar dirección</h2>
          <label for="cityInput"> <i class="fas fa-city"></i> Ciudad: </label>
          <input type="text" id="cityInput" placeholder="Ingresa la ciudad" style="width: 90%" />
          <label for="addressInput">
            <i class="fas fa-map-marker-alt"></i> Dirección:
          </label>
          <input type="text" id="addressInput" placeholder="Ingresa la dirección" style="width: 90%" />
          <label for="imageInput"> </label>
          <img src="./assets/img/gps.jpg" alt="Imagen" style="width: 100%" />

          <div class="address-fields">
            <div class="field">
              <label for="floorInput">
                <i class="fas fa-building"></i> Piso/Oficina/Apto:
              </label>
              <input type="text" id="floorInput" placeholder="Escribe el piso/oficina/apto" style="width: 45%" />
            </div>
            <div class="field">
              <label for="nameInput">
                <i class="fas fa-user"></i> Nombre de dirección:
              </label>
              <input type="text" id="nameInput" placeholder="Escribe el nombre de la dirección" style="width: 45%" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="cambiarcontrasena" class="contenido-pestaña">
      <div class="contraseña">
        <form class="form-contraseña" action="">
          <p>Cambiar de contraseña</p>

          <input class="contraseña-actual" type="text" placeholder="Contraseña actual" />

          <div class="nueva-cntrs">
            <input type="text" placeholder="Nueva contraseña" />
            <input type="text" placeholder="Confirme su contraseña" />
          </div>

          <button>Guardar</button>
        </form>
      </div>
    </div>

    <div id="notificaciones" class="contenido-pestaña">
      Contenido de la Pestaña 1
    </div>

    <div id="misfavoritos" class="contenido-pestaña">
      Contenido de la Pestaña 3
    </div>

    <div id="politicas" class="contenido-pestaña">
      Contenido de la Pestaña politicas
    </div>

    <div id="soporte" class="contenido-pestaña">
      Contenido de la Pestaña soporte
    </div>

    <div id="contactenos" class="contenido-pestaña">
      Contenido de la Pestaña contactenos
    </div>

    <div id="cerrarsesion" class="contenido-pestaña">
      Contenido de la Pestaña cerrar secion
    </div>
  </div>

  <script src="../assets/js/micuenta.js"></script>

  <script src="../assets/js/VentanaAgregaUnaDireccion.js"></script>
</body>

</html>