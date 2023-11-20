<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ESTILOS CSS -->
    <link rel="stylesheet" href="assets/css/adminDomiciliario.css">
    <!-- ICONOS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
      <!-- DG -->
      <script src="https://kit.fontawesome.com/5a100f3f01.js" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>
<body>
    <aside class="asideAdminDelivery">
        <div class="adminProfile">
            <span class="material-symbols-outlined">
                account_circle
                </span>
                <h1>ADMIN</h1>
        </div>
        <nav class="navAdminProfile">
            <span id="icon1" class="material-symbols-outlined">
                two_wheeler
            </span>
            <span id="icon2" class="material-symbols-outlined">
                group_add
            </span>
            <span id="icon3" class="material-symbols-outlined">
                all_inbox
            </span>
        </nav>
        <div class="signOff">
            <button href="">
                Cerrar sesión
            </button>
        </div>
    </aside>

    <main id="mainContent" class="mainAdminDelivery">
        <section id="sectionMain" class="sectionMain">
            <section id="deliverys" class="deliveryActivedDesactived">
                <div class="titleSelect">
                    <h2>Domiciliarios:</h2>
                    <select id="status" name="status">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
                <section class="deliverys">

                <?php
        include("models/domiciliarios.php");
        ?>
                    <!-- <div class="statusDelivery">
                        <div class="imgStatusDelivery" onclick="openModal()">
                            <img src="assets/img/domiciliario1.jpg" alt="">
                        </div>
                        <div class="fullName">
                            <p>Mario Alexander Gomez Lozada</p>
                        </div>
                        <span class="status">
                            INACTIVO
                        </span>
                    </div> -->
    
                 


                </section>
            </section>
    
            <section class="deliveryFreeBusy">
                <section class="deliverysFreeMain">
                    <h3>Domiciliarios Disponibles</h3>
                    <section class="deliverysFree">

                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div>
        
                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div>
        
                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div>
        
                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div>
        
                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div>
        
                        <div class="statusDeliveryFree">
                            <div class="imgStatusDeliveryFree">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameFree">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusFree">
                                Libre
                            </span>
                        </div> 
                    </section>
                </section>
                
                <section class="deliveryBusyMain">
                    <h3>Domiciliarios Ocupados</h3>
                    <section class="deliverysBusy">
                        <div class="statusDeliveryBusy">
                            <div class="imgStatusDeliveryBusy">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameBusy">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusBusy">
                                Ocupado
                            </span>
                        </div>
        
                        <div class="statusDeliveryBusy">
                            <div class="imgStatusDeliveryBusy">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameBusy">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusBusy">
                                Ocupado
                            </span>
                        </div>
        
                        <div class="statusDeliveryBusy">
                            <div class="imgStatusDeliveryBusy">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameBusy">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusBusy">
                                Ocupado
                            </span>
                        </div>
        
                        <div class="statusDeliveryBusy">
                            <div class="imgStatusDeliveryBusy">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameBusy">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusBusy">
                                Ocupado
                            </span>
                        </div>
        
                        <div class="statusDeliveryBusy">
                            <div class="imgStatusDeliveryBusy">
                                <img src="assets/img/domiciliario1.jpg" alt="">
                            </div>
                            <div class="fullNameBusy">
                                <p>Mario Alexander Gomez Lozada</p>
                            </div>
                            <span class="statusBusy">
                                Ocupado
                            </span>
                        </div>
                        
                        
                    </section>
                </section>
                
                 </section>
              </section>
        <section id="sectionIcon2" class="sectionMain" style="display: none;">
            <div class="conte2">
                <div class="personas-container">
                    
                <?php
        include("models/domiPendiente.php");
        ?>
                    <!-- <div class="persona">
                      <i class="fa-solid fa-circle-user"></i>
                      <div class="nombre">Mario Alexander Gomez Losada</div>
                      <button id="but" onclick="abrirG()" class="openModalButton">
                        Ver
                      </button>
                    </div> -->


