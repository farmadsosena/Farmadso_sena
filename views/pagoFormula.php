<?php
session_start();
include("../config/Conexion.php");

$idFormula = $_SESSION["clave"];

echo $idFormula;
$sql = "SELECT * FROM medicamentosformulas WHERE IdFormula = '$idFormula'";
$result = $conexion->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/pagoFomula.css">
    <script src="https://kit.fontawesome.com/6262aa5408.js" crossorigin="anonymous"></script>
    <title>Pago de Fórmula</title>
</head>

<body>

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
                <a href="">Tienda Virtual</a>
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
                        <button>SHOP <i class="fa-brands fa-cc-amazon-pay"></i></button>
                        <button>
                            <span>
                                <i class="fa-brands fa-paypal"></i>
                            </span>
                            <span>Pay</span><span>Pal</span>

                        </button>
                        <button><i class="fa-brands fa-google-pay"></i></button>
                    </article>
                </section>

                <section>
                    <div></div>
                    <p>O</p>
                    <div></div>
                </section>
            </article>

            <article class="menu-dos">
                <section>
                    <h1>Información de Contacto</h1>
                    <div>
                        <h1>¿Ya tienes una cuenta?</h1>
                        <a href="">Iniciar Sesión</a>
                    </div>
                </section>

                <form action="">
                    <section>
                        <input type="text" placeholder="Correo Electrónico">
                        <div>
                            <input type="checkbox" name="" id="">
                            <p>Enviarme novedades y ofertas por Correo Electrónico</p>
                        </div>
                    </section>


                    <section>
                        <header>
                            <h1>Dirección de Envío</h1>
                        </header>

                        <article>
                            <h1>Pais o Región</h1>
                            <select name="" id="" aria-placeholder="">
                                <option value="">Colombia</option>
                                <option value="">Perú</option>
                            </select>
                        </article>

                        <div>
                            <input type="text" placeholder="Nombres">
                            <input type="text" placeholder="Apellidos">
                        </div>
                        <input type="text" placeholder="Dirección de la Casa">
                    </section>
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
                        $datosMedicamento = mysqli_query($conexion, "SELECT * FROM medicamentos WHERE nombre='$nombreMedicamento'");
                        $cos = mysqli_fetch_assoc($datosMedicamento);

                        if (mysqli_num_rows($datosMedicamento) > 0) {
                            echo ' <article>
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
                                echo '<div>
                                     <p>$' . $cos["precio"] . '</p>
                                </div>';
                            }
                            echo "</article>";
                        }else{
                            echo ' <article>
                            <div>
                                <img src="../uploads/imgProductos/6536f99cb0c10_banner-formulas.png" alt="">
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
                                echo '<div>
                                     <p>$' . $cos["precio"] . '</p>
                                </div>';
                            }
                            echo "</article>";
                        }
                    }
                }
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
                    <h1>135.000 $</h1>
                    <h3>Calculado en el siguiente paso</h3>
                </span>
            </article>

            <article class="total">
                <div>
                    <h3>Total</h3>
                    <p>Incluye 23,52 $ de impuestos</p>
                </div>
                <div>
                    <p>COP</p>
                    <h1>135.000 $</h1>
                </div>
            </article>
        </section>
    </main>

</body>

</html>