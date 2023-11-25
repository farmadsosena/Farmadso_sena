<?php
include "../config/Conexion.php";

if (isset($_SESSION["usu"])) {
  // header("Location: login.php");
  $id = $_SESSION["id"];

  $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id'");
  $rr = mysqli_fetch_assoc($consulta);
}
session_start();

if (!isset($_SESSION['id'])) {
  if (!isset($_SESSION['idinvitado'])) {
    $_SESSION['idinvitado'] = generarIDInvitadoUnico(); // Generar un ID único para el invitado si no hay sesión de usuario
  }
} else {
  // Si hay un usuario autenticado, utilizar su ID
  $idUsuario = $_SESSION['id'];
  // Haz lo que necesites con el ID del usuario autenticado
}

function generarIDInvitadoUnico()
{
  $prefix = 'INVITADO_'; // Prefijo para identificar al invitado
  $uniqueID = $prefix . uniqid(); // Generar un identificador único

  return $uniqueID;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/inicio_tienda.css" />
  <link rel="stylesheet" href="../assets/css/footer_inicio_tienda.css" />
  <link rel="stylesheet" href="../assets/css/slider_inicio_tienda.css" />
  <link rel="stylesheet" href="../assets/css/detalles.css">
  <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <!-- Enlace al JavaScript de Toastr.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <title>Tienda Farmadso</title>
</head>

<body>
  <!--Cont-car-->
  <div class="modalCarrito">
    <div class="contCarrito">
      <h3>Carrito de compras</h3>

      <div id="cerrarCarrito">
        <i class="fa-solid fa-xmark"></i>
      </div>
      <form method="POST" id="form-eliminar">
        <p>Subtotal del carrito<b id="subtotal"></b></p>
        <div class="contC">
          <label for="seleccionarTodo" style="color: #333333;">Seleccionar todos</label>
          <input class="" id="seleccionarTodo" type="checkbox">
        </div>

        <div id="tabla-contenedor">
          <section>


          </section>
        </div>
      </form>

      <div class="contboton" id="contC">
        <button class="botonCarrito deleteCarrito">Quitar marcados</button>
        <a href="pago.php" class="pagar paypal">Pagar con PayPal <i class="fa-brands fa-paypal"></i></a>
        <a href="" class="pagar">
          <form action="pagocontraentrega.php" method="post">
            <input type="hidden" name="<?php $_SESSION ?>">
            <button name="carrito" class="pagar">Pago contra entrega <i class="fa-solid fa-money-bill"></i></button>
          </form>
        </a>
      </div>


    </div>
  </div>
  <!--End cont-car-->

  <!--Menu version responsive-->
  <nav id="contMenu">
    <div class="closeMenu" id="cerrarMenu">
      <i class="fa-solid fa-x"></i>
    </div>
    <div class="menuResponsive">
      <div class="profileResponsive">
        <?php
        if (isset($_SESSION["usu"])) {
        ?>
          <img src="<?php echo $rr["imgUser"] ?>" alt="<?php echo $rr["nombre"] ?>">
          <p><?php echo $rr["nombre"] ?></p>
        <?php
        } else {
        ?>
          <button class="boton-login-tienda"><a href="login.php">Iniciar Sesión</a></button>
        <?php
        }
        ?>
      </div>
      <div class="contenedorEnlaces">

        <div class="enlaceMenu" id="inicio"><i class="fa-solid fa-home"></i>Inicio</div>
        <div class="enlaceMenu" id="productos"><i class="fa-solid fa-store"></i>Productos</div>

        <div id="abrirModalPedido" class="enlaceMenu"><i class="fa-solid fa-bag-shopping"></i>Farmacias</div>
        <div class="enlaceMenu" id="abrirEditar2"><a href="Usuario.php" class="formulas-menuNav-tienda"><i class="fa-solid fa-sheet-plastic"></i></i>Formulas</a></div>
        <!-- <div id="" class="enlaceMenu" onclick="verCompra()"><i class="fa-solid fa-shopping-basket"></i>Mis compras</div> -->
        <?php
        if (isset($_SESSION["usu"])) {
        ?>
          <a href="../config/cerrarSesion.php" class="enlaceMenu"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>
  <header id="headerResponsive">
    <span class="logo"><img src="../assets/img/logoFarmadso - cambio.png"><b>Tienda Farmadso</b></span>
    <div class="menuRight">
      <section class="buscador-responsive">
        <div class="cont-input-buscador-responsive">
          <i class="fa-solid fa-xmark" onclick="desactivar_buscador_responsive()"></i>
          <input type="search" id="" placeholder="¿Qué estás buscando?">
          <i class="fa-solid fa-magnifying-glass" onclick="activar_buscador_responsive()"></i>
        </div>
      </section>
      <div id="abrirCarrito" class="addCarrito">
        <i class='bx bx-cart-alt'></i>
      </div>
      <div class="openMenu">
        <i class="fa-solid fa-bars"></i>
      </div>
    </div>
  </header>

  <!--Encabezado principal de la pagina-->
  <header id="header">
    <span class="logo"><img src="../assets/img/logoFarmadso - cambio.png"><b>Tienda Farmadso</b></span>
    <nav id="menu">
      <div id="inicio"><i class='bx bxs-home-alt-2'></i>
        <p>Inicio</p>
      </div>
      <div id="productos"><i class='bx bxs-store'></i>
        <p>Productos</p>
      </div>
      <div id="abrirCarrito"><i class='bx bx-cart-alt'></i>
        <p>Carrito</p>
      </div>
      <div id="buscador-header"><input type="search" id="" placeholder="¿Qué estás buscando?"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div id="mis-formulas"><a href="Usuario.php" class="formulas-menu-tienda">
          <i class="fa-solid fa-sheet-plastic"></i>
          <p>Formulas</p>
        </a>
      </div>
      <div class="profile-user">
        <?php
        if (isset($_SESSION["usu"])) {
        ?>
          <a href="configuracion.php" class="perfil-tienda" title="<?php echo $rr["nombre"] ?>"><img src="<?php echo $rr["imgUser"] ?>" alt="<?php echo $rr["nombre"] ?>"></a>
        <?php
        } else {
        ?>
          <button class="boton-login-tienda"><a href="login.php">Iniciar Sesión</a></button>
        <?php
        }
        ?>
      </div>
    </nav>
  </header>
  <!--Fin del encabezado-->
  <!--Index principal-->
  <main id="index">
    <section class="venergar-info" id="informacion-rapida">
      <section class="container-rapido">
        <i class='bx bx-x x2 salir-vista-medicamento'></i>
        <section class="img-oferta">
          <section class="produc">
            <img src="" alt="">
          </section>
          <section class="resto-product">
            <div class="scroll2">
              <section class="raster">
                <img src="../assets/img/banner-formulas.png" alt="">
              </section>
              <section class="raster">
                <img src="../assets/img/banner3.png" alt="">
              </section>
              <section class="raster">
                <img src="../assets/img/logoFarmadso - cambio.png" alt="">
              </section>
            </div>
          </section>
        </section>
        <section class="descript-pro">
          <h2 class="nombre_farmacia"></h2>
          <h1 class="nombre_med"></h1>
          <h3 class="nombre_med"></h3>
          <p class="c_m"></p>
          <div class="precio-antes">
            <div class="precio-a"></div>
            <div class="ahorro"></div>
          </div>
          <div class="precio"></div>
          <div class="descripcion_det_med">
            <p></p>
          </div>
          <button class="carrito"><i class='bx bx-cart'></i> Añadir al carrito</button>
          <button class="vermas">Ver mas detalles</button>
        </section>
      </section>
      <div class="cont-spinner-deta_med" style="display: none;">
        <span class="spinner-deta_med"></span>
      </div>
    </section>
    <section class="content-main">
      <aside>
        <h3>!Ahora no tienes que hacer largas filas compra medicamentos desde Farmadso!</h3>
        <p>Farmadso te brinda la capacidad de que lleguen medicamentos a la puerta de tu casa, Compralos a tu farmacia de eps o para un mejor precio desde otras farmacias encontradas en FARMADSO.</p>
        <button type="button" class="visitP" id="crearProductos">
          <i class='bx bxs-store'></i> Mi farmacia
        </button>

      </aside>
      <main>
        <?php require '../templates/slider_inicio_tienda.html'; ?>
      </main>
    </section>
    <section class="articles">
      <h1>Categorias destacadas</h1>
      <div class="swiper slider-categorias">
        <div class="swiper-wrapper">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "farmadso";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM categoria ORDER BY idcategoria DESC LIMIT 6";
          $result = $conn->query($sql);

          echo "<div class='swiper-slide colum-categorias'>";

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<a href='#' class='swiper-slide cont-categorias'>";
              echo "<section>";
              echo "<img src='../uploads/imgProductos/" . $row['imgCategoria'] . "' alt='" . $row['nombrecategoria'] . "'>";
              echo "<h3>" . $row['nombrecategoria'] . "</h3>";
              echo "</section>";
              echo "</a>";
            }
          } else {
            echo "No hay categorías disponibles.";
          }


          echo "</div>";

          $conn->close();
          ?>
        </div>
      </div>
    </section>

    <section class="articles">
      <h1>Ofertas</h1>
      <div class="ranking">
        <?php
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "farmadso";

        try {
          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
          }

          $sql = "SELECT p.*, m.*,I.*, f.Nombre as nombre_farmacia
              FROM promocion p
              INNER JOIN medicamentos m ON p.id_medicamento = m.idmedicamento
              INNER JOIN farmacias f ON m.idFarmacia = f.idFarmacia
              INNER JOIN inventario I ON I.idinventario = m.idmedicamento
              ORDER BY p.valordescuento DESC
              LIMIT 4";

          $result = $conn->query($sql);

          // Verifica si hay resultados en la consulta
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id_medicamento = $row['id_medicamento'];
              $precio_antes = $row['precio'];
              $descuento = $row['valordescuento'];
              // Calcula el precio actual
              $precio_actual = $precio_antes - ($precio_antes * ($descuento / 100));

              $precio_antes = number_format($precio_antes, 0, ',', '.');
              $precio_actual = number_format($precio_actual, 0, ',', '.');
              $id_ofuscado = base64_encode($id_medicamento);
              $id_medicamento = $row['id_medicamento'];
              $precio_antes = $row['precio'];
              $descuento = $row['valordescuento'];
              // Calcula el precio actual
              $precio_actual = $precio_antes - ($precio_antes * ($descuento / 100));




              echo "<form action='' method='POST' class='card ' class='cardProductoS'>";
              if (isset($_SESSION['id'])) {
                echo "<input type='hidden' name='idusuario' value=" . $_SESSION["id"] . ">";
              } else {
                // Si  la sesión no está iniciada se envia el invitado
                echo "<input type='hidden' name='idusuario' value=" . $_SESSION['id_invitado'] . ">";
              }
              echo "<input type='hidden' name='nombre' value=" . $row['nombre'] . ">";
              
              echo "<input type='hidden' name='precio' value=" . $row['precio'] . ">";
              echo "<div class='top-product' data-im='$id_ofuscado'>";
              echo "<img src='../uploads/imgProductos/" . $row['imagenprincipal'] . "' alt=''>";
              echo "<p>" . $row['nombre_farmacia'] . "</p>";
              echo "<h3>" . $row['nombre'] . "</h3>";
              echo "<p class='ahorro-top-product'>Antes $" . $precio_antes . "</p>";
              echo "<h2>$" . $precio_actual . "</h2>";
              echo "<input type='hidden' class='card-cantidad' name='idmedicamento' value='" . $row["idmedicamento"] . "'>";
              echo "<input type='number' class='card-cantidad' name='cantidadcarrito' min='1' max='" . $row["stock"] . "' value='1'>";
              echo " <input type='submit' name='comprar' value='comprar' class='comprar-tarje-comp' >";
              echo "</div>";
              echo "</form>";
            }
          } else {
            echo "No hay ofertas disponibles.";
          }
        } catch (Exception $e) {
          echo "Error: " . $e->getMessage();
        } finally {
          // Cierra la conexión
          if (isset($conn)) {
            $conn->close();
          }
        }
        ?>
      </div>
    </section>

    <section class="articles">
      <h1>Farmacias destacadas</h1>
      <div class="swiper slider-farmacias">
        <div class="swiper-wrapper">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "farmadso";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM farmacias ORDER BY IdFarmacia ASC LIMIT 6";
          $result = $conn->query($sql);

          echo "<div class='swiper-slide colum-categorias'>";

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<a href='' class='swiper-slide cont-farmacia'>";
              echo "<img src='../uploads/imgProductos/" . $row['imgfarmacia'] . "' alt='" . $row['Nombre'] . "'>";
              echo "</a>";
            }
          } else {
            echo "No hay farmacias disponibles.";
          }
          echo "</div>";

          $conn->close();
          ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </section>

    <section class="articles">
      <h1>¡Servicios excepcionales para nuestros clientes!</h1>
      <section>
        <div class="article">
          <i class="fa-solid fa-truck-fast"></i>
          <h3>Entrega de medicamentos de Eps a domicilio</h3>
        </div>
        <div class="article">
          <i class='bx bx-shopping-bag'></i>
          <h3>Compra de medicamentos de la farmacia afiliada</h3>
        </div>
        <div class="article">
          <i class="fa-solid fa-house-medical"></i>
          <h3>Visualización de formulas Eps</h3>
        </div>
      </section>
    </section>
    <?php require '../templates/footer_inicio_tienda.html'; ?>
  </main>
  <script src="../assets/js/agregarCarrito.js"></script>
  <script src="../assets/js/carrito.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../assets/js/slider_inicio_tienda.js"></script>
  <script src="../assets/js/Font.js"></script>
  <script src="../assets/js/carritoF.js"></script>
  <script src="../assets/js/funcionMenutienda.js"></script>
  <script src="../assets/js/detallesRapidos.js"></script>
</body>


</html>