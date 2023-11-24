<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/contraentrega.css" />
    <link rel="stylesheet" href="../assets/css/pagoConCard.css" />
    <link rel="stylesheet" href="../assets/css/animacionCarga.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- toast.js -->
    <!-- Enlace a la hoja de estilos de Toastr.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <!-- Enlace al JavaScript de Toastr.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Contraentrega</title>
</head>

<body id="bodyContraentrega">

    <section id="modalCargar">
        <div class="three-body">
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
        </div>
        <p>Cargando...</p>
    </section>
    <main id="mainFormContraentrega">
        <section class="columnFormContraentrega">
            <h1 id="animated-text">
                No te preocupes por ir a la farmacia, nosotros te llevamos tus medicamentos a casa.
            </h1>

            <img src="../assets/svg/deliveryContraentrega.svg" alt="" />
        </section>
        <main class="mainPrincipal">
            <button id="changeContent">


                <div>
                    <p id="payContinue">Seguir comprando <i class='bx bx-basket' style="font-size: 1.2em"></i></p>
                    <p id="cantidadFinal">6</p>
                    <i class='bx bx-cart' id="viewCartIcon"></i>
                </div>


            </button>

            <div class="contCarrito desactiveForm" style="width: 100%">
                <h3>Resumen de compra</h3>

                <form method="POST" id="form-eliminar">
                    <p>Monto final a pagar <b id="subtotal"></b></p>

                    <div id="tabla-contenedor">
                        <div class="itemCarrito">
                            <?php
                       

                            // // Verificar si hay productos en el carrito
                            // if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                            //     // Iterar sobre los productos del carrito y mostrarlos
                            //     foreach ($_SESSION['carrito'] as $producto) {
                            //         // Mostrar los detalles del producto
                            //         echo "Producto: " . $producto['nombre'] . ", Precio: " . $producto['precio'] . ", Cantidad: " . $producto['cantidad'] . "<br>";
                            //     }
                            // } else {
                            //     echo "El carrito está vacío.";
                            // }

                            ?>
                            <?php
                            if (empty($itemsCarritoConMedicamentos)) {
                                foreach ($itemsCarritoConMedicamentos as $item) : ?>
                                    <div class="item-carrito">
                                        <p><?php echo $item['idcarrito']; ?></p>

                                        <img src="<?php echo $item['imagenprincipal'] ?>" alt="">
                                        <div class="contenido">
                                            <p><?php echo $item['nombre']; ?></p>
                                            <p><?php echo $item['codigo']; ?></p>
                                            <span class="costo"> <?php echo $item['precio']; ?></span>
                                        </div>
                                        <div class="cantidad">

                                            <p></p>
                                            <p>Nombre Medicamento: <?php echo $item['cantidadcarrito']; ?></p>

                                            <span class="costo subtotal">$8.000</span>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } else {
                                echo "No hay elementos en el carrito.";
                            }
                            ?>


                        </div>



                    </div>
                </form>
            </div>

            <form class="formulario_contraentrega activeForm" autocomplete="off" id="contraentregaForm" onsubmit="sendForm(event,'contraentregaForm','../controllers/contraEntregaControlleradd.php')">
                <img src="../assets/img/LogoFarmadsoLargo.png" alt="" class="logoFarmadso">

                <article class="groupTwo">
                    <div class="inputCont">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="errorForm">
                        <span> <i style="color: #2d57a8" class='bx bx-user'></i></span>
                    </div>

                    <div class="inputCont">
                        <label for="apellido">Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="warningForm">
                        <span> <i style="color: #2d57a8" class='bx bx-user'></i></span>
                    </div>
                </article>

                <article class="groupTwo">
                    <div class="inputCont">
                        <label for="direccion">Dirección completa</label>
                        <input type="text" name="direccion" id="direccion">
                        <span> <i style="color: #2d57a8" class='bx bxs-map-pin'></i>
                        </span>
                    </div>


                </article>

                <article class="groupTwo">
                    <div class="inputCont">
                        <label for="telefono">Número de Teléfono</label>
                        <input type="tel" name="telefono" id="telefono">
                        <span> <i style="color: #2d57a8" class='bx bx-phone'></i></span>
                    </div>

                    <div class="inputCont">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo">
                        <span> <i style="color: #2d57a8" class='bx bx-envelope'></i></span>
                    </div>
                </article>

                <div class="inputCont">
                    <label for="instrucciones">Instrucciones de envio</label>
                    <textarea name="instrucciones" id="instrucciones" rows="3"></textarea>
                </div>

                <div class="groupOne">
                    <button name='realizarcompra' class="saveContraentrega"></button>
                </div>
            </form>
        </main>


    </main>
    <script src="../assets/js/contraEntrega.js"></script>
    <!-- <script>
        // Verifica si el ancho de la ventana es menor que un cierto valor (ajusta el valor según tus necesidades)
        if (window.innerWidth <= 768) {
            // Obtén la altura de la ventana gráfica en vh
            const windowHeightVh = window.innerHeight;

            // Selecciona el elemento por su id
            const bodyContraentrega = document.getElementById("bodyContraentrega");

            // Establece la altura del elemento en px
            bodyContraentrega.style.height = windowHeightVh + "px";
        }
    </script> -->

</body>

</html>