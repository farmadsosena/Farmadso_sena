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
  <title>Tienda Farmadso</title>
</head>

<body>
  <!--Cont-car-->
  <div class="modalCarrito">
    <div class="contCarrito">
      <h3>Carrito de compras</h3>

      <div id="cerrarCarrito">
        <i class="fa-solid fa-x"></i>
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
        if (isset($_SESSION['id_cliente'])) {
          $imgUser = $_SESSION['imagen_usuario'];
          echo ' <img src="' . $imgUser . '" alt="">';
          echo '<p>' . $_SESSION['nombre_cliente'] . '</p>';
        }
        if (isset($_SESSION['id_admin'])) {
          $imgUser = $_SESSION['imagen_usuario'];
          echo ' <img src="' . $imgUser . '" alt="">';
          echo '<b>' . $_SESSION['nombre_admin'] . '</b>';
        }
        ?>
      </div>
      <div class="contenedorEnlaces">

        <div class="enlaceMenu" id="inicio"><i class="fa-solid fa-home"></i>Inicio</div>
        <div class="enlaceMenu" id="productos"><i class="fa-solid fa-store"></i>Desayunos sorpresa</div>
        <?php
        if (isset($_SESSION['id_admin'])) {
          $imgUser = $_SESSION['imagen_usuario'];
          echo '<a href="views/administrador.php" class="enlaceMenu"><i class="fa-solid fa-store fa-bounce"></i>Mi tienda</a>';
          echo '<a href="controllers/cerrarSesion.php" class="enlaceMenu"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>';
        }
        if (!isset($_SESSION['id_admin']) and !isset($_SESSION['id_cliente'])) {
          echo '<a href="controllers/verificarSesion.php" class="enlaceMenu"><i class="fa-solid fa-plus"></i> iniciar sesion</a>';
        }

        if (isset($_SESSION['id_cliente'])) {
          echo '<div id="abrirModalPedido" class="enlaceMenu"><i class="fa-solid fa-bag-shopping"></i>Mis pedidos</div>';
          echo '<div id="" class="enlaceMenu" onclick="verCompra()"><i class="fa-solid fa-shopping-basket" ></i>Mis compras</div>';
          echo '<div  class="enlaceMenu" id="abrirEditar2"><i class="fa-solid fa-user" ></i>Editar perfil</div>';
          echo '<a href="controllers/cerrarSesion.php" class="enlaceMenu"><i class="fa-solid fa-right-from-bracket"></i>Cerrar sesion</a>';
        }
        ?>
      </div>
    </div>
  </nav>
  <header id="headerResponsive">
    <span class="logo"><img src="../assets/img/logoFarmadso - cambio.png"><b>Tienda Farmadso</b></span>
    <div class="menuRight">
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
      <div id="inicio"><i class='bx bxs-home-alt-2'></i> Inicio</div>
      <div id="productos"><i class='bx bxs-store'></i> Productos</div>
      <div id="abrirCarrito"><i class='bx bx-cart-alt'></i> Carrito</div>
      <div class="profile-user">
        <i class='bx bxs-user-circle'></i>
        <div id="cardProfile">
          <div id="cerrarPerfil"><i class="fa-solid fa-xmark"></i></div>
          <?php if (!isset($_SESSION['id_cliente']) and !isset($_SESSION['id_admin'])) : ?>
            <a href="login.php">Iniciar sesión</a>
            <a href="views/registroUsuario.php">Registrate</a>
          <?php endif;
          if (isset($_SESSION['id_cliente'])) {
            echo '<p><i class="fa-regular fa-user"></i> ' . $_SESSION['nombre_cliente'] . '</p>';
            echo '<p id="abrirEditar"><i class="fa-regular fa-user"></i> Editar perfil</p>';

            echo '<a href="controllers/cerrarSesion.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar Sesión</a>';
          } elseif (isset($_SESSION['id_admin'])) {
            echo '<p>' . $_SESSION['nombre_admin'] . '</p>';
            echo '<p>Admin</p>';
            echo '<a href="controllers/cerrarSesion.php">Cerrar Sesión</a>';
          }
          ?>
        </div>
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
      <h2>Medicamentos más vendidos</h2>
      <div class="ranking">
        <div class="top-product" id="productos">
          <img src="../uploads/imgProductos/ACETAMINOFEN-GENFAR--500-MG_F.webp" alt="">
          <h3>Acetaminofén-GENFAR</h3>
          <div>$2.500</div>
        </div>
        <div class="top-product" id="productos">
          <img src="../uploads/imgProductos/apiretal.jpg" alt="">
          <h3>Apiretal</h3>
          <div>$11.800</div>
        </div>
        <div class="top-product" id="productos">
          <img src="../uploads/imgProductos/TUKOL-EXPECTORANTE-D_L.webp" alt="">
          <h3>TUKOL EXPECTORANTE D</h3>
          <div>$23.960</div>
        </div>
        <div class="top-product" id="productos">
          <img src="../uploads/imgProductos/BISOLVON-ADULTOS_L.webp" alt="">
          <h3>BISOLVON ADULTOS</h3>
          <div>$31.550</div>
        </div>
      </div>
    </section>
    <section class="articles">
      <h2>¡Servicios excepcionales para nuestros clientes!</h2>
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
</html>