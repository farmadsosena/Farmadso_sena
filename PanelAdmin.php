<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/panelAdmin.css" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="assets/img/logoPerfilFarmacia.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/0015840e45.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Panel de administración</title>
</head>

<body>
    <!--  Sidebar -->
    <aside id="sidebar">
        <nav id="topNav">
            <picture id="logoSena">
                <button id="profileView" onclick="alert('edit')">
                    <i class="bx bx-message-square-edit" style="color: #4d82bc"></i>
                </button>
                <img src="assets/img/logoPerfilFarmacia.png" alt="" />
            </picture>
            <section id="itemContainer">
                <div class="item activeItem" onclick="mostrarContenido('inicio', this)">
                    <i class="bx bx-home"></i>
                    <p>Inicio</p>
                </div>
                <div class="item" onclick="mostrarContenido('medicamentos', this)">
                    <i class="bx bxs-capsule"></i>
                    <p>Medicamentos</p>
                </div>
                <div class="item" onclick="mostrarContenido('categorias', this)">
                    <i class="bx bx-grid"></i>
                    <p>Categorias</p>
                </div>
                <div class="item" onclick="mostrarContenido('backlog', this)">
                    <i class="bx bx-list-ul"></i>
                    <p>Backlog</p>
                </div>
                <div class="item" onclick="mostrarContenido('graficas', this)">
                    <i class="bx bx-chart"></i>
                    <p>Graficas</p>
                </div>
                <div class="item" onclick="mostrarContenido('ventas', this)">
                    <i class="bx bx-cart"></i>
                    <p>Ventas</p>
                </div>
                <div class="item" onclick="mostrarContenido('informe', this)">
                    <i class="bx bx-file"></i>
                    <p>Informe</p>
                </div>
            </section>
        </nav>

        <button class="singOut item">
            <i class="bx bx-log-out-circle"></i>
            <p>Cerrar Sesión</p>
        </button>
    </aside>    

    <!-- Main -->
    <main id="main">
        <section class="artWrap">
            <article onclick="openModalInventario()" class="art" style="border-left: 0.27em solid #00c16c; cursor: pointer;">
                <img src="assets/img/inventarioAdmin.jpg" alt="Icono de Receta Médica" />
                <span>
                    <h3>Inventario de Medicamentos</h3>
                    <p>Gestione su inventario de medicamentos.</p>
                </span>
            </article>

            <div class="art" style="border-left: 0.27em solid #9696ce">
                <img src="assets/img/ofertasAdmin.jpg" alt="Imagen de la oferta" />
                <span>
                    <h3>Ofertas</h3>
                    <p>Personaliza tus propias ofertas.</p>
                </span>
            </div>

            <div onclick="openModalComentarios()" class="art" style="border-left: 0.27em solid #3b7dd3">
                <img src="assets/img/opinionesClientes.jpg" alt="Imagen de la oferta" />
                <span>
                    <h3>Opiniones de Clientes</h3>
                    <p>Experiencias de clientes</p>
                </span>
            </div>

            <div class="art" style="border-left: 0.27em solid #ffeb3b">
                <img src="assets/img/facturacionAdmin.jpg" alt="Imagen de facturas" />
                <span>
                    <h3>Facturación</h3>
                    <p>Historial de facturas y transacciones</p>
                </span>
            </div>
        </section>

        <!-- Section the content -->

        <section id="contentSection">
            <section id="contentUpdate">

                <section class="page visiblePage" id="inicio">
                    <h2>Contenido inicio</h2>
                    <img src="" alt="">
                </section>


                <section class="page" id="medicamentos">
                    <!-- Primera vista -->
                   
                                <!-- INICIO DE ARTICULOS GENERADOS CON WHILE -->
                   <?php 
                   
                   require_once 'templates/medicamentos.php';
                   ?>
                   
                                <!-- CIERRA ARTICULOS QUE SERIAN GENERADOS CON WHILE -->
                    
                    <!-- cierrra primera vista -->

                    <!-- Abre formulario -->
                  <?php
                  require_once 'templates/FormularioMedicamentos.php';
                  ?>
                   <?php
                  require_once 'templates/editarMedicamentos.php';
                  ?>
                    <!-- cierra formulario -->
                </section>


                <section class="page" id="categorias">

                    <!-- Primera vista categorias agregadas -->
                    <div class="container-categoria">
                        <button onclick="openFormCategories()" class="btn-agregar">Agregar Categorias <i
                            class="bx bx-plus-circle"></i> </button>
                            <div class="scroll-categories">
                        <div class="contenedorCategoria">
                        <div class="category">
                            <div class="nombre">
                                <h1>Vitaminas</h1>
                            </div>
                            <div class="descripcion">
                                <h1>Descripcion del producto</h1>
                            </div>
                            <div class="buttons">
                                <button class="btn-editar">Editar<i
                                    class="bx bx-pencil"></i> </button>
                                    <button class="btn-eliminar">Eliminar <i
                                        class="bx bx-trash"></i> </button>
                            </div>
                        </div>
            
                        </div>
                    </div>
                    </div>
                    <!-- Fin de primera vista de categorias -->


                    <div class="categorias">
                        <i class="bx bx-chevron-left" onclick="closeFormCategories()"></i>

                        <form id="categoryAdd"
                            onsubmit="sendForm(event, 'categoryAdd', 'controllers/agregarCategoria.php' )">
                            <section class="separadores">
                                <label for="">Nombre categoria</label>
                                <input type="text" name="nombrecategoria" placeholder="Ingresa nombre categoria"
                                    class="input">
                            </section>

                            <section class="separadores">
                                <label for="">Descripcion</label>
                                <input type="text" name="descripcion" placeholder="Descripción" class="input">
                            </section>


                            <input type="submit" value="Agregar Categoria" class="boton_aggcategoria">

                        </form>

                    </div>
                </section>
                <section class="page" id="backlog">


                    <div class="itemHistorial">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>Fecha</div>
                        <div>Mensaje</div>
                        <div>Usuario</div>
                        <div>Ip</div>
                        <div>Tipo dispositivo</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>
                    <div class="itemHistorial">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div>2023-10-18 00:38:00</div>
                        <div>Se ha eliminado aspirina con codigo #3445 </div>
                        <div>Administrador</div>
                        <div>191.102.85.194</div>
                        <div>Computadora</div>
                    </div>




                    <!-- <script>
                        document.querySelector('#borrarHistorial').addEventListener('click', () => {
                            const eliminarHistorial = 1;
                            fetch('../controllers/eliminarHistorial.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(eliminarHistorial)
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data === 'Correcto') {
                                        // Cargar contenido.php usando fetch
                                        fetch('../controllers/historialLogs.php')
                                            .then(response => response.text())
                                            .then(content => {
                                                // Colocar el contenido en el contenedor VERHISTORIAL
                                                document.querySelector('#VERHISTORIAL').innerHTML = content;
                                            })
                                            .catch(error => {
                                                console.error('Error:', error);
                                            });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    </script> -->
                </section>
                <section class="page" id="graficas">
                    <h2>Graficas</h2>
                </section>
                <section class="page" id="ventas">
                    <!-- INICIA PRIMERA VISTA DE VENTAS -->
                    <div class="container-detalles">
                            <div class="scroll-categories">
                        <div class="contenedorCategoria">
                        <div class="category">
                            <div class="nombre">
                                <h1>Acetaminofen</h1>
                            </div>
                            <div class="descripcion">
                                <h1>dosmil peso</h1>
                            </div>
                            <div class="buttons">
                                <button onclick="openDetalles()" class="btn-agregar">Ver detalles<i
                                    class="fas fa-info-circle"></i> </button>
                            </div>
                        </div>
                
                        </div>
                    </div>
                    </div>
                    <!-- CIERRA PRIMERA VISTA DE VENTAS -->

                    <!-- INICIA DETALLES DE VENTA -->
                    <div class="detalles">
                        <i class="bx bx-chevron-left" onclick="closeDetalles()"></i>
 <pre>
                        Factura para la compra
Cliente: Nombre Cliente (cliente@email.com)
Fecha de compra: 2023-10-16

Detalles de la compra:
Medicamento: Medicamento A
Cantidad: 3
Precio unitario: $10
Subtotal: $30

Medicamento: Medicamento B
Cantidad: 4
Precio unitario: $15
Subtotal: $60

Total: $90
                    </pre>

                    </div>
                   
                    <!-- CIERRA DETALLES DE VENTA -->
                </section>
                <section class="page" id="informe">
                    <h2>Informe</h2>
                </section>
            </section>

            <aside id="sidebarContent">

                <h3>preferencias Clientes</h3>
                <canvas class="graphic" id="ingresosAnualesLineChart"></canvas>

                <h3>ventas Por Categoria</h3>
                <canvas class="graphic" id="ventasMensualesBarChart"></canvas>



            </aside>
        </section>
    </main>


<!-- VENTANAS MODALS YISHSHS MM QUE RIKI -->


<!-- VENTANA QUE HIZO ESTIVENSON EL QUINTANA -->
<?php
require_once "templates/inventario.php"
?>
<!-- CIERRA LA VENTANA DEL ESTIVENSON -->

<!-- VENTANA COMENTARIOS -->

<!-- CIERRA VENTANA COMENTARIOS -->

<!-- CIERRA VENTANAS MODALS -->

    <script src="assets/js/menuPanelAdmin.js"></script>
    <script src="assets/js/funciones-farmacia.js"></script>
    <script src="assets/js/formularioM.js"></script>
    <script src="assets/js/graphisAdminFarmacia.js"></script>
    <script src="assets/js/enviarFormsAdmin.js"></script>
    <script src="assets/js/Ventanas-modals.js"></script>
    <script src="assets/js/filtromedicamentos.js"></script>
    <script src="assets/js/formularioEditar.js"></script>
</body>

</html>