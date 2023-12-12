<?php
session_start();
include "../config/Conexion.php";

if (!isset($_SESSION["usu"])) {
  echo "<script> window.location='login.php'</script>";
}
// realziar que solo domis aceptados puedan entrar al dashboard

if (!isset($_SESSION["domi"])) {
  echo "<script> window.location='login.php'</script>";
}

// if (!isset($_SESSION["farm"])) {
//   echo "<script> window.location='login.php'</script>";
// }

$id = $_SESSION["id"];





if (!isset($_SESSION["usu"])) {
  echo "<script> window.location='login.php'</script>";
}


$id_usuario = $_SESSION['id'];
$con1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id_usuario'");
$user = mysqli_fetch_assoc($con1);
$imgUser = $_SESSION['img'];
$nombreUsuario = $user['nombre'];
$apellido = $user['apellido'];
$contacto = $user['telefono'];
$contraseña = $user['passwordusuario'];

if($nombreUsuario){
  $sql = mysqli_query($conexion, "SELECT * FROM domiciliario WHERE idusuario = '$id_usuario'");
  $userDomi = mysqli_fetch_assoc($sql);
  $fechaInicio = $userDomi['fechainicio'];
  $vehiculo = $userDomi['tipovehiculo'];
  $imagen = $userDomi['imagen'];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/domiciliario.css" />
    <!-- <link rel="stylesheet" href="assets/css/tareas.css"> -->
    <!-- ICONOS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <!-- Script de GARAVIZ -->
    <script src="https://kit.fontawesome.com/5a100f3f01.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Agrega este enlace a SweetAlert en tu archivo HTML -->




    <title>Domiciliario</title>
</head>

<body>
    <header class="headerDelivery">
        <div class="tittleDelivery">
            <span class="material-symbols-outlined"> directions_bike </span>
            <h1>DOMICILIARIO</h1>
        </div>

        <nav class="navDelivery">
            <!-- <div class="search">
            <input class="searchDelivery" type="search" name="" id="">
            <span class="material-symbols-outlined">
                search
            </span>
        </div> -->
            <!-- SELECT DE OPCIONES DE PERFIL -->
            <div class="custom-select">
                <div class="selected-option">
                    <i class='bx bx-user-circle'></i> <a>Domiciliario</a>
                </div>
                <div class="options">

                    <?php
                function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
                {
                  global $conexion;
                  $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
                  $stmt = $conexion->prepare($consulta);

                  // Cambié "ss" a "is" para reflejar que $usuario es un número (asumiendo que es numérico).
                  $stmt->bind_param("ii", $usuario, $valorEstado);

                  $stmt->execute();
                  $resultado = $stmt->get_result();
                  return $resultado->num_rows > 0;
                }

                if (existe_en_tabla('usuarios', $id, 'estado', 2)) {
                  echo '<div class="option">
                      <i class="bx bx-car"></i> Cuenta de usuario
                  </div>';

                }

                if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
                  echo '<div class="option">
                      <i class="bx bxs-business"></i> Farmaceutico
                  </div>';

                }
                ?>
                </div>
            </div>
            <!-- FIN DE SELECT DE OPCIONES DE PERFIL -->
            <span id="task" class="material-symbols-outlined tareas" onclick="showTasks()"
                style="cursor: pointer; user-select: none">
                quick_reference_all <article class="circuloTask"></article>
            </span>
            <span id="notification" class="material-symbols-outlined notificacion" onclick="showNotifications()"
                style="cursor: pointer; user-select: none">
                notifications <article class="circuloNoti"></article>
            </span>
            <span id="history" class="material-symbols-outlined historial" onclick="showNuevoContenido2()"
                style="cursor: pointer; user-select: none">
                history
            </span>
            <span id="settings" class="material-symbols-outlined config" onclick="showNuevoContenido1()"
                style="cursor: pointer; user-select: none">
                settings
            </span>
        </nav>
    </header>

    <main class="mainDelivery">

        <!-- contenido para logos de historial y configuracion -->
        <div id="nuevoContenido1" class="contenido-nuevo">








            <div class="contenedorProfile ">
                <form action="" method="post" class="formEditar" enctype="multipart/form-data">

                    <section class="ContenedorTwoc">
                        <header class="EncabezadoOne">
                            <h3>Datos Motocicleta</h3>
                        </header>
                        <div class="CampoForm">
                            <h4>Fecha de inicio:</h4>
                            <input type="text" name="fecha_inicio" value="<?php echo $fechaInicio; ?>" id="fecha_inicio"
                                placeholder="Fecha Inicio" readonly>
                        </div>
                        <div class="CampoForm">
                            <h4>Tipo de vehiculo:</h4>
                            <select name="tipo_vehiculo">
                                <option value="moto" <?php echo ($vehiculo == 'moto') ? 'selected' : ''; ?>>Moto
                                </option>
                                <option value="carro" <?php echo ($vehiculo == 'carro') ? 'selected' : ''; ?>>Carro
                                </option>
                            </select>
                        </div>
                        <div class="ContenedorPimagen">
                            <img class="ContainerImagen" src="../assets/imagenesDomi/<?php echo $imagen; ?>"
                                id="imgSubida">
                        </div>
                        <div class="ContenedorBotones">
                            <input type="file" name="imagen_moto" id="imagenMoto" class="BuscarImg">



                            <button type="submit" class="BtnAct">Actualizar</button>
                        </div>
                    </section>
                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                    <input type="hidden" name="contacto" value="<?php echo $contacto; ?>">
                    <input type="hidden" name="contrasena" value="<?php echo $contrasena; ?>">
                </form>
            </div>
        </div>


        <?php
          include("../controllers/procesar_actualizcion.php")
          ?>











        <div id="nuevoContenido2" class="contenido-nuevo" style="display: none">
            <div class="contenedorFiltro">
                <div class="contenedorSecuFiltro">
                    <article class="containerFiltro">
                        <h5>Filtro:</h5>
                        <select name="" id="filtroSelect">
                            <option value="codigo">Código</option>
                            <option value="fecha">Fecha</option>
                        </select>
                    </article>
                    <input type="search" name="" id="buscarFactura" placeholder="Ejemplo: 00031" />
                    <div class="FechaInicial">
                        <p>Fecha inicial:</p>
                        <input type="date" name="" id="fechainicial" />
                    </div>
                    <div class="FechaFinal">
                        <p>Fecha final:</p>
                        <input type="date" name="" id="fechaFinal" />
                    </div>
                </div>
            </div>
            <!-- mostramos el historial -->


            <div class="his">

                <section class="ContenedorHisto">
                    <img src="../assets/img/dizzy-notebook-2.gif" alt="" srcset="" class="gifHisto">

                    <h2>No tienes Historias</h2>
                </section>

                <!-- aqui va donde se va a mostrar las historias -->
                <?php include("../models/historiasDomi.php") ?>
            </div>



        </div>

        <!-- FIN GARAVIZ -->

        <section class="mainDeliverySection" id="notificationsSection">
            <section class="notificationsDelivery">

                <section class="ContenedorMss">
                    <img src="../assets/svg/emptyNotification.svg" alt="" srcset="" class="NotNotification">
                    <h2>No tienes notificaciones</h2>
                </section>
                <?php include("../models/notificaciones.php") ?>

            </section>
        </section>

        <section class="mainDeliverySectionTask" id="tasksSection" style="display: none">
            <section class="contenedorAlertMm">
                <img class="imgMm" src="../assets/img/Scrum board-rafiki.svg" alt="" srcset="">
                <h2>No tienes Tareas</h2>
            </section>
            <?php
      include("../models/tareas.php")
      ?>

            <!-- <div class="taskData">
          <div class="addressInformation">
            <img src="assets/img/domiciliario1.jpg" alt="" />
            <div class="addressData">
              <span>Cliente: Isaias Caballero Mendozaa</span>
              <span>Dirección: B/Rosal</span>
              <span>Dirección Principal: Sanitas</span>
              <span>Dirección 2: La Rebaja B/Centro Cra: 12</span>
            </div>
          </div>
          <p>TIEMPO ESTIMADO: 30MIN</p>
        </div>
        <div class="shippingStatus">
          <p>Número de pedido: 001</p>
          <div class="stateDelivery">
            <span>ESTADO:</span>
            <div class="DETE">
              <span class="material-symbols-outlined"> electric_moped </span>
              <p>EN CAMINO</p>
            </div>
            <div class="optionsStateDelivery">
              <label class="upload">
                Cargar Imagen 
              
                <input type="file" />
              </label>
              <button class="deliver">ENTREGAR</button>
            </div>
          </div>
        </div> -->

            <form action="" method="post"></form>

        </section>
    </main>

    <!-- Ventana Modal "Ver más" en pedidos disponibles -->
    <div id="myModal" class="modalVerMas">
        <div class="modalVerMas-content">
            <span class="close">&times;</span>
            <h2>Detalles de pedido</h2>
            <p>TIEMPO ESTIMADO: 30min</p>
            <hr>
            <div class="modal-details">
                <div class="deliveryData">
                    <div class="epsInfo">
                        <img src="../assets/img/kit-de-primeros-auxilios.png" alt="EPS Logo" />
                    </div>
                    <div class="orderInfo">
                        <p>Número de Pedido: <span id="order-number"></span></p>
                        <div class="fechaVer">Fecha: <p id="fechaVer"> </p>
                        </div>
                    </div>
                </div>
                <div class="mainAdresses">
                    <div id="medication-addresses"></div>
                </div>
                <div class="customer-info">
                    <p>Cliente: <span id="customer-name"></span></p>
                    <p>Dirección: <span id="customer-address"></span></p>
                </div>
                <!-- Nuevo elemento para mostrar direcciones de farmacias de medicamentos -->

            </div>
            <div class="aplicar">
                <form id="miFormulario">
                    <!-- Campo oculto para almacenar el valor de idCompra -->
                    <input type="hidden" name="idCompra" id="idCompraField" value="">
                    <!-- Botón de envío del formulario -->
                    <button type="button" id="aplicarButton">APLICAR</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Ventana modal para "Historial" GARAVIZ-->
    <div id="miModal" class="modal" onclick="cerrarG()">
        <div class="modal-contenido">

            <div class="cajja">
                <div class="ti">
                    <div class="in">
                        <!-- <p>EPS:</p> -->
                        <p id="numFact"></p>
                    </div>
                    <div class="inn">

                    </div>
                </div>
                <div class="cONTENEDORd">
                    <p>Direccion: <span id="DpFact"></span></p>
                    <p>Dirección 2: <span id="dtFact"></span></p>
                </div>

                <div class="cajjjja">
                    <p>Cliente: <span id="ClienteFact"></span></p>
                    <p>Dirección: <span id="DIREFact"></span></p>
                    <p>Fecha: <span id="FechFact"></span></p>
                    <div class="imaaa">
                        <div class="iaam">
                            <img id="ImgFact" src="" alt="" srcset="">
                        </div>
                    </div>
                </div>
                <div class="centrar">
                    <button id="ce" onclick="cerrarG()">CERRAR</button>
                </div>
            </div>
        </div>
    </div>



    <footer class="footerDelivery">
        <span id="footerTask" class="material-symbols-outlined" onclick="showTasks()">
            quick_reference_all <article class="circuloTask"></article>
        </span>
        <span id="footerNotification" class="material-symbols-outlined" onclick="showNotifications()">
            notifications <article class="circuloNoti"></article>
        </span>
        <span id="footerHistory" class="material-symbols-outlined" onclick="showNuevoContenido2()">
            history
        </span>
    </footer>

    <script src="../assets/js/opcionesSelect.js"></script>
    <script src="../assets/js/filtroHistorialDomi.js"></script>
    <script src="../assets/js/menuNavConfig.js"></script>
    <script src="../assets/js/verMasPedidosDisponibles.js"></script>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/navConfigDomi.js"></script>
    <script src="../assets/js/actualizarestadonoti.js"></script>
    <script src="../assets/js/noti.js"></script>
    <script src="../assets/js/enviarImagenCompra.js"></script>
    <script src="../assets/js/selectMenu.js"></script>
    <script src="../assets/js/AlertDomi.js"></script>
    <script src="../assets/js/micuenta.js"></script>

    <script src="../assets/js/Font.js"></script>
    <script src="../assets/js/VentanaAgregaUnaDireccion.js"></script>
    <script src="../assets/js/menu_res_cuenta.js"></script>
    <script src="../assets/js/imgDomC.js"></script>
</body>

</html>