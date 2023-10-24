<?php
session_start();
include "../config/Conexion.php";

if (!isset($_SESSION["usu"])) {
  echo "<script> window.location='login.php'</script>";
}

$id = $_SESSION["id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/logoFarmadso.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/usuario.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/7cbae3222d.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Pacifico&family=Poppins:wght@200;500;600&family=Roboto:wght@500&display=swap"
    rel="stylesheet">
  <title>Farmadso cuenta verificada</title>
</head>

<body>

  <section class="yuli">
    <div class="icon">
      <i class="bx bx-menu"></i>
    </div>

    <aside class="aside">
      <!-- Nuevo proceso -->
      <section class="nabber">

        <div class="logo">
          <img src="../assets/img/logoFarmadso - cambio.png" alt="">
          <p>Farmadso</p>
        </div>
      </section>

      <section class="naver">
        <article class="hoss">
          <div class="toggle-dic doss" id="Inic" onclick="mostrarContenedoresMenu('uno', this)">
            <div>
              <i class='bx bx-notepad'></i>
              Mis formulas
            </div>
          </div>

          <div class="toggle-dic" id="DAS" onclick="mostrarContenedoresMenu('dos', this)">
            <div>
              <i class='bx bx-shopping-bag'></i>
              Mis compras
            </div>
          </div>

          <div class="toggle-dic" id="trash" onclick="mostrarContenedoresMenu('tres', this)">
            <div>
              <i class='bx bx-trash-alt'></i>
              Papelera
            </div>
          </div>

          <div class="toggle-dic">
            <div>
              <i class='bx bx-user-circle'></i>
              Solicitar un nuevo rol
            </div>
          </div>
        </article>
      </section>
    </aside>
  </section>

  <main class="mader">
    <article class="menu">

      <header class="adder">

        <section class="buscador">
          <div>
            <input type="search" name="" id="" placeholder="Buscar campo">
            <i class='bx bx-search-alt-2' id=""></i>
          </div>
        </section>

        <section class="optio">
          <section class="option-true">
            <a href="configuracion.html"><i class='bx bx-cog'></i></a>

            <div class="custom-select">
              <div class="selected-option">
                <i class='bx bx-user-circle'></i> Cuenta de usuario
              </div>
              <div class="options">

                <?php
                    function existe_en_tabla($tabla, $usuario)
                    {
                      global $conexion;
                      $consulta = "SELECT * FROM $tabla WHERE idusuario = '$usuario'";
                      $resultado = $conexion->query($consulta);
                      return $resultado->num_rows > 0;
                    }
    
                    if (existe_en_tabla('domiciliario', $id)) {
                      echo '<div class="option">
                  <i class="bx bx-car"></i> Domiciliario
                </div>';
                    }
                    if (existe_en_tabla('farmacias', $id)) {
                      echo '<div class="option">
                  <i class="bx bxs-business"></i> Farmaceutico
                </div>';
                    }
                    if (existe_en_tabla('usuarios', $id)) {
                      echo '<div class="option">
                  <i class="bx bx-user-circle"></i> Cuenta de usuario
                </div>';
                    }
    
                    $conexion->close();
                    ?>
              </div>
            </div>

            <section class="cont-usu" id="cuenta-fasd">
              <img src="../assets/img/usuario.png" alt="">
            </section>

          </section>
        </section>
      </header>

      <section class="cuerpores">
        <section class="paginas" id="uno">
          <article class="formulas">
            <div class="opt_config">
              <div class="search">
                <input type="search" placeholder="Buscar Formula..." />
                <i class='bx bx-filter'></i>
              </div>
              <div class="filtros">
                <div class="doctor config_filtros">
                  Doctor
                  <i class='bx bx-chevron-right'></i>
                </div>

                <div class="state config_filtros">
                  Estado
                  <i class='bx bx-chevron-right'></i>
                </div>

                <div class="date config_filtros">
                  Fecha
                  <i class='bx bx-chevron-right'></i>
                </div>
              </div>
            </div>

            <div class="cards_formulas">
              <div class="scroll2">
                <!-- Comienzan tarjetas para formulas -->
                <div class="card" data-id="1">
                  <div class="firts_line">
                    <div class="date-card">
                      <p>05 de Noviembre de 2023</p>
                    </div>

                    <div class="state-card">
                      Entregado
                    </div>
                  </div>

                  <div class="second-line">
                    <h3 class="title_card"> Formulación de software para el catéter de rodilla maxilar </h3>
                    <div class="doc">
                      <p class="profesion">Profesional de la salud</p>
                      <p class="name_doc">Diego Hoyos Linares</p>
                    </div>
                    <div class="eps"></div>
                    <div class="opt-card"></div>
                  </div>

                  <div class="third-line">Descargar
                    <img class="open_menu"
                      src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />
                  </div>
                  <div class="menu_card">
                    <ul>
                      <li>Abrir</li>
                      <li class="delete">Eliminar</li>
                    </ul>
                  </div>
                </div>

                <!-- Final de tarjetas -->

                <!-- <section class="prepare">
                  <img src="../assets/img/No data-rafiki.png" alt="">
                    <h2>No existen formulas todavia en el sistema</h2>
                  </section> -->
              </div>
            </div>
          </article>
        </section>

        <section class="paginas" id="dos">
          ejem 2
        </section>

        <section class="paginas" id="tres">
          <div class="cont-p">
            <div class="icon"><i class='bx bx-left-arrow-alt'></i></div>
            <div class="bt-form"><button>
                <h1>Formulas</h1>
              </button></div>

            <article class="sect-p">
              <div class="rect">
                <div class="cont-cd">
                  <input id="botonAlerta" type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd">
                  <input type="checkbox" class="ui-checkbox">
                  <div>
                    <h3>Razon de la formula</h3>
                  </div>
                </div>
                <div class="cont-cd">
                  <div class="icon-cuadro"><i class='bx bxs-user-circle'></i></i></div>
                  <div>
                    <h3>Doctor</h3>
                  </div>
                </div>
                <div>
                  <h3>Fecha</h3>
                </div>
                <div><button>Estado</button></div>
              </div>
            </article>
          </div>
        </section>

      </section>
    </article>
  </main>

  <section class="cuentas" id="datos-user">
    <section class="overflow">
      <header>
        <h2>diegohlinares2004@gmail.com</h2>
        <section class="dash-img">
          <img src="../assets/img/usuario.png" alt="">
        </section>
        <button>
          Configuracion de la cuenta
        </button>
      </header>
      <section class="darf">
        <details class="fores-u">
          <summary> Mis cuentas</summary>
          <section class="count">
            <section class="fal">
              <div>
                <img src="" alt="">
              </div>
            </section>
            <section class="fole">
              <h4>DIEGO ANDRES HOYOS</h4>
              <p>diegohlinares2004@gmail.com</p>
            </section>
          </section>
          <section class="count">
            <section class="fal">
              <div>
                <img src="" alt="">
              </div>
            </section>
            <section class="fole">
              <h4>DIEGO ANDRES HOYOS</h4>
              <p>diegohlinares2004@gmail.com</p>
            </section>
          </section>
        </details>
        <form action="../config/cerrarSesion.php" method="post" class="from-details">
          <button><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesion en la cuenta</button>
        </form>
      </section>
    </section>
  </section>

  <script src="../assets/js/CambiarMenu.js"></script>
  <script src="../assets/js/usuarioJS.js"></script>
  <script src="../assets/js/filtros_formulas.js"></script>
  <script src="../assets/js/eliminar.js"></script>
  <script src="../assets/js/menu_card.js"></script>
  <script src="../assets/js/funcionusuario.js"></script>
</body>

</html>