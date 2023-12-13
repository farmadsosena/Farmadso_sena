<?php
session_start();
#Validacion de rol
include('../config/Conexion.php');
if (!$_SESSION['id']) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/Rlogo-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/admin.css" />
  <script src="https://kit.fontawesome.com/0015840e45.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- alertas toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>Panel administrador</title>
</head>

<body>



  <div id="menuResponsive">
    <h2><img src="../assets/img/sena.png" alt="" class="sena"> Asignación ambiente</h2>
    <div id="iconoMenu">
      <div id="desplegarMenu" class="">
        <i class="fa-solid fa-bars"></i>
      </div>

      <div id="cerrarMenu" class="">
        <i class="fa-solid fa-x"></i>
      </div>

    </div>
  </div>


  <!-- Ventana editar perfil -->
  <!-- EL PROPIO PROGRAMACONSUEÑOINADOR -->
  <div id="modal" class="modal">
    <div class="content-form">

      <form class="formularo-edit" action="../controllers/actualizar_ints_ap.php" method="POST"
        enctype="multipart/form-data">
        <span class="closeProfile" onclick="ocultarUserCard()">&times;</span>
        <h1 class="card-title">Editar Perfil</h1>
        <div class="campos-data">
          <div class="label-input">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="dato" value="<?php echo $nombre_usuario; ?>">
          </div>
          <div class="label-input">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="dato" value="<?php echo $apellido; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" class="dato" value="<?php echo $documento; ?>">
          </div>
          <div class="label-input">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="dato" value="<?php echo $password_usuario; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="correo">Correo:</label>

            <input type="text" name="correo" id="correo" class="dato" value="<?php echo $correo; ?>">
          </div>
          <div class="label-input"><label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="dato" value="<?php echo $telefono; ?>">
          </div>
        </div>
        <div class="imgaa">
          <label for="imagen">Imagen Actual:</label>
          <img src="imgusuario/<?php echo $imagen; ?>" alt="Imagen Actual" class="imga"
            ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)">
        </div>
        <div class="imgaa">
          <label for="new-imagen" class="btn-img">Subir nueva imagen</label>
          <input type="file" name="imagen" id="new-imagen" class="filenew">
        </div>
        <button type="submit" class="btn-cargar-novedad">Actualizar</button>
      </form>
    </div>
  </div>


  <aside id="aside">
    <section class="logo">
      <img src="imgusuario/<?php echo $_SESSION['img']; ?>" alt="" />
      <span class="name_rol">

      </span>

      <article class="BtnEditarPerfil" onclick="mostrarUserCard()" title='Editar perfil'>
        <i class="fa-solid fa-pen-to-square"></i>
      </article>

      <article class='BtnCargueAsignacion' onclick='mostrarCargueAsignacion()' title='Cargar asignaciones'>
        <i class='fa-solid fa-upload'></i>
      </article>

      <button class='Btninforme' id='abrirModalInforme' title='Generar informe'>
        <i class='fa-solid fa-file-export'></i>
      </button>
    </section>


    <!-- Anuncios sena mi papa -->
    <div id="anuncios">


      <div class="swiper mySwiper">
        <div class="swiper-wrapper"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
        <div class="autoplay-progress">
          <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20"></circle>
          </svg>
          <span></span>
        </div>
      </div>
      <p id="textoAnuncio"></p>
    </div>


    <nav id="contenedor-botones">
      <button class="botones pri" id="1" onclick="mostrarContenedor('Inicio',this)">
        <i class="fas fa-building pri"></i>
        <p class="pri">Gestión de Usuarios</p>
      </button>
      <button class="botones" id="2" onclick="mostrarContenedor('servicio',this)">
        <i class="fa-solid fa-play"></i>
        <p class="pri">Servicio al cliente</p>
      </button>

      <button class='botones' id='6' onclick='mostrarContenedor("Graficas",this)'>
        <i class='fas fa-clipboard-list'></i>
        <p>Graficas del software</p>
      </button>

      <button class="botones" id="8" onclick="cerrarSesion()">
        <a href="../config/cerrarSesion.php">
          <i class="fas fa-sign-out-alt"></i>
          <p>Cerrar sesión</p>
        </a>
      </button>
    </nav>
  </aside>

  <main id="main">
    <section class="pages" id="Inicio">
      <section class="llevar-completo">
        <h1>Gestion de usuarios en el sistema</h1>
        <section class="acciones-usuGes">
          <div class="acc">
            <select name="" id="">
              <option value="">Selecciona una opcion</option>
              <option value="">Con rol de Usuario con EPS</option>
              <option value="">Con rol de Usuario estandar</option>
              <option value="">Con rol de Domiciliario</option>
              <option value="">Con rol de Farmaceutico</option>
            </select>
            <button class="agregar acoos aggg">+ Agregar Usuario</button>
          </div>
          <div class="button-solicitudes">
            <!--  Archivo controlador del ajax en assets/js/Super-AdminControles.js linea (1-25)-->
            <button class="llamarAJAX acoos solii" id="resgistros" data-estado="1"><i class='bx bxs-user-check'></i>
              Solicitudes</button>
          </div>
        </section>
        <section class="menu_gestion_user">
          <div class="menu_parte1">
            <section class="botones_random">
              <button class="cantidad_registros acoos agre">Cantidad Registros</button>
              <button class="Excel acoos agre">Excel</button>
              <button class="Csv acoos agre">Csv</button>
              <button class="Csv acoos agre none" id="limpiar">Lista de Usuarios</button>

              <div class="botonesAcciones">
              <button class="desactivado desactivar accer" id="desactivar"><i class="bx bx-power-off"></i></button>
              <button class="activado activarCuenta accer" id="activar"><i class="bx bx-power-off"></i></button>
              <button class="desac accer" id="Editar"><i class="bx bxs-user"></i></i></button>
              </div>

            </section>

            <!-- inicio de tabla de usuarios -->
            <section class="tabla_acciones">
              <div class="tabla_acciones_encabezado remarcar">
                <div class="encabezado_part"></div>
                <div class="encabezado_part1">Nombre</div>
                <div class="encabezado_part2">Correo</div>
                <div class="encabezado_part3">Estado</div>
                <div class="encabezado_part4">Telefono</div>
                <div class="encabezado_part5">Roles</div>
              </div>

              <!-- BUSCADORES DE DATOS PRECISOS Y SENSIBLES -->
              <div class="tabla_acciones_encabezado caer">
                <div class="encabezado_part"></div>
                <div class="encabezado_part1">
                  <input type="search" class="search" data-column="1" id="nombre"
                    placeholder="Buscar Nombre de usuario">
                </div>
                <div class="encabezado_part2">
                  <input type="search" class="search" data-column="2" id="correo"
                    placeholder="Buscar Correo de usuario">
                </div>
                <div class="encabezado_part3">
                  <input type="search" class="search" data-column="3" id="estado" placeholder="Buscar Estado">
                </div>
                <div class="encabezado_part4">
                  <input type="search" class="search" data-column="4" id="telefono"
                    placeholder="Buscar Teléfono o fijo">
                </div>
                <div class="encabezado_part5">
                  <input type="search" class="search" data-column="5" id="rol" placeholder="Buscar Rol">
                </div>
              </div>
              <!-- Aqui llegan los resultados del ajax ../assets/js/Super-AdminControles.js linea (1-25) -->
              <section class="overfloww scroll none" id="reemplazar"></section>
              <section class="overfloww scroll" id="iniciar">
                <!-- Todas las cuentas existentes en el siistema -->
                <?php include "../models/UsuarioSuper-admin.php"; ?>
              </section>
            </section>
          </div>

          <div id="menu_parte2">
            <section class="barra_datos">
              <div class="barra_datos_parte1">
                <div class="b_d_circulo">

                </div>
                <div class="b_d_nombre">
                  Diego Andres Hoyos
                </div>
                <div class="b_d_solicitar">
                  Solicitar Rol Domiciliario
                </div>
              </div>
              <div class="barra_datos_parte2">
                <div class="b_d_fecha">
                  10 de diciembre del 2023
                </div>
                <button class="b_d_estado">
                  Estado
                </button>
              </div>
            </section>

        </section>



      </section>
    </section>

    <section class="pages" id="servicio">
      <!-- No tificaciones de alertas, o los mismos comentarios -->
      <div class="titulo-notificaciones">
        <h2>Notificaciones de medicamentos agotados</h2>
      </div>

      <div class="filtro-notificaciones">
        <a href="">Todos (0)</a>
        <a href="">Pendientes (3)</a>
        <a href="">Spam (5)</a>
      </div>

      <div class="btns-aplicar">

        <button>Accion por lote</button>
        <button>Aplicar</button>

      </div>

      <div class="scroll-tabla scroll">

        <table class="tbl-notificaciones">
          <thead>
            <tr>
              <th>
                <input type="checkbox">
              </th>
              <th>Autor</ht>
              <th>Comentario</th>
              <th>Enviado el</th>
            </tr>
          </thead>

          <tbody>
          <?php include "../models/comentarios.php"; ?>
          </tbody>
        </table>

      </div>



    </section>

    <section class="pages" id="Graficas">
      o
    </section>
    <!-- CUALQUIER ERROR DE AQUI HACIA ABAJO -->


    <section class="viltrum">
      <section class="ventana-datos" id="datos-solicitud">
      </section>

      <!-- LLegada de los datos que se hacen por solictud, archivo DatosSolicitud.php -->
      <section class="alerta-ac" id="alerta-dene">
        <header>
          <h3>Confirmar Rechazar</h3>
        </header>
        <section class="cuerpo-alertaf">
          <div class="texto-alerta">
            <div>Motivo de rechazo</div>
            <textarea id="miTextarea" cols="30" rows="10"></textarea>
            <!-- ¿Seguro de su decisión?, tenga en cuenta que en el momento que decida Rechazar la solicitud se le informara al remitente
               de su decision. -->
          </div>
          <div class="botones-alerta">
            <button class="buuton-canel" id="cancel-rechazar">Cancelar</button>
            <button class="button-aceptl" id="confirm-rechazar">Rechazar</button>
          </div>
        </section>
      </section>

      <!-- CODIGO PARA ACEPTAR LA SOLICITUD -->
      <section class="alerta-ac" id="alerta-ac" data-id="">
        <header>
          <h3>Confirmar Aceptar</h3>

        </header>
        <section class="cuerpo-alertaf">
          <div class="texto-alerta">
            ¿Seguro de su decisión?, tenga en cuenta que en el momento que decida aceptar la solicitud se le
            informara
            al remitente
            de su decision.
          </div>
          <div class="botones-alerta">
            <button class="buuton-canel" id="cancel-accept">Cancelar</button>
            <button class="button-aceptl" id="confirm-acceptboton">Aceptar</button>
          </div>
        </section>
      </section>

    </section>
    <!-- CUALQUIER ERROR SALE DE AQUI V: HACIA ARRIBA -->
    <section class="tamaño" id="CargaDiseño">
      <section class="deco">
        <div class="spinner"></div>
      </section>
      <section class="daco">
        <p>Cargando...</p>
      </section>
    </section>


    <section class="atom" id="VentanaAtom">
      <section class="alerta-ac column" id="custom-dialog">
        <header>
          <h3>¿Que rol deseas desactivar?</h3>
        </header>
        <div class="seleccionar">
          <select id="selectRole">
          </select><br>
          <div>
            <button class="buuton-canel" id="removeVentana">Cancelar</button>
            <button class="button-aceptl" id="selectRoleBtn">Aceptar</button>
          </div>
        </div>
      </section>
    </section>


    <section class="atom" id="ActivarAtom">
      <section class="alerta-ac column" id="custom-dialog">
        <header>
          <h3>¿Que rol deseas Activar?</h3>
        </header>
        <div class="seleccionar">
          <select id="selectRoleAC">
          </select><br>
          <div>
            <button class="buuton-canel" id="removeVentanaAC">Cancelar</button>
            <button class="button-aceptl" id="selectRoleBtnAC">Aceptar</button>
          </div>
        </div>
      </section>
    </section>

    <section class="atom" id="EditarUsuario">
    </section>



  </main>

  <script src="../assets/js/admin.js"></script>
  <script src="../assets/js/Super-AdminControles.js"></script>
  <script src="../assets/js/menuResponsive.js"></script>
</body>

</html>