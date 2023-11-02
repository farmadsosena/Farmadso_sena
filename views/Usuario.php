<?php
session_start();
include "../config/Conexion.php";

if (!isset($_SESSION["usu"])) {
  echo "<script> window.location='login.php'</script>";
}

$id = $_SESSION["id"];
$eps = $_SESSION["eps"];


$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE idusuario = '$id'");
$rr = mysqli_fetch_assoc($consulta);


$id_usuario = $_SESSION['id'];
$con1 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id_usuario'");
$user = mysqli_fetch_assoc($con1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/logoFarmadso.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/usuario.css">
  <link rel="stylesheet" href="../assets/css/enlances_formulario_Usu.css">
  <link rel="stylesheet" href="../assets/css/register_Usu.css">
  <link rel="stylesheet" href="../assets/css/registros_domi_y_farmacia.css">
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

      <div class="logo-container">
        <div class="logo">
          <img src="../assets/img/logoFarmadso - cambio.png" alt="">
          <p>Farmadso</p>
        </div>
      </div>
      </section>

      <section class="naver">
        <article class="hoss">
          <?php
          if ($eps == 1) {
          ?>
            <div class="toggle-dic" id="DAS" onclick="mostrarContenedoresMenu('dos', this)">
              <div>
                <i class='bx bx-shopping-bag'></i>
                Mis compras
              </div>
            </div>
            <a href="inicio_tienda.php" class="toggle-dic">
              <div>
                <i class='bx bx-store'></i>
                Tienda virtual
              </div>
            </a>
            <div class="toggle-dic" id="cuarta" onclick="mostrarContenedoresMenu('cuatro', this)">
              <div>
                <i class='bx bx-user-circle'></i>
                Solicitar un nuevo rol
              </div>
            </div>
          <?php
          } else {
          ?>
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

            <a href="inicio_tienda.php" class="toggle-dic">
              <div>
                <i class='bx bx-store'></i>
                Tienda virtual
              </div>
            </a>

            <div class="toggle-dic" id="cuarta" onclick="mostrarContenedoresMenu('cuatro', this)">
              <div>
                <i class='bx bx-user-circle'></i>
                Solicitar un nuevo rol
              </div>
            </div>
          <?php
          }
          ?>

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
            <a href="configuracion.php"><i class='bx bx-cog'></i></a>

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

                ?>
              </div>
            </div>

            <section class="cont-usu" id="cuenta-fasd">
              <img src="<?php echo $rr["imgUser"] ?>" alt="">
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
              
                  <?php 
                  
                    $consulta = mysqli_query($conexion, "SELECT * FROM formulas  where estado = 1 ");
                   
                    if($consulta){
                      $card = mysqli_fetch_assoc($consulta);
                      
                      $fecha = $card['fechaOrden'];
                      $fecha_timestamp = strtotime($fecha);
                      
                      if ($fecha_timestamp !== false) {
                          $fecha_formateada = date(" j F Y", $fecha_timestamp);               
                      }


                      // $doc = mysqli_query($conexion, "");
                      echo"<div class='card' data-id='{$card['idFormula']}'>
                      <div class='firts_line'>
                        <div class='date-card'>
                          <p>$fecha_formateada</p>
                        </div>
    
                        <div class='state-card'>
                          Entregado
                        </div>
                      </div>
    
                      <div class='second-line'>
                        <h3 class='title_card'> Formulación de software para el catéter de rodilla maxilar </h3>
                        <div class='doc'>
                          <p class='profesion'>Profesional de la salud</p>
                          <p class='name_doc'>Diego Hoyos Linares</p>
                        </div>
                        <div class='eps'></div>
                        <div class='opt-card'></div>
                      </div>
    
                      <div class='third-line'>Descargar
                        <img class='open_menu' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=' />
                      </div>
                      <div class='menu_card'>
                        <ul>
                          <li>Abrir</li>
                          <li class='delete'>Eliminar</li>
                        </ul>
                      </div>
                    </div>";

                    }
                  
                  ?>


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
                    <img class="open_menu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />
                  </div>
                  <div class="menu_card">
                    <ul>
                      <li>Abrir</li>
                      <li class="delete">Eliminar</li>
                    </ul>
                  </div>
                </div>
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
                    <img class="open_menu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />
                  </div>
                  <div class="menu_card">
                    <ul>
                      <li>Abrir</li>
                      <li class="delete">Eliminar</li>
                    </ul>
                  </div>
                </div>
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
                    <img class="open_menu" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />
                  </div>
                  <div class="menu_card">
                    <ul>
                      <li>Abrir</li>
                      <li class="delete">Eliminar</li>
                    </ul>
                  </div>
                </div>
                <!-- Final de tarjetas -->

               
             
            </div>
          </article>
        </section>

        <section class="paginas" id="dos">
          ejem 2
        </section>

        <section class="paginas" id="tres">
          <div class="icon"><i class='bx bx-left-arrow-alt'></i></div>
          <div class="bt-form"><button>
              <i class='bx bxs-leaf'></i>
              <h1>Formulas</h1>
            </button></div>

          <div class="cont-p">
            <article class="sect-p">
              <?php 
              require_once '../templates/papelera.php';
              ?> 
              </article> 
          </div>
        </section>
           <section class="paginas" id="cuatro">

          <div class="column" id="opciones">
            <div class="option2" onclick="mostrarContenido('domiciliario')">Quiero ser domiciliario del sistema
              <div class="arrow-icon">
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
            <div class="option2" onclick="mostrarContenido('farmacia')">Quiero registrar mi farmacia en el sistema
              <div class="arrow-icon">
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </div>
          <div id="contenido-domiciliario" class="hidden">
            <div class="container">
              <div class="flecha_titulo" onclick="volverAopciones('domiciliario')">
                <i class='bx bx-left-arrow-alt'></i>
                <h1>Solicitud para ser domiciliario</h1>
              </div>
              <section class="parte1-formulario">
            
<form action="./controllers/procesar_registro_domiciliario.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="user" value='<?php echo $id_usuario ?>'>
<section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="nombreCompleto">Nombre Completo</label>
                  <input type="text" id="nombrecompleto" name="nombrecompleto" required>
                </div>

      <div class="contenedoresparte1">
        <label for="numeroDocumento">Numero de documento</label>
        <input type="text" id="numerodocumento" name="numerodocumento" required>
      </div>

      <div class="contenedoresparte1">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" required>
      </div>
    </section>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="correo">Correo de Contacto</label>
        <input type="email" id="correo" name="correo" required>
      </div>

      <div class="contenedoresparte1">
        <label for="imagen"> Imagen de Presentación</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>

    </section>

              <h2>Datos Sensibles</h2>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="Direcciónresidencia">Dirección de residencia</label>
        <input type="text" id="nombrecompleto" name="nombrecompleto" required>
      </div>

      <div class="contenedoresparte1">
        <label for="Tipo_vehiculo">Tipo de Vehiculo</label>
        <select id="vehiculo" name="departamento" required>
          <option value="moto">Moto</option>
          <option value="carro">Carro</option>
          <!-- Agrega más departamentos según sea necesario -->
        </select>
      </div>

    </section>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="imagen">Licencia de conducir</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>

      <div class="contenedoresparte1">
        <label for="imagen">Tarjeta de propiedad</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>

      <div class="contenedoresparte1">
        <label for="imagen">Soat</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>
    </section>

    <label for="cuenta_bancaria">Tipo de cuenta bancaria</label>
    <select id="cuenta_bancaria" name="cuenta_bancaria" required>
      <option>Escoge la opcion</option>
      <option value="nequi">Nequi</option>
      <option value="paypal">PayPal</option>
      <option value="bancolombia">Bancolombia</option>
    </select>

    <section class="respuesta_select" id="respuesta_select">

      <div id="nequi_info" class="info-container hidden">

                  <h3>Datos Sensible para Nequi</h3>

        <section class="parte1-formulario">
        <div class="contenedoresparte1">
        <label for="imagen"> Imagen de Presentación</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>

        </section>
      </div>

      <div id="paypal_info" class="info-container hidden">

                  <h3>Datos Sensible para PayPal</h3>

                  <div class="contenedoresparte1">
        <label for="imagen"> Imagen de Presentación</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>
      </div>

      <div id="bancolombia_info" class="info-container hidden">

                  <h3>Datos Sensible para Bancolombia<h3>

            <section class="parte2-formulario">

            <div class="contenedoresparte1">
        <label for="imagen"> Imagen de Presentación</label>
        <input type="file" id="imagen" name="imagen" required>
      </div>
            </section>

      </div>

    </section>

    <button id="enviar" name="enviar">Enviar</button>
  </div>
  </form>
</div>

          <div id="contenido-farmacia" class="hidden">
            <div class="container">
              <div class="flecha_titulo" onclick="volverAopciones('farmacia')">
                <i class='bx bx-left-arrow-alt'></i>
                <h1>Solicitud para registrar farmacia</h1>
              </div>
              
   
<form action="../controllers/procesar_registro_farmacia.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="idusuario" value='<?php echo $id_usuario ?>'>
    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="nombreFarmacia">Nombre de la Farmacia</label>
        <input type="text" id="Nombre" name="Nombre" required>
      </div>

      <div class="contenedoresparte1">
        <label for="direccion">Dirección</label>
        <input type="text" id="Direccion" name="Direccion" required>
      </div>

      <div class="contenedoresparte1">
        <label for="telefono">Teléfono</label>
        <input type="tel" id="telefono" name="telefono" required>
      </div>
    </section>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="correo">Correo de Contacto</label>
        <input type="email" id="correo" name="correo" required>
      </div>
      <div class="contenedoresparte1">
        <label for="imagen"> Imagen de Presentación</label>
        <input type="file" id="imagefarmacia" name="imagen" required>
      </div>
    </section>

              <h2>Datos Sensibles</h2>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="departamento">Departamento</label>
        <select id="Departamento" name="Departamento" required>
          <option value="departamento1">Caquetá</option>
          <option value="departamento2">Cundinamarca</option>
          <!-- Agrega más departamentos según sea necesario -->
        </select>
      </div>

      <div class="contenedoresparte1">
        <label for="ciudad">Ciudad</label>
        <select id="ciudad" name="ciudad" required>
          <option value="departamento1">Florencia</option>
          <option value="departamento2">Bogota</option>
          <!-- Agrega más ciudades según sea necesario -->
        </select>
      </div>
    </section>

    <section class="parte1-formulario">
      <div class="contenedoresparte1">
        <label for="codigoPostal">Código Postal</label>
        <input type="text" id="codigoPostal" name="codigoPostal" required>
      </div>

      <div class="contenedoresparte1">
        <label for="horario">Días de Horario Laboral</label>
            <select id="horario" name="horario" required>
          <option value="lunes">Lunes</option>
          <option value="martes">Martes</option>
          <!-- Agrega más días según sea necesario -->
        </select>
      </div>
    </section>
    <label for="epsRegistrado">¿Está registrado con una EPS?</label>
        <select id="epsRegistrado" name="epsRegistrado" required onchange="mostrarOcultarEPS()">
            <option>Escoge la opción</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>

        <label for="eps" style="display: none;">EPS con la que está registrado</label>
        <select id="idEps" name="idEps" style="display: none;" >
            <option value="1">No tengo una EPS</option>
            <option value="2">COOMEVA ENTIDAD PROMOTORA DE SALUD S.A. "COOMEVA E.P.S. S.A.</option>
            <option value="3">ASMET SALUD EPS S.A.S.</option>
            <option value="4">ASMET SALUD EPS S.A.S.</option>
            <option value="5">ENTIDAD PROMOTORA DE SALUD SANITAS S.A.S.</option>
        </select>

        <label for="nitEps">NIT de EPS</label>
        <input type="text" id="nitEPS" name="nitEPS" style="display: none;" >

<button type="submit" id="enviar" name="enviar">Enviar</button>
  </div>
  </form>
  
</section>
</section>
</section>
      </section>
    </article>
  </main>

<?php
include "../models/funcionemail.php";
?>
  <section class="cuentas" id="datos-user">
    <section class="overflow">
    <header>
      <h2><?php echo $correo_usuario; ?></h2>
      <section class="dash-img">
        <img src="<?php echo $rr["imgUser"] ?>" alt="">
      </section>
    </header>
      <section class="darf">
        <details class="fores-u">
          <summary> Mis cuentas</summary>
          <section class="count">
            <section class="fal">
              <div>
                <img src="<?php echo $rr["imgUser"] ?>" alt="">
              </div>
            </section>
            <section class="fole">
              <h4><?php echo $rr["nombre"] . " " . $rr["apellido"];?></h4>
              <p><?php echo $correo_usuario; ?></p>
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
  <script src="../assets/js/select_cuentaUsuariobancario.js"></script>
  <script src="../assets/js/mostrar_opcionesparte4.js"></script>
  <script src="../assets/js/mostrar_ocultarEPS.js"></script>
</body>

</html>