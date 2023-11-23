<?php
require_once "validacion_usu_tienda.php";
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
  <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/toastr.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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
        <a href="views/pasarela.php" class="pagar">Pago contra entrega <i class="fa-solid fa-money-bill"></i></a>
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "farmadso";

        try {
          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
          }

          $sql = "SELECT p.*, m.*, f.Nombre as nombre_farmacia
              FROM promocion p
              INNER JOIN medicamentos m ON p.id_medicamento = m.idmedicamento
              INNER JOIN farmacias f ON m.idFarmacia = f.idFarmacia
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

              echo "<div class='top-product'>";
              echo "<img src='../uploads/imgProductos/" . $row['imagenprincipal'] . "' alt=''>";
              echo "<h4>" . $row['nombre'] . "</h4>";
              echo "<p>" . $row['nombre_farmacia'] . "</p>";
              echo "<p class='ahorro-top-product'>Antes $" . $precio_antes . "</p>";
              echo "<h2>$" . $precio_actual . "</h2>";
              echo "<button class='comprar-tarje-comp'>Comprar</button>";
              echo "</div>";
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
          <div class="swiper-slide colum-categorias">
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F1.jpg" alt="Vitaminas y minerales">
            </section>
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F2.jpg" alt="Dolor e inflamacion">
            </section>
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F3.jpg" alt="Gripa y tos">
            </section>
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F4.jpg" alt="Estomago">
            </section>
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F5.jpg" alt="Cuidado de la herida">
            </section>
            <section class="swiper-slide cont-farmacia">
              <img src="../uploads/imgProductos/logo_F6.jpg" alt="Nutricion especializada">
            </section>
          </div>
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
</body>
<script src="../assets/js/slider_inicio_tienda.js"></script>
<script src="../assets/js/Font.js"></script>
<script src="../assets/js/carritoF.js"></script>
<script src="../assets/js/funcionMenutienda.js"></script>

</html>