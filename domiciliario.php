<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/domiciliario.css" />
    <!-- <link rel="stylesheet" href="assets/css/tareas.css"> -->
    <!-- ICONOS -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0"
    />
    <!-- Script de GARAVIZ -->
    <script src="https://kit.fontawesome.com/5a100f3f01.js" crossorigin="anonymous"></script>

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
        <span
          id="task"
          class="material-symbols-outlined tareas"
          onclick="showTasks()"
          style="cursor: pointer; user-select: none"
        >
          quick_reference_all
        </span>
        <span
          id="notification"
          class="material-symbols-outlined notificacion"
          onclick="showNotifications()"
          style="cursor: pointer; user-select: none"
        >
          notifications
        </span>
        <span
          id="history"
          class="material-symbols-outlined historial"
          onclick="showNuevoContenido2()"
          style="cursor: pointer; user-select: none"
        >
          history
        </span>
        <span
          id="settings"
          class="material-symbols-outlined config"
          onclick="showNuevoContenido1()"
          style="cursor: pointer; user-select: none"
        >
          settings
        </span>
      </nav>
    </header>

    <main class="mainDelivery">
      <!-- contenido para logos de historial y configuracion -->
      <div id="nuevoContenido1" class="contenido-nuevo">
        <aside class="navConfig">
          <div class="containerMenuConfig">
            <div class="EncabezadoNavConfig">
              <p>Mi cuenta</p>
            </div>
            <div class="datosConfig">
              <p class="LetraGris">Bienvenido:</p>
              <div class="nameUserConfig">¿Que Deseas Hacer?</div>
            </div>
            <div class="optionNavConfig">
              <p class="LetraGris">Tu Cuenta:</p>
              <div class="optionGeneralesConfig">
                <article class="opcionesConfig" id="Micuenta">
                  <span class="material-symbols-outlined iconUser">
                    account_circle
                  </span>
                  <p>Mi perfil</p>
                </article>
                <article class="opcionesConfig" id="Detalles">
                  <span class="material-symbols-outlined iconUser"> info </span>
                  <p>Detalles</p>
                </article>
              </div>
            </div>
            <div class="helpConfig">
              <p class="LetraGris">Ajustes y Ayuda:</p>
              <div class="configCont">
                <article class="opcionesConfig">
                  <span class="material-symbols-outlined iconUser">
                    support_agent
                  </span>
                  <p>Contactanos</p>
                </article>
                <article class="opcionesConfig">
                  <span class="material-symbols-outlined iconUser"> help </span>
                  <p>Soporte</p>
                </article>
                <article class="opcionesConfig" id="CerrarSesion">
                  <span class="material-symbols-outlined iconUser">
                    do_not_disturb_on
                  </span>
                  <p>Cerrar Sesión</p>
                </article>
              </div>
            </div>
          </div>
        </aside>

        <div class="ContenedoresOptionConfig1" id="PerfilConfig">hola</div>
        <div class="ContenedoresOptionConfig2" id="PerfilConfig">Goku</div>
        <div class="ContenedoresOptionConfig3" id="PerfilConfig">Vegeta</div>
      </div>

      <div id="nuevoContenido2" class="contenido-nuevo" style="display: none">
        <div class="contenedorFiltro">
          <div class="contenedorSecuFiltro">
            <article class="containerFiltro">
              <h5>Filtro:</h5>
              <select name="" id="filtroSelect">
                <option value="codigo">codigo</option>
                <option value="fecha">fecha</option>
              </select>
            </article>
            <input
              type="search"
              name=""
              id="buscarFactura"
              placeholder="codigo"
            />
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

        <div class="his">
          <div class="c">
            <div class="inf">
              <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="infff">
                <p>Isaias Caballero</p>
                <p>Dirección: B/Rosal</p>
                <div class="FechaDate">  <h3>Fecha:</h3> <p>18/10/2023</p></div>
              
              </div>

              <div class="listo">
                <div class="co">
                  <p>0001</p>
                </div>
                <div class="chulo">
                  <i class="fa-solid fa-check"></i>
                  <p>Entregado</p>
                </div>
              </div>
            </div>
            <div id="b">
              <button id="but" onclick="abrirG()" class="openModalButton">
                Ver más...
              </button>
            </div>
          </div>

          <div class="c">
            <div class="inf">
              <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="infff">
                <p>Isaias Caballero</p>
                <p>Dirección: B/Rosal</p>
                <div class="FechaDate"> <h3>Fecha:</h3><p>19/10/2023</p></div>
              </div>

              <div class="listo">
                <div class="co">
                  <p>0002</p>
                </div>
                <div class="chulo">
                  <i class="fa-solid fa-check"></i>
                  <p>Entregado</p>
                </div>
              </div>
            </div>
            <div id="b">
              <button id="but" onclick="abrirG()" class="openModalButton">
                Ver más...
              </button>
            </div>
          </div>

          <div class="c">
            <div class="inf">
              <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="infff">
                <p>Isaias Caballero</p>
                <p>Dirección: B/Rosal</p>
                <div class="FechaDate"> <h3>Fecha:</h3><p>20/10/2023</p></div>
              </div>

              <div class="listo">
                <div class="co">
                  <p>0003</p>
                </div>
                <div class="chulo">
                  <i class="fa-solid fa-check"></i>
                  <p>Entregado</p>
                </div>
              </div>
            </div>
            <div id="b">
              <button id="but" onclick="abrirG()" class="openModalButton">
                Ver más...
              </button>
            </div>
          </div>

          <div class="c">
            <div class="inf">
              <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="infff">
                <p>Isaias Caballero</p>
                <p>Dirección: B/Rosal</p>
                <div class="FechaDate"> <h3>Fecha:</h3><p>21/10/2023</p></div>
              </div>

              <div class="listo">
                <div class="co">
                  <p>0004</p>
                </div>
                <div class="chulo">
                  <i class="fa-solid fa-check"></i>
                  <p>Entregado</p>
                </div>
              </div>
            </div>
            <div id="b">
              <button id="but" onclick="abrirG()" class="openModalButton">
                Ver más...
              </button>
            </div>
          </div>

          <div class="c">
            <div class="inf">
              <div class="logo">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="infff">
                <p>Isaias Caballero</p>
                <p>Dirección: B/Rosal</p>
                <div class="FechaDate">  <h3>Fecha:</h3><p>22/10/2023</p></div>
              </div>

              <div class="listo">
                <div class="co">
                  <p>0005</p>
                </div>
                <div class="chulo">
                  <i class="fa-solid fa-check"></i>
                  <p id="test">Entregado</p>
                </div>
              </div>
            </div>
            <div id="b">
              <button id="but" onclick="abrirG()" class="openModalButton">
                Ver más...
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- FIN GARAVIZ -->

      <section class="mainDeliverySection" id="notificationsSection">
        <section class="notificationsDelivery">

         

          <!-- <article class="orderAvailable">
            <p>001</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article> -->

          <!-- <article class="orderAvailable">
            <p>002</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article>

          <article class="orderAvailable">
            <p>003</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article>

          <article class="orderAvailable">
            <p>004</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article>

          <article class="orderAvailable">
            <p>005</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article>

          <article class="orderAvailable">
            <p>006</p>
            <div class="nameEPS">
              <img src="assets/img/logoEPS.png" alt="" />
              Nombre EPS
            </div>
            <hr />
            <div class="customerData">
              <span>Dirección: B/Rosal</span>
              <span>Cliente: Isaias Caballero Mendoza</span>
            </div>
            <div class="buttonSeeMore">
              <a href="#" class="seeMore">Ver más</a>
            </div>
          </article> -->
        </section>
      </section>

      <section
        class="mainDeliverySectionTask"
        id="tasksSection"
        style="display: none"
      >
        <section class="pendingTask">
          <div class="taskData">
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
                  <!-- Elemento input de tipo file oculto -->
                  <input type="file" />
              </label>
                <button class="deliver">ENTREGAR</button>
              </div>
            </div>
          </div>
        </section>
      </section>
    </main>

    <!-- Ventana Modal "Ver más" en pedidos disponibles -->
    <div id="myModal" class="modalVerMas">
      <div class="modalVerMas-content">
        <span class="close">&times;</span>
        <h2>Detalles de pedido</h2>
        <p>TIEMPO ESTIMADO: 30min</p>
        <hr />
        <div class="modal-details">
          <div class="deliveryData">
            <div class="epsInfo">
              <p>EPS:</p>
              <img src="assets/img/logoEPS.png" alt="EPS Logo" />
            </div>
            <div class="orderInfo">
              <p>Número de Pedido: <span id="order-number"></span></p>
              <p>Fecha: 12/10/2023</p>
            </div>
          </div>
          <div class="mainAdresses">
            <span>Dirección principal: Sanitas</span>
            <span>Dirección 2: La Rebaja B/Centro Cra: 12</span>
          </div>
          <div class="customer-info">
            <p>Cliente: <span id="customer-name"></span></p>
            <p>Dirección: <span id="customer-address"></span></p>
          </div>
        </div>
        <div class="aplicar">
          <a href="">APLICAR</a>
        </div>
      </div>
    </div>

    <!-- Ventana modal para "Historial" GARAVIZ-->
    <div id="miModal" class="modal" onclick="cerrarG()">
      <div class="modal-contenido">
        <span class="cerrar-modal" id="cerrarModal" onclick="cerrarG()">
          &times;</span
        >
        <div class="cajja">
          <div class="ti">
            <div class="in">
              <p>EPS:</p>
              <p>0001</p>
            </div>
            <div class="inn">
              <span class="un1"></span>
              <span class="un1"></span>
            </div>
            
          </div>
          <p style="margin: 10px;">Direccion principal: Asmet Salud</p>
          <p style="margin: 10px;">Direcccion 2: La rebaja B/centro Cra: 12</p>

          

          <div class="cajjjja">
            <p>Cliente: Isaias Caballero</p>
            <p>Dirección: B/ Rosal</p>
            <p>Fecha: 10/10/2023</p>

            <div class="imaaa">
              <div class="iaam">
                <h1>IMAGEN</h1>
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
      <span
        id="footerTask"
        class="material-symbols-outlined"
        onclick="showTasks()"
      >
        quick_reference_all
      </span>
      <span
        id="footerNotification"
        class="material-symbols-outlined"
        onclick="showNotifications()"
      >
        notifications
      </span>
      <span
        id="footerHistory"
        class="material-symbols-outlined"
        onclick="showNuevoContenido2()"
      >
        history
      </span>
    </footer>

    <script src="assets/js/filtroHistorialDomi.js"></script>
    <script src="assets/js/menuNavConfig.js"></script>
    <script src="assets/js/verMasPedidosDisponibles.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/navConfigDomi.js"></script>
  </body>

  <!-- Garaviz -->
</html>
