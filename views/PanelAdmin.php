    <?php
    session_start();
    include "../config/Conexion.php";

    if (!isset($_SESSION["usu"])) { 
        echo "<script> window.location='login.php'</script>";
    }

    if (!isset($_SESSION["farm"])) {
        echo "<script> window.location='login.php'</script>";
    }


    $id = $_SESSION["id"];

    $eps = $_SESSION["eps"];
    $imgUser = $_SESSION['img'];
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../assets/css/panelAdmin.css" />
        <link rel="stylesheet" href="../assets/css/ofertas_farmacia.css" />
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
        <link rel="shortcut icon" href="../assets/img/logoPerfilFarmacia.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://kit.fontawesome.com/0015840e45.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <title>Panel de administración</title>
    </head>

    <body>
        <!-- Para mobil -->
        <div class="hemberger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <!--  Sidebar -->
        <aside id="sidebar">
    <ul>
        <nav id="topNav">
       

            <picture id="logoSena">
                <button id="profileView" onclick="openModalFarmaciaP()" >
                    <i class="bx bx-message-square-edit"  style="color: #4d82bc; cursor:pointer;"></i>
                </button>
                <?php
    
                $query = "SELECT * FROM farmacias WHERE idusuario = $id";
                $result = $conexion->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                
                    // Mostrar la imagen
                    $imgPath = "../uploads/imgPerfilFarmacia/".$row["imgfarmacia"];
   
                    if (file_exists($imgPath)) {
                        echo '<img style="cursor:pointer;" onclick="openModalFarmaciaP()" src="' . $imgPath . '" alt="" />';
                    } else {
                        echo '<img style="border:1px solid gray;" src="../assets/img/default.jpg" alt="Imagen predeterminada" />';
                    }
               require_once '../templates/editarFarmacia.php';
   
                   }
   
                ?>
                
            </picture>

            <section id="itemContainer">
                <div class="item activeItem" onclick="mostrarContenido('inicio', this)">
                    <i class="bx bx-home"></i>
                    <p>Inicio</p>
                </div>
                <div class="item medicamnentos-btn" onclick="mostrarContenido('medicamentos', this)">
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

                <div class="item">
                    <div class="custom-select">
                        <div class="selected-option">
                            <i class="bx bxs-business"></i> Cuenta farmaceutico
                        </div>
                        <div class="options">
                            <?php
                            function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
                            {
                                global $conexion;
                                $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
                                $stmt = $conexion->prepare($consulta);
                                $stmt->bind_param("ss", $usuario, $valorEstado);
                                $stmt->execute();
                                $resultado = $stmt->get_result();
                                return $resultado->num_rows > 0;
                            }

                            if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', '2')) {
                                echo '<div class="option">
                                        <i class="bx bx-car"></i> Domiciliario
                                    </div>';
                            }
                            // if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 'Aceptado')) {
                            //     echo '<div class="option">
                            //             <i class="bx bxs-business"></i> Farmaceutico
                            //         </div>';
                            // }
                            if (existe_en_tabla('usuarios', $id, 'estado', '2')) {
                                echo '<div class="option">
                                        <i class="bx bx-user-circle"></i> Cuenta de usuario
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </nav>

        <a class="singOut item" href="../config/cerrarSesion.php" onsubmit="return confirm('Esta funcion indicará que el domiciliario tiene los productos de');">
            <i class="bx bx-log-out-circle"></i>
            <p>Cerrar Sesión</p>

            
        </a>
        
        </ul>
    </aside>

        <!-- Main -->
        <main id="main">
            <section class="artWrap">
                <article onclick="openModalInventario()" class="art" style="border-left: 0.27em solid #00c16c; cursor: pointer;">
                    <img src="../assets/img/inventarioAdmin.jpg" alt="Icono de Receta Médica" />
                    <span>
                        <h3>Inventario de Medicamentos</h3>
                        <p>Gestione su inventario de medicamentos.</p>
                    </span>
                </article>

                <article onclick="openModalOfertas()" class="art" style="border-left: 0.27em solid #9696ce">
                    <img src="../assets/img/ofertasAdmin.jpg" alt="Imagen de la oferta" />
                    <span>
                        <h3>Ofertas</h3>
                        <p>Personaliza tus propias ofertas.</p>
                    </span>
                </article>
    <!-- 
                <div onclick="openModalComentarios()" class="art" style="border-left: 0.27em solid #3b7dd3">
                    <img src="../assets/img/opinionesClientes.jpg" alt="Imagen de la oferta" />
                    <span>
                        <h3>Opiniones de Clientes</h3>
                        <p>Experiencias de clientes</p>
                    </span>
                </div> -->

                <article onclick="openModalInforme()" class="art" style="border-left: 0.27em solid #ffeb3b">
                    <img src="../assets/img/facturacionAdmin.jpg" alt="Imagen de facturas" />
                    <span>
                        <h3>Informe</h3>
                        <p>Consulta y genera informe de tus ventas</p>
                    </span>
                        </article>
            </section>

            <!-- Section the content -->

            <section id="contentSection">
                <section id="contentUpdate">

                    <section class="page visiblePage" id="inicio">
                        <div class="imagencontenedorincial">
                        <img src="../assets/img/¡Bienvenido!.png" style="width:70%; ailing-self:center;" alt="">

                        </div>
                    </section>


                    <section class="page" id="medicamentos">
                        <!-- Primera vista -->

                        <!-- INICIO DE ARTICULOS GENERADOS CON WHILE -->
                        <?php
                        require_once '../templates/medicamentos.php';
                        ?>

                        <!-- CIERRA ARTICULOS QUE SERIAN GENERADOS CON WHILE -->

                        <!-- cierrra primera vista -->

                        <!-- Abre formulario -->
                        <?php
                        require_once '../templates/FormularioMedicamentos.php';

                        require_once '../templates/editarMedicamentos.php';
                        ?>
                        <!-- cierra formulario -->
                    </section>


                    <section class="page" id="categorias">
        <!-- Primera vista categorias agregadas -->
        <div class="container-categoria">
                            <button onclick="openFormCategories()" class="btn-agregar">Agregar Categorias <i
                                    class="bx bx-plus-circle"></i> </button>
                            <div class="scroll-categories">
                                <div class="contenedorCategoria" id="contenedorCategoria">

                                </div>
                            </div>
                        </div>
                        <!-- Fin de primera vista de categorias -->
                        <!-- Formulario agregar categorias -->
                        <div class="categorias">
                            <i class="bx bx-chevron-left" onclick="closeFormCategories()"></i>
                            <form id="categoryAdd" class="formulario1" method="post" action="" enctype="multipart/form-data">
                                <section class="separadores">
                                    <label for="nombrecategoria">Nombre categoría</label>
                                    <input type="text" name="nombrecategoria" id="nombrecategoria"
                                        placeholder="Ingresa nombre categoría" class="input">
                                </section>
                                <section class="separadores">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" name="descripcion" id="descripcioncategoria"
                                        placeholder="Descripción" class="input">
                                </section>
                                <section class="separadores">
                                    <label for="imgCategory">Agregar imagen:</label>
                                    <input type="file" name="imgCategory" accept="image/*" />
                                </section>

                                <input type="submit" id="boton" name="enviarE" value="AgregarCategoria" class="boton_aggcategoria">
                            
                            </form>

                            <form id="form_edit" class="formulario2" method="post" action="" enctype="multipart/form-data">
                                <section class="separadores">
                                    <input type="hidden" name="number999" id="number999" value="">
                                    <label for="editcategoria">Nombre categoría</label>
                                    <input type="text" name="editcategoria" id="editcategoria"
                                        placeholder="Ingresa nombre categoría" class="input">
                                </section>
                                <section class="separadores">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" name="descripcion" id="editdescripcioncategoria"
                                        placeholder="Descripción" class="input">
                                </section>
                                <section class="separadores">
                                    <label for="imgCategory">Agregar imagen:</label>
                                    <input type="file" name="imgCategory" accept="image/*" />
                                </section>

                                <input type="submit" id="boton" name="enviarE" value="Editar" class="boton_aggcategoria">
                            
                            </form>


                        </div>


                        <!-- Fin formulario agregar categorias -->

                    </section>
                    <section class="page" id="backlog">
                
                        <?php 
                        require_once '../controllers/historialLogs.php'; 
                        ?>
                        
    <form action="../controllers/eliminarHistorial.php" method="post">
        <input type="submit" value="Eliminar Historial" name="eliminar_historial" id="borrarHistorial">
    </form>

                    </section>


                    <section class="page" id="graficas">

<div class="cont-grafics" id="myContent">
   
    <h1 id="headerGraficos">VENTAS SEMANALES</h1>
                    <div class="graficos">
                    <canvas id="chartSemanal" class="graficasFarmacia" ></canvas> 
                    </div>

                    <div class="graficos" id="gr2"> 
                    <canvas id="chartMensual" class="graficasFarmacia" ></canvas>
                    </div>

                    </div>


                    </section>



                    <section class="page" id="ventas">
                        <!-- INICIA PRIMERA VISTA DE VENTAS -->
                        <?php 
                        require_once '../templates/detallesVentas.php';
                        ?>
                        <!-- CIERRA PRIMERA VISTA DE VENTAS -->

                                
                        <div class="detalles">

                        </div>
                        <!-- INICIA DETALLES DE VENTA -->
            
                        <!-- CIERRA DETALLES DE VENTA -->
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


        <!-- VENTANAS MODALS YISHSHS MM QUE RIKI
                                AJJAJAJAJAJ MEJIAAAA PRRRRRB
        -->


        <!-- VENTANA QUE HIZO ESTIVENSON EL QUINTANA -->
        <?php
    require_once '../templates/inventario.php';

    require_once '../templates/Ofertas.php';

    require_once '../templates/generarInforme.html';
        ?>
        <!-- CIERRA LA VENTANA DEL ESTIVENSON -->

        <!-- VENTANA COMENTARIOS -->

        <!-- CIERRA VENTANA COMENTARIOS -->

        <!-- CIERRA VENTANAS MODALS -->

        <script src="../assets/js/menuPanelAdmin.js"></script>
        <script src="../assets/js/usuarioJS.js"></script>
        <script src="../assets/js/funciones-farmacia.js"></script>
        <script src="../assets/js/formularioM.js"></script>
        <script src="../assets/js/graphisAdminFarmacia.js"></script>
        <script src="../assets/js/enviarFormsAdmin.js"></script>
        <script src="../assets/js/Ventanas-modals.js"></script>
        <script src="../assets/js/medicamentos-Form.js"></script>
        <script src="../assets/js/filtromedicamentos.js"></script>
        <script src="../assets/js/formularioEditar.js"></script>
        <script src="../assets/js/generarInforme.js"></script>
        <script src="../assets/js/abrirmenu.js"></script>
    </body>

    </html>