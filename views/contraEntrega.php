<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/contraentrega.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Contraentrega</title>
</head>

<body id="bodyContraentrega">
    <main id="mainFormContraentrega">
        <section class="columnFormContraentrega">
            <h1>
                No te preocupes por ir a la farmacia, nosotros te llevamos tus medicamentos a casa
            </h1>

            <img src="../assets/svg/deliveryContraentrega.svg" alt="" />
        </section>
        <form class="formulario_contraentrega" method="post" id="formcontraentrega" onsubmit="sendForm(event,'formcontraentrega','../controllers/contraEntregaController.php')">
            <img src="../assets/img/LogoFarmadsoLargo.png" alt="" class="logoFarmadso">
        
            <article class="groupTwo">
                <div class="inputCont">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
        
                <div class="inputCont">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" required>
                </div>
            </article>
        
            <article class="groupTwo">
                <div class="inputCont">
                    <label for="direccion">Dirección de entrega</label>
                    <input type="text" name="direccion" id="direccion" required>
                </div>
        
                <div class="inputCont">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" value="Florencia" required>
                </div>
        
                <div class="inputCont" style="flex: .5;">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" name="codigo_postal" id="codigo_postal" required>
                </div>
            </article>
        
            <article class="groupTwo">
                <div class="inputCont">
                    <label for="telefono">Número de Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" required>
                </div>
        
                <div class="inputCont">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo">
                </div>
            </article>
        
            <div class="inputCont">
                <label for="instrucciones">Instrucciones Especiales</label>
                <textarea name="instrucciones" id="instrucciones" rows="3"></textarea>
            </div>
        
            <!-- Puedes seguir agregando más campos según tus necesidades -->
            <div class="groupOne">
                <button name='realizarcompra' class="saveContraentrega">Realizar compra</button>
            </div>
        </form>
        
        
    </main>
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
    <script src="../assets/js/contraEntrega.js"></script>
</body>

</html>