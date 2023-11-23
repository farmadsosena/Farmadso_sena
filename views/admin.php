<?php

session_start();
#Validacion de rol
include('../controllers/Conexion.php');
$rol = (isset($_SESSION['rol'])) ? $_SESSION['rol'] : null;


if (!isset($_SESSION['rol'])) {
  echo "<script>window.location.href = './index.php';</script>";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- alertas toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <?php

  if ($rol == 2 or $rol == 3 or $rol == 4) {
    echo " <style> 
    .cambiar-num-inve{
      display:none;
    }

    .acciones-inve-da{
      display:none;
    }
    </style>";
  }
  ?>


  </link>

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
  <?php
  if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];

    $sql = "SELECT * FROM usuario WHERE idusuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      $nombre_usuario = $row["nombre_usuario"];
      $apellido = $row["apellido"];
      $documento = $row["documento"];
      $password_usuario = $row["password_usuario"];
      $correo = $row["correo"];
      $telefono = $row["telefono"];
      $imagen = $row["imagen"];
    }
  }
  ?>

  <div id="modal" class="modal">
    <div class="content-form">

      <form class="formularo-edit" action="../controllers/actualizar_ints_ap.php" method="POST" enctype="multipart/form-data">
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
          <img src="imgusuario/<?php echo $imagen; ?>" alt="Imagen Actual" class="imga" ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)">
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
        <?php

        $sconsult = mysqli_query($conexion, "SELECT * FROM rol_usuario WHERE idrol = $rol");
        $row = mysqli_fetch_assoc($sconsult);
        echo '<p>';
        echo $_SESSION['nombre'];
        echo '</p>';
        echo '<p>';
        echo $row['nombre_rol'];
        echo '</p>';
        ?> 
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
      <?php
        if ($rol == 1) {
          echo '
          <button title="Gestionar noticias" id="EditarCarrusel" onclick="mostrarContenedor(\'carruselNoticias\', this)">
            <p></p>
            <i class="fa-solid fa-ellipsis"></i>
          </button>
                ';
      }
      ?>

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
      <button class="botones pri" id="1" onclick="mostrarContenedor('Ambientes',this)">
        <i class="fas fa-building pri"></i>
        <p class="pri">Acceso de Medicamentos</p>
      </button>
      <button class="botones" id="2" onclick="mostrarContenedor('descubre_asig',this)">
        <i class="fa-solid fa-play"></i>
        <p class="pri"> Servicio al cliente</p>
      </button>
      <!-- DE AQUI HACIA ABAJO MEJIA -->
      <?php
      if ($rol == 2 || $rol == 4) {
        // ME PUSIERON ESTO A ULTIMA HORA MALDITOS DESGRACIADOS (CON TODO RESPETO)
      ?>
        <button class='botones' id='3' onclick="mostrarContenedor('verSolicitudes',this)">
          <i class='fas fa-clipboard-list'></i>
          <p>Tus reservas</p>
        </button>
      <?php
      }
      ?>

      <!-- DE AQUI HACIA ARRIBA MEJIA  -->
      <?php
      // if ($rol == 3) {
      //   echo '<button class="botones pri btn-open" onclick="mostrarFormularioN()">
      //   <i class="fas fa-building pri"></i>
      //   <p class="pri  ">Generar Novedad</p>
      // </button>';
      // }
      ?>
      <?php
      if ($rol == 1) {
        echo "
      <button class='botones' id='4' onclick='mostrarContenedor(\"crearAmbiente\", this)'>
        <i class='fas fa-plus-circle'></i>
        <p> Estadisticas Generales</p>
      </button>
      ";
      }
      ?>
      <?php
      if ($rol == 1) {
      ?>
        <button class='botones' id='6' onclick='mostrarContenedor("Solicitudes",this)'>
          <?php require_once '../controllers/num_solicutudes_nueva.php'; ?>
          <i class='fas fa-clipboard-list'></i>
          <p>Solicitudes de Usuarios</p>
        </button>

        <button class='botones' id='7' onclick='mostrarContenedor("Usuarios",this)'>
          <i class='fas fa-users'></i>
          <p>Gestión de Usuarios</p>
        </button>
      <?php
      }
      ?>

      <button class="botones" id="8" onclick="cerrarSesion()">
        <i class="fas fa-sign-out-alt"></i>
        <p>Cerrar sesión</p>
      </button>
    </nav>
  </aside>

  <main id="main">
    <section class="pages" id="Inicio">
      <h1>Inicio</h1>
    </section>

    <section class="pages" id="Solicitudes">
      a
    </section>

    <section class="pages" id="Ambientes">
     e
    </section>

    <section class="pages" id="descubre_asig">
      o
    </section>
    <!-- CUALQUIER ERROR DE AQUI HACIA ABAJO -->

   

  <!-- CUALQUIER ERROR SALE DE AQUI V: HACIA ARRIBA -->
  <?php

  if ($rol == 1) {
    //require_once 'informeAmbiente/generarInforme.html';
    echo '
    
      <section class="pages" id="crearAmbiente">
        <article id="containeruser">Hello</section>
        <section class="form-group"></section>

        <section class="pages" id="crearUsuario">
          <article id="containeruser"></article>
        </section>

        <section class="pages" id="Usuarios">
        HOLA</section>
    ';
  }

  ?>
    <form method="post" enctype="multipart/form-data" class="pages" id="carruselNoticias">
      <!--imagenes slider-->
    </form>
    <section class="novedad_celador" id="novedad" onclick="cerrarFormularioN()"></section>
    <div id="form_novedad"></div>

  </main>

  <script src="../assets/js/info_ambie_pisos.js" ></script>
  <script src="../assets/js/admin.js"></script>
  <script src="../assets/js/modal1.js" ></script>
  <script src="../assets/js/menuResponsive.js"></script>

</body>

</html>
