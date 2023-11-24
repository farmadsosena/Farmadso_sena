<?php
// session_start();

// if (isset($_SESSION['compraSuccess']) && $_SESSION['compraSuccess'] === true) {
//   require_once('views/valoracionCliente.php');
// }

// if (!isset($_SESSION['id_cliente'])) {
//   if (!isset($_SESSION['sessionId'])) {
//     // $sessionId = rand(0, 100);
//     $sessionId = uniqid();
//     $_SESSION['sessionId'] = $sessionId;
//   }
// } else {
//   unset($_SESSION['sessionId']);
// }

// unset($_SESSION['productosCaja']);
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
        <img src="../assets/img/guest.webp" alt="">
        <p>Alex</p>
      </div>
      <div class="contenedorEnlaces">

        <div class="enlaceMenu" id="inicio"><i class="fa-solid fa-home"></i>Inicio</div>
        <div class="enlaceMenu" id="productos"><i class="fa-solid fa-store"></i>Productos</div>

        <div id="abrirModalPedido" class="enlaceMenu"><i class="fa-solid fa-bag-shopping"></i>Farmacias</div>
        <div class="enlaceMenu" id="abrirEditar2"><i class="fa-solid fa-user"></i>Formulas</div>
        <div id="" class="enlaceMenu" onclick="verCompra()"><i class="fa-solid fa-shopping-basket"></i>Mis compras</div>
        <a href="controllers/cerrarSesion.php" class="enlaceMenu"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>
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
      <div id="inicio"><i class='bx bxs-home-alt-2'></i><p>Inicio</p></div>
      <div id="productos"><i class='bx bxs-store'></i><p>Productos</p></div>
      <div id="abrirCarrito"><i class='bx bx-cart-alt'></i><p>Carrito</p></div>
      <div id="buscador-header"><input type="search" id="" placeholder="¿Qué estás buscando?"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div class="profile-user">
        <a href="configuracion.php"><i class='bx bxs-user-circle'></i></a>
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
          <div class="swiper-slide colum-categorias">
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria1.jpeg" alt="Vitaminas y minerales">
                <h3>Vitaminas y minerales</h3>
              </a>
            </section>
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria2.jpeg" alt="Dolor e inflamacion">
                <h3>Dolor e inflamacion</h3>
              </a>
            </section>
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria5.jpeg" alt="Gripa y tos">
                <h3>Gripa y tos</h3>
              </a>              
            </section>
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria3.jpeg" alt="Estomago">
                <h3>Estomago</h3>
              </a>              
            </section>
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria6.jpeg" alt="Cuidado de la herida">
                <h3>Cuidado de la herida</h3>
              </a>              
            </section>
            <section class="swiper-slide cont-categorias">
              <a href="#">
                <img src="../uploads/imgProductos/categoria4.jpeg" alt="Nutricion especializada">
                <h3>Nutricion especializada</h3>
              </a>              
            </section>
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
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

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Realizar la consulta para obtener los primeros 6 productos con descuento
        $sql_promociones = "SELECT p.id_medicamento, valordescuento
        FROM promocion
        WHERE valordescuento > 0
        LIMIT 6";

        $result_promociones = $conexion->query($sql_promociones);

        if ($result_promociones->num_rows > 0) {
        while ($row_promociones = $result_promociones->fetch_assoc()) {
        // Obtener información completa del medicamento y la farmacia
        $id_medicamento = $row_promociones['id_medicamento'];
        $porcentaje_promocion = $row_promociones['porcentaje_promocion'];

        $sql_medicamento_farmacia = "SELECT m.nombre, m.imagenprincipal, m.precio, f.Nombre AS nombre_farmacia
                        FROM medicamentos m
                        JOIN farmacias f ON m.idfarmacia = f.IdFarmacia
                        WHERE m.idmedicamento = $id_medicamento";

        $result_medicamento_farmacia = $conexion->query($sql_medicamento_farmacia);

        if ($result_medicamento_farmacia->num_rows > 0) {
        while ($row_medicamento_farmacia = $result_medicamento_farmacia->fetch_assoc()) {
        // Calcular el precio actual con el porcentaje de promoción
        $precio_anterior = $row_medicamento_farmacia['precio'];
        $precio_actual = $precio_anterior - ($precio_anterior * $porcentaje_promocion / 100);
        ?>
        <div class="top-product" id="productos">
        <img src="<?php echo $row_medicamento_farmacia['imagenprincipal']; ?>" alt="">
        <p><?php echo $row_medicamento_farmacia['nombre_farmacia']; ?></p>
        <h4><?php echo $row_medicamento_farmacia['nombre']; ?></h4>
        <p class="ahorro-top-product">Antes $<?php echo $precio_anterior; ?></p>
        <h2>$<?php echo $precio_actual; ?></h2>
        <button class="comprar-tarje-comp">Comprar</button>
        </div>
        <?php
        }
        }
        }
        } else {
        echo "0 results";
        }

        // Cerrar la conexión (opcional si se usa el objeto mysqli)
        //$conexion->close();
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