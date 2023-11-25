<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pagoConCard.css">
    <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
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
            <p>Monto final a pagar <b id="subtotal"></b></p>

            <div id="tabla-contenedor">

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
    <script src="../assets/js/checkAmount.js"></script>
    <script src="../assets/js/consultarCart.js"></script>
</body>

</html>