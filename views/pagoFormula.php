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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- toast.js -->
    <!-- Enlace a la hoja de estilos de Toastr.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Enlace al JavaScript de Toastr.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

    <!--Id cliente paypal-->
    <script src="https://www.paypal.com/sdk/js?client-id=AVWgpMk3r1AGWqSWCLInEmnNyB8mnUZqQtRrBN6NqEFZ7ycGeHiRT_oM_3_3M4NvsQEzJhLI5HX3EqHQ&currency=USD">
    </script>
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
    <?php require 'factura.html'; ?>
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

                </section>

                <section>
                    <!-- <nav>
                        <ul>
                            <li><a href="">Carrito</i></a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">información</a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">Envios </a></li>
                            <i class="fa-solid fa-chevron-right"></i>
                            <li><a href="">Pagos</a></li>
                        </ul>
                    </nav> -->
                </section>

                <section>
                    <h1>Pagos por</h1>

                    <article>
                        <!-- <button>tienda<i class="fa-brands fa-cc-amazon-pay"></i></button> -->


                        <!-- <p>Contenedor buttons</p> -->
                        <section id="paypal-button-container">

                        </section>



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

                <form class="formulario_contraentrega activeForm" autocomplete="off" method="post" id="contraentregaForm" onsubmit="sendForm(event,'contraentregaForm','../controllers/contraEntregaControllerFormula.php')">

                    <section>
                        <header>
                            <h1>ContraEntrega</h1>
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
                        <!-- <div>
                            <input type="checkbox" name="" id="">
                            <p>Enviarme novedades y ofertas por Correo Electrónico</p>
                        </div> -->
                    </section>
                    <button name='realizarcompra' class="saveContraentrega"></button>
                </form>

            </article>
            </article>
        </section>

        <section class='container2'>
            <div class="contenedor" id="medicamentos">
                <?php
                $nombreAgotado = "";
                if ($result->num_rows > 0) {

                    $subtotalfinal = 0;
                    $medicamentos = array();
                    $subtotal = 0;
                    $medicamentosList = array();

                    $row = $result->fetch_assoc();
                    $nombreFormula = $row['IdFormula'];

                    $datosMedicamento = mysqli_query($conexion, "SELECT *, (medicamentos.precio * M.CantidadMedi) AS costo, I.stock AS stock 
        FROM formulas F
        INNER JOIN medicamentosformulas M ON M.IdFormula = F.idFormula
        INNER JOIN medicamentos ON medicamentos.codigo = M.CodigoMedicamento 
        INNER JOIN inventario I ON I.idmedicamento = medicamentos.idmedicamento 
        WHERE M.IdFormula = '$nombreFormula'");
                    if ($datosMedicamento) {
                        while ($cos = mysqli_fetch_assoc($datosMedicamento)) {
                            echo '<article>';
                            if ($cos['stock'] > 0 && $cos['CantidadMedi'] > 0) {
                                echo '<div>
                        <img src="../uploads/imgProductos/' . $cos["imagenprincipal"] . '" alt="">
                        <p>' . $cos['CantidadMedi'] . '</p>
                    </div>
                    <div>
                        <p>' . $cos['nombre'] . '</p>
                        <p>' . $cos['Concentracion'] . '</p>
                    </div>';

                                $estadoMedicamento = $cos["EstadoFRM"];
                                if ($estadoMedicamento !== "Disponible") {
                                    echo '<div>
                            <p>' . $cos["EstadoFRM"] . '</p>
                        </div>';
                                } else {
                                    $id = $cos['idmedicamento'];
                                    $costo = $cos['CantidadMedi'] * $cos['precio'];
                                    $subtotal += $costo;
                                    $precio_medicamento = $cos['precio'];
                                    $cos['costo'] = $costo;
                                    $medicamentosList[$id] = $cos['CantidadMedi'];
                                    $medicamentos[] = $cos;
                                    echo '<div>
                            <p>$' . $cos["precio"] . '</p>
                        </div>
                        <div class="eliminarProducto" data-id="' . $cos['idmedicamento'] . '">Eliminar <i class="fa-solid fa-trash"></i></div>
                        <input type="hidden" name="idProductos[]" value="' . $cos['idmedicamento'] . '  => ' . $fila['cantidadcarrito'] . '">';
                                }
                            } else {


                                echo '<div>
                                
                                <img src="../uploads/imgProductos/' . $cos["imagenprincipal"] . '" alt="">
                                <p>' . $cos['CantidadMedi'] . '</p>
                            </div>
                            <div>
                                <p>' . $cos['nombre'] . '</p>
                                <p>' . $cos['Concentracion'] . '</p>
                            </div>';
                                $estadoMedicamento = $cos["EstadoFRM"];
                                if ($estadoMedicamento !== "Disponible") {
                                    echo '<div>
                                    <p>' . $cos["EstadoFRM"] . '</p>
                                </div>';
                                }
                            }
                            echo '</article>';
                        }
                    }
                }

                if (!empty($medicamentos)) {
                    $_SESSION['medicamentos'] = $medicamentosList;
                }
                ?>
                <!-- border -->
            </div>

            <article class="total" id="total">
                <hr class="linea">
                <div class='resultformulas'>
                    <h4>Subtotal</h4>
                    <article>
                        <p>solo productos</p>
                        <p><?php echo '$' . $subtotal; ?></p>
                    </article>
                </div>
                <div class='resultformulas'>
                    <?php
                    $usu = $_SESSION['usu'];

                    $copago_query = mysqli_query($conexion, "SELECT * FROM usuarios
                            INNER JOIN copagos C ON C.idcopago = usuarios.idcopago WHERE documento ='$usu'");
                    $copagoid = mysqli_fetch_assoc($copago_query);
                    // copago formulas

                    $porcentaje_copago = $copagoid['porcentaje'];
                    $copago = $precio_medicamento * $porcentaje_copago;
                    ?>
                    <h3>Total</h3>
                    <article>
                        <p>Incluye envío domicilio</p>
                        <p><?php echo '$' . $adicion = 3500; ?></p>
                    </article>
                    <article>
                        <?php
                        // Verificamos si la consulta fue exitosa antes de acceder a sus resultados
                        $adres = mysqli_query($conexion, "SELECT regimen,tipo_afiliacion FROM adres WHERE cedula = $usu");

                        if ($adres) {
                            $adresR = mysqli_fetch_assoc($adres);

                            // Verificamos si $adresR contiene datos antes de acceder a 'regimen'
                            if ($adresR && isset($adresR['regimen'])) {
                                $regimen = $adresR['regimen'];

                                if ($regimen === 'CONTRIBUTIVO') {
                                    echo '<p>Incluye Copago</p>';
                                    echo '<p>$' . $copago . '</p>';
                                } else {
                                    echo 'Eres subsidiado';
                                }
                            } else {
                                echo 'No tienes ningun regimen aún';
                            }
                        } else {
                            echo 'Error en la consulta SQL';
                        }
                        ?>

                    </article>


                </div>
                <div class='resulttotal'>
                    <h4>
                        <?php
                        if ($adresR && isset($adresR['regimen'])) {
                            $regimen = $adresR['regimen'];
                            $afiliacion = $adresR['tipo_afiliacion'];
                            if ($regimen === 'CONTRIBUTIVO' && $afiliacion === 'BENEFICIARIO' || $regimen === 'CONTRIBUTIVO' &&  $afiliacion === 'COTIZANTE') {
                                echo '<p>COP</p>' . ($subtotalfinal = $subtotal + $adicion + $copago);
                            } elseif ($regimen === 'SUBSIDIADO') {
                                echo '<p>COP</p>' . ($subtotalfinal = $subtotal + $adicion);
                            }
                        } else {
                            echo '<p>COP</p>' . ($subtotalfinal = $subtotal + $adicion);
                        }
                        // Se asume que $subtotal está definido en otro lugar del código

                        $response = array(
                            'medicamentos' => $medicamentos,
                            'subtotal' => $subtotalfinal
                        );

                        $_SESSION['subtotal'] = $subtotalfinal;
                        // echo json_encode($response);
                        ?>
                        </h3>

                        <script>
                            function renderizarPaypal() {
                                const monto = <?php echo $subtotalfinal; ?>;
                                console.log(monto)
                                convertirPesosADolares(monto, function(pesoFinal) {
                                    paypal.Buttons({
                                        style: {
                                            color: 'gold',
                                            shape: 'pill',
                                            label: 'pay'
                                        },
                                        createOrder: function(data, actions) {



                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: pesoFinal // Monto de compra
                                                    }
                                                }]

                                            });

                                        },
                                        onApprove: function(data, actions) {
                                            actions.order.capture().then(function(detalles) {
                                                document.getElementById('modalCargar').style.display = 'flex';
                                                fetch('../controllers/procesarCompra.php', {
                                                        method: "POST",
                                                        headers: {
                                                            'Content-Type': 'application/json' // Corregido 'aplication' a 'application'
                                                        },
                                                        body: JSON.stringify({
                                                            detalles: detalles
                                                        })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.success === true) {

                                                            IDCOMPRA = data.idcompra;
                                                            toastr.success('Compra realizada correctamente');
                                                            ConsultarDataFactura(IDCOMPRA);
                                                        }

                                                    })
                                                    .catch(error => {
                                                        console.error('Hubo un error:', error);
                                                    });
                                            });
                                        },
                                        onCancel: function(data) {
                                            toastr.warning("Pago cancelado");

                                        }
                                    }).render('#paypal-button-container');
                                });

                            }


                            function convertirPesosADolares(cantidad, callback) {
                                // Utilizamos una API para obtener la tasa de cambio actual del dólar
                                $.ajax({
                                    url: 'https://api.exchangerate-api.com/v4/latest/USD',
                                    type: 'GET',
                                    success: function(data) {
                                        // Obtenemos la tasa de cambio actual
                                        var tasaCambio = data.rates.COP;

                                        // Realizamos la conversión
                                        var resultado = cantidad / tasaCambio;

                                        resultadoFinal = resultado.toFixed(2);

                                        // Llamamos a la devolución de llamada con el resultado
                                        callback(resultadoFinal);
                                    },
                                    error: function() {
                                        alert('No se pudo obtener la tasa de cambio actual.');
                                    }
                                });
                            }


                            renderizarPaypal();
                        </script>

                </div>
            </article>


        </section>
    </main>
    <script src='../assets/js/contraEntregaFormula.js'></script>
    <script src='../assets/js/añadirMediFormula.js'></script>

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
    <script src="../assets/js/obtenerFactura.js"></script>
</body>

</html>