<!--                     
                    <div class="persona">
                      <i class="fa-solid fa-circle-user"></i>
                      <div class="nombre">Mario Alexander Gomez Losada</div>
                      <button id="but" onclick="abrirG()" class="openModalButton">
                        Ver
                      </button>
                    </div> -->
          
                    <!-- Agrega más divs "persona" según sea necesario -->
                  </div>
            </div>
          
        </section>
        
        <!-- Nuevo contenido para el tercer icono -->
        <section id="sectionIcon3" class="sectionMain" style="display: none;">
          <div class="conte3">


            <section class="botoneees">
              <div class="libres">Libre</div>
              <div class="pendientes">Pendientes</div>
              <div class="entregados">Entregados</div>
            </section>
  
            <section class="estaddos">
              <div class="da">
                  <div class="NFC">
                      N°FC
                  </div>
                  <div class="empre">
                      EMPRESA
                  </div>
                  <div class="esta">
                      ESTADO
                  </div>
                  <div class="repor">
                      REPORTE
                  </div>
              </div>
              <div class="da">
                  <div class="NFC">
                      0001
                  </div>
                  <div class="empre">
                      DROGAS KAROL
                  </div>
                  <div class="esta">
                      <div class="minilibre">
                          Libre
                      </div>
                  </div>
                  <div class="repor">
                      
                  </div>
              </div>
              <div class="da">
                  <div class="NFC">
                      0002
                  </div>
                  <div class="empre">
                      DROGAS MATEO
                  </div>
                  <div class="esta">
                      <div class="minipendiente">
                          Pendiente
                      </div>
                  </div>
                  <div class="repor">
                    <i onclick="abrirModalTress()" id="peligro" class="fa-solid fa-triangle-exclamation"></i>
                  </div>
              </div>
              <div class="da">
                  <div class="NFC">
                      0003
                  </div>
                  <div class="empre">
                      DROGAS LA REBAJA
                  </div>
                  <div class="esta">
                      <div class="minientregado">
                          Entregado
                      </div>
                  </div>
                  <div class="repor">
                      <i onclick="abrirModalTress()" id="peligro" class="fa-solid fa-triangle-exclamation"></i>
                  </div>
              </div>
            </section>
  
  
          </div>
        </section>
    </main>



    <!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal_body">
            <div class="imgStatusDeliveryModal">
                <img id="modalImage" src="" alt="">
            </div>
            <div class="modal-info">
                <p><strong>Nombre:</strong> <span id="modalName"></span></p>
                <p><strong>Apellidos:</strong> <span id="modalLastName"></span></p>
                <p><strong>Edad:</strong> <span id="modalAge"></span></p>
                <p><strong>Teléfono:</strong> <span id="modalPhone"></span></p>
                <p><strong>Correo:</strong> <span id="modalEmail"></span></p>
                <p><strong>Dirección:</strong> <span id="modalAddress"></span></p>
            </div>
        </div>
        <div class="modal-buttons">
            <div class="DA">
                <button class="deactivate" onclick="deactivate()">Desactivar</button>
                <button class="activate" onclick="activate()">Activar</button>
            </div>
            <button onclick="openCalificacionModal()">Calificación</button>
            
        </div>
    </div>
</div>

<div id="modalCalificacion" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCalificacionModal()">&times;</span>
        <div class="modal-header">
            <h2>Calificación Domiciliario</h2>
        </div>
        <div class="modal-body">
                <div id="estrellas" onclick="calificar(event)">
                    <span class="estrella">&#9733;</span>
                    <span class="estrella">&#9733;</span>
                    <span class="estrella">&#9733;</span>
                    <span class="estrella">&#9733;</span>
                    <span class="estrella">&#9733;</span>
                </div>
            <div class="comentarios-container">
                <h3>Comentarios de los usuarios:</h3>
                <div id="comentariosList">
                    <!-- Contenido de comentarios -->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- DG MODALES -->

<!-- MODAL 2 -->
<div id="miModal" class="modal" >
  <div class="modal-contenido" >
    <span class="cerrar-modal" id="cerrarModal" onclick="cerrarG()">&times;</span>
    <div class="modal-bodyDoss">
      <div class="imgStatusDeliveryModlDoss">
        <i id="usserDoss" class="fa-solid fa-circle-user"></i>
      </div>
      <div class="modal-infoDoss">
        <p>
          <strong>Nombre: <p id="nombreDomi"></p></strong>
          <span id="modalNameDoss"></span>
        </p>
        <p>
          <strong>Apellidos: Garaviz Scarpetta</strong>
          <span id="modalLastNameDoss"></span>
        </p>
        <p><strong>Edad: 19</strong> <span id="modalAgeDoss"></span></p>
        <p>
          <strong>Teléfono: 3112703384</strong>
          <span id="modalPhoneDoss"></span>
        </p>
        <p>
          <strong>Correo: graixz4gmailcom</strong>
          <span id="modalEmailDoss"></span>
        </p>
        <p>
          <strong>Dirección: Calle 3a N°18-26</strong>
          <span id="modalAddressDoss"></span>
        </p>
        <input type="file" name="" id="pdfDoss" />
      </div>
      <div class="modal-buttonsDoss">
        <div class="DADoss">
          <button class="acepDoss">Aceptar</button>
          <button class="rechaDoss">Rechazar</button>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- MODAL 3 -->
<div id="myModalTress" class="modalTress">
    <div class="modal-contentTress">
        <span id="cerrarModalTress" class="closeTress">&times;</span>
        <div class="tiiituu">
            <h1>REPORTE</h1>
            <h1>N°Fac: 0001</h1>
        </div>
        <textarea name="" id="textoReporte" cols="20" rows="10"></textarea>
        <input id="ccdomi" type="text" placeholder="CC. DOMI">
        <div class="cen">
            <button id="enviarBtn" class="buu">Enviar</button>
        </div>
    </div>
    </div>




<script src="assets/js/cambiarOpcionesAdminDomiciliario.js"></script>
<script src="assets/js/calificacionDomiciliario.js"></script>
<script src="assets/js/verInformacionDomiciliario.js"></script>


<!-- Js DG -->
<script src="assets/js/peligro.js"></script>
<script src="assets/js/modal2G.js"></script>

</body>
</html>