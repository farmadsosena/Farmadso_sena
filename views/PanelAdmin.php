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
    <!--  Sidebar -->
    <aside id="sidebar">
        <nav id="topNav">
            <picture id="logoSena">
                <button id="profileView" onclick="alert('edit')">
                    <i class="bx bx-message-square-edit" style="color: #4d82bc"></i>
                </button>
                <img src="../assets/img/logoPerfilFarmacia.png" alt="" />
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
                <div class="item" onclick="mostrarContenido('informe', this)">
                    <i class="bx bx-file"></i>
                    <p>Informe</p>
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

                            if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 'Aceptado')) {
                                echo '<div class="option">
                                        <i class="bx bx-car"></i> Domiciliario
                                    </div>';
                            }
                            // if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 'Aceptado')) {
                            //     echo '<div class="option">
                            //             <i class="bx bxs-business"></i> Farmaceutico
                            //         </div>';
                            // }
                            if (existe_en_tabla('usuarios', $id, 'estado', '1')) {
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

        <a class="singOut item" href="../config/cerrarSesion.php">
            <i class="bx bx-log-out-circle"></i>
            <p>Cerrar Sesión</p>
        </a>
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

            <div onclick="openModalComentarios()" class="art" style="border-left: 0.27em solid #3b7dd3">
                <img src="../assets/img/opinionesClientes.jpg" alt="Imagen de la oferta" />
                <span>
                    <h3>Opiniones de Clientes</h3>
                    <p>Experiencias de clientes</p>
                </span>
            </div>

            <div class="art" style="border-left: 0.27em solid #ffeb3b">
                <img src="../assets/img/facturacionAdmin.jpg" alt="Imagen de facturas" />
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
                        <button onclick="openFormCategories()" class="btn-agregar">Agregar Categorias <i class="bx bx-plus-circle"></i> </button>
                        <div class="scroll-categories">
                            <div class="contenedorCategoria" id="contenedorCategoria">
       
                            </div>
                        </div>
                    </div>
                    <!-- Fin de primera vista de categorias -->
                    <!-- Formulario agregar categorias -->
                    <?php
                    require_once '../templates/FormularioCategorias.html';
                    ?>
                    <!-- Fin formulario agregar categorias -->

                </section>
                <section class="page" id="backlog">
                 
                    <?php 
                    require_once '../controllers/historialLogs.php'; 
                    
                    ?>
                    <script>
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
                                        fetch('../models/logData.php')
                                            .then(response => response.text())
                                            .then(content => {
                                                // Colocar el contenido en el contenedor VERHISTORIAL
                                                document.querySelector('#backlog').innerHTML = content;
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
                    </script>
                       <button id="borrarHistorial">Borrar todo el historial</button>
                </section>
                <section class="page" id="graficas">
                    <h2>Graficas</h2>
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
                <section class="page" id="informe">
                    <h2>Informe</h2>
                    <?php 
                    require_once '../templates/generarInforme.html';
                     ?>
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
   require_once '../templates/inventario.php';

   require_once '../templates/comentarios.php';

   require_once '../templates/Ofertas.php';

   require_once '../templates/historialCompras.php';
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
    <script src="../assets/js/filtromedicamentos.js"></script>
    <script src="../assets/js/formularioEditar.js"></script>
    <script src="../assets/js/Categoria.js"></script>
</body>

</html>