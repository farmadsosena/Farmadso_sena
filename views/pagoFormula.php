<?php
session_start();
if (!$_SESSION['id']) {
    header('location: login.php');
}
include("../config/Conexion.php");
$idFormula = $_SESSION["clave"];
$sql = "SELECT * FROM medicamentosformulas WHERE IdFormula = '$idFormula'";
$result = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pagoFomula.css">
    <link rel="stylesheet" href="../assets/css/pagoConCard.css" />
    <link rel="stylesheet" href="../assets/css/animacionCarga.css" />
    <!-- <link rel="stylesheet" href="../assets/css/contraentrega.css"> -->
    <script src="https://kit.fontawesome.com/6262aa5408.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- toast.js -->
    <!-- Enlace a la hoja de estilos de Toastr.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Enlace al JavaScript de Toastr.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Pedido Fórmula</title>
</head>

<body>


    <section id="modalCargar">
        <div class="three-body">
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
        </div>
        <p>Cargando...</p>
    </section>
    <div class="container">
        <header class="cabecera">
            <section>
                <article><i class="fa-brands fa-facebook"></i></article>
                <article><i class="fa-brands fa-instagram"></i></article>
                <article><i class="fa-brands fa-youtube"></i></article>
            </section>
            <section>
                <h1>Nueva Fomula por Reclamar</h1>
                <i class="fa-solid fa-chevron-right"></i>
                <a href="inicio_tienda.php">Tienda Virtual</a>
            </section>
            <?php
            echo $_SESSION['id'];
            ?>
            <section>
                <h1>Colombia(ESP <i class="fa-solid fa-arrow-down"></i>)</h1>
            </section>
        </header>


        <section class="containerdos">
            <nav class="navegacion">
                <ul>
                    <li><a href="">Tienda</a></li>
                    <li><a href="">Medicamentos</a></li>
                    <li><a href="">Farmacias</a></li>
                </ul>
            </nav>

            <img src="../assets/img/LogoFarmadsoLargo.png" alt="">

            <article>
                <i class="fa-solid fa-user"></i>
                <i class="fa-solid fa-unlock-keyhole"></i>
            </article>
        </section>
    </div>

    <main class="menu">
        <section>
            <article class="menu-uno">
                <section>
                    <span></span>
                </section>

                <section>
                    <nav>
                        <ul>
                            <li><a href="">Carrito</i></a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">información</a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">Envios </a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">Pagos</a></li>
                        </ul>
                    </nav>
                </section>

                <section>
                    <h1>Pagos por</h1>

                    <article>
                        <!-- <button>tienda<i class="fa-brands fa-cc-amazon-pay"></i></button> -->
                       
                            <button>
                                <a href="paypal.php">
                                <span>
                                    <i class="fa-brands fa-paypal"></i>
                                </span>
                                <span>Pay</span><span>Pal</span>
                                </a>
                            </button>

                        
                        <!-- <button><i class="fa-brands fa-google-pay"></i></button> -->
                    </article>
                </section>

                <section>
                    <div></div>
                    <p>O</p>
                    <div></div>
                </section>
            </article>

            <article class="menu-dos">
                <!-- <section>
                    <h1>Información de Contacto</h1>
                    <div>
                        <h1>¿Ya tienes una cuenta?</h1>
                        <a href="">Iniciar Sesión</a>
                    </div>
                </section> -->

                <form class="formulario_contraentrega activeForm" autocomplete="off" method="post" id="contraentregaForm" onsubmit="sendForm(event,'contraentregaForm','../controllers/contraEntregaControlleradd.php')">

                    <section>
                        <header>
                            <h1>Dirección de Envío</h1>
                        </header>
                        <div>

                            <input type="text" name='nombre' placeholder="Nombres">
                            <input type="text" name='apellido' placeholder="Apellidos">
                        </div>
                        <div>
                            <input type="text" name="direccion" placeholder='Direccion'>
                            <input type="tel" name="telefono" placeholder='telefono'>
                        </div>
                        <div>
                            <textarea name="instrucciones" rows="3" placeholder="instrucciones de envio"></textarea>
                        </div>

                    </section>
                    <section>
                        <input type="text" name="correo" placeholder='Correo'>
                        <div>
                            <input type="checkbox" name="" id="">
                            <p>Enviarme novedades y ofertas por Correo Electrónico</p>
                        </div>
                    </section>
                    <button name='realizarcompra' class="saveContraentrega"></button>
                </form>

            </article>
            </article>
        </section>

        <section>
            <div class="contenedor">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $nombreMedicamento = $row["medicamento"];
                        $datosMedicamento = mysqli_query($conexion, "SELECT * ,(medicamentos.precio * M.CantidadMedi) AS costo FROM medicamentos INNER JOIN medicamentosformulas M ON M.CodigoMedicamento = medicamentos.codigo 
                        WHERE nombre ='$nombreMedicamento'");
                        $cos = mysqli_fetch_assoc($datosMedicamento);


                        if (mysqli_num_rows($datosMedicamento) > 0) {

                            echo '<article>
                            <div>
                                <img src="../uploads/imgProductos/' . $cos["imagenprincipal"] . '" alt="">
                                <p>1</p>
                            </div>
                            <div>
                                <p>' . $nombreMedicamento . '</p>
                                <p>100mg</p>
                            </div>
                            ';
                            $estadoMedicamento = $row["EstadoFRM"];
                            if ($estadoMedicamento !== "Disponible") {
                                echo '<div>
                                    <p>' . $row["EstadoFRM"] . '</p>
                                 </div>';
                            } else {
                                $costo = $cos['precio'] * $cos['CantidadMedi'];
                                $subtotal = $costo;
                                // $id = $cos['idmedicamento'];
                                // // Agrega el producto al array $medicamentos
                                // $cos['costo'] = $costo;
                                // $medicamentosList[$id] = $cos['CantidadMedi'];
                                // $medicamentos[] = $cos;
                                echo '<div>
                                     <p>$' . $cos["precio"] . '</p>
                                </div>';
                            }
                            echo "</article>";
                        }
                        
                    }
                }

                $response = array(
                    // 'medicamentos' => $medicamentos,
                    // 'subtotal' => $subtotal
                );

                // $_SESSION['medicamentos'] = $medicamentosList;
                
                echo json_encode($response);
                ?>
                <!-- border -->
            </div>

            <article class="comprar">
                <input type="text" placeholder="Tarjeta de Regalo o Código de descuento">
                <button> Usar</button>
            </article>

            <article class="total">
                <span>
                    <h2>Subtotal</h2>
                    <h3>Envios</h3>
                </span>
                <span>
                    <h1 class='subtotalvalor'><?php
                                                // if ($costo > 0) {
                                                //     echo '$' . "" . $subtotal;
                                                // } else {
                                                //     echo 0;
                                                // }
                                                 ?>
                    </h1>
                    <h3>Calculado en el siguiente paso</h3>
                </span>
            </article>

            <article class="total">
                <div>
                    <h3>Total</h3>

                    <p>Incluye $ <?php echo $adicion = 3500 ?> de envio domicilio </p>
                </div>
                <div>
                    <p>COP</p>
                    <h1><?php 
                    // $total = $subtotal + $adicion;
                    //     if ($subtotal > 0) {
                    //         echo '$' . "" . $valor = $total;
                    //     } else {
                    //         echo 0;
                    //     }
                        ?></h1>
                </div>
            </article>
        </section>
    </main>
    <script src='../assets/js/contraEntregaFormula.js'></script>

    <script src="../assets/js/consultarCart.js"></script> 
    <script>
        // Verifica si el ancho de la ventana es menor que un cierto valor (ajusta el valor según tus necesidades)
        if (window.innerWidth <= 768) {
            // Obtén la altura de la ventana gráfica en vh
            const windowHeightVh = window.innerHeight;

            // Selecciona el elemento por su id
            const bodyContraentrega = document.getElementById("bodyContraentrega");

            // Establece la altura del elemento en px
            bodyContraentrega.style.height = windowHeightVh + "px";
        }
    </script>
</body>

</html>