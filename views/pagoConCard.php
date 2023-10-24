<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pagoConCard.css">
    <link rel="stylesheet" href="../assets/css/animacionCarga.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <title>Paypal</title>
</head>

<body id="bodyPagoContraentrega">

    <section id="modalCargar">
        <div class="three-body">
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
            <div class="three-body__dot"></div>
        </div>
        <p>Cargando...</p>
    </section>
    <?php

    require_once 'pay.php';
    ?>



    <div class="contCarrito">
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
    <script>
        function adjustHeight() {
            if (window.innerWidth <= 768) {
                // Obtén la altura de la ventana gráfica en vh
                const windowHeightVh = window.innerHeight;

                // Selecciona el elemento por su id
                const bodyContraentrega = document.getElementById("bodyPagoContraentrega");

                // Establece la altura del elemento en px
                bodyContraentrega.style.height = windowHeightVh + "px";
            }
        }

        // Llama a la función para ajustar la altura al cargar la página
        adjustHeight();

        // Agrega oyentes de eventos para 'resize' y 'orientationchange'
        // window.addEventListener('resize', adjustHeight);
        window.addEventListener('orientationchange', adjustHeight);

    </script>
    <script src="../assets/js/paymentProcess.js"></script>
    <script src="../assets/js/checkAmount.js"></script>
</body>

</html>