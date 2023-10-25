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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
            <h1>
                No te preocupes por ir a la farmacia, nosotros te llevamos tus medicamentos a casa.
            </h1>

            <img src="../assets/svg/deliveryContraentrega.svg" alt="" />
        </section>
        <main class="mainPrincipal">
            <button id="changeContent">

                <div>
                    <p id="cantidadFinal">6</p>
                    <i class='bx bx-cart'></i>
                </div>

            </button>

            <div class="contCarrito ">
                <h3>Resumen de compra</h3>

                <form method="POST" id="form-eliminar">
                    <p>Monto final a pagar <b id="subtotal">$75.500</b></p>

                    <div id="tabla-contenedor">


                        <div id="medicamento1" class="itemCarrito">
                            <img src="../uploads/imgProductos/aspirine.png" alt="Aspirina">
                            <div class="contenido">
                                <p>Aspirina</p>
                                <p>Código #01</p>
                                <span class="costo">$12.000</span>
                            </div>
                            <div class="cantidad">

                                <p></p>
                                <p>Cantidad 2</p>
                                <span class="costo subtotal">$24.000</span>
                            </div>
                        </div>

                        <div id="medicamento2" class="itemCarrito">
                            <img src="../uploads/imgProductos/paracetamol.png" alt="Paracetamol">
                            <div class="contenido">
                                <p>Paracetamol</p>
                                <p>Código #02</p>
                                <span class="costo ">$4000</span>
                            </div>
                            <div class="cantidad">

                                <p></p>
                                <p>Cantidad 2</p>
                                <span class="costo subtotal">$8.000</span>
                            </div>
                        </div>

                        <div id="medicamento3" class="itemCarrito">
                            <img src="../uploads/imgProductos/ibuprofeno.png" alt="Ibuprofeno">
                            <div class="contenido">
                                <p>Ibuprofeno</p>
                                <p>Código #03</p>
                                <span class="costo">$6.500</span>
                            </div>
                            <div class="cantidad">

                                <p></p>
                                <p>Cantidad 1</p>
                                <span class="costo subtotal">$6.500</span>
                            </div>
                        </div>

                        <div id="medicamento4" class="itemCarrito">
                            <img src="../uploads/imgProductos/omeprazol.png" alt="Omeprazol">
                            <div class="contenido">
                                <p>Omeprazol</p>
                                <p>Código #04</p>
                                <span class="costo">$8.000</span>
                            </div>
                            <div class="cantidad">

                                <p></p>
                                <p>Cantidad 2</p>
                                <span class="costo subtotal">$16.000</span>
                            </div>
                        </div>

                        <div id="medicamento5" class="itemCarrito">
                            <img src="../uploads/imgProductos/amoxi.png" alt="Amoxicilina">
                            <div class="contenido">
                                <p>Amoxicilina</p>
                                <p>Código #05</p>
                                <span class="costo">$7.000</span>
                            </div>
                            <div class="cantidad">
                                <p></p>
                                <p>Cantidad 3</p>
                                <span class="costo subtotal">$21.000</span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <form class="formulario_contraentrega " autocomplete="off" id="contraentregaForm" onsubmit="sendForm(event,'contraentregaForm','../controllers/contraEntregaController.php')">
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

                    <div class="inputCont">
                        <label for="codigo">Código postal</label>
                        <select type="number" name="codigo" id="codigo">
                            <option value="180001">180001</option>
                            <option value="180002">180002</option>
                            <option value="180007">180007</option>
                            <option value="180008">180008</option>
                        </select>
                        <span> <i style="color: #2d57a8" class='bx bx-code-block'></i>

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
                    <button name='realizarcompra' class="saveContraentrega">Realizar compra</button>
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