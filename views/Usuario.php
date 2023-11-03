<?php
session_start();
include "../config/Conexion.php";

if (!isset($_SESSION["usu"])) {
  echo "<script> window.location='login.php'</script>";
}

$id = $_SESSION["id"];
$eps = $_SESSION["eps"];
$imgUser = $_SESSION['img'];

$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE idusuario = '$id'");
$rr = mysqli_fetch_assoc($consulta);// El usuario está "iniciado sesión" manualmente, por lo que se le permite el acceso a esta parte de la aplicación.
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
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
              <img src="<?php echo $imgUser ?>" alt="">
            </section>

          </section>
        </section>
      </header>

      <section class="cuerpores">
        <section class="paginas" id="uno">
          <article class="formulas">
            <section class="new-formula" id="abrirNewVentana">
              <button><i class='bx bx-plus-medical'></i>Agregar nueva formula</button>
            </section>
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
                  
                    $consulta = mysqli_query($conexion, "SELECT * FROM formulas  where EstadoFormula = 1 ");
                   
                    if($consulta){
                      $card = mysqli_fetch_assoc($consulta);
                        $IdMedico = $card['IdMedico'];
                        $IdDiag = $card['idDiagnostico'];
                       
                      
                      $fecha = $card['fechaOrden'];
                      $fecha_timestamp = strtotime($fecha);
                      
                      if ($fecha_timestamp !== false) {
                          $fecha_formateada = date(" j F Y", $fecha_timestamp);               
                      }

                      // consulta medico
                      $doc = mysqli_query($conexion, "SELECT * from medicos where  idmedico = $IdMedico ");
                      $user_doc = mysqli_fetch_assoc($doc);
                      $id_medico = $user_doc['idusuario'];
                      $cons_med =  mysqli_query($conexion, "SELECT * from usuarios where  idusuario = $id_medico ");
                      $row = mysqli_fetch_assoc($cons_med);
                      

                      // consulta diagnostico

                      $diagnostico = mysqli_query($conexion,"SELECT * FROM diagnosticos where idDiag = $IdDiag");
                      $di = mysqli_fetch_assoc($diagnostico);
                       $name_di = $di['nombreDiag'];

                      
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
                        <h3 class='title_card'> $name_di </h3>
                        <div class='doc'>
                          <p class='profesion'>Profesional de la salud</p>
                          <p class='name_doc'>" .$row['nombre'].' '.  $row['apellido'] . "</p>
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
<div class="formula-info">
  <div class="card_info">

  </div>
</div>
              <!-- Final de tarjetas -->
            </div>
          </article>
        </section>

        <section class="paginas" id="dos">   
          
          <div class="container-miscompras">

            <table class="preview-detalle">
              <thead>
                <tr>
                <th class="fecha">Fecha</th>
                <th class="estado">Estado</th>
                <th class="email">Email</th>
                <th class="total">Total</th>
                <th class="accion">Acción</th>
                </tr>
              </thead>

              <tbody id="tabla-body">
                <!-- Aquí se agregarán las filas dinámicamente -->
                
              </tbody>

            </table>


            <script>
              // Función para cargar datos desde el servidor
              function cargarDatos() {
                // Realizar una solicitud Ajax al servidor para obtener los datos
                $.ajax({
                url: '../controllers/compras.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                  // Limpiar el cuerpo de la tabla
                  $('#tabla-body').empty();

                  // Iterar a través de los datos y construir las filas de la tabla
                  data.forEach(function (item) {
                  var row = `<tr>
                    <td class="fecha">${item.fecha}</td>
                    <td class="estado">${item.estadocompra}</td>
                    <td class="email">${item.email}</td>
                    <td class="total">${item.total}</td>            
                    <td class="accion"><button class="verdetalle" onclick="mostrarDetalleCompra(${item.idcompra})">Ver Más</button></td>
                </tr>`;
                  $('#tabla-body').append(row);
                  });
                },
                error: function (error) {
                  console.log('Error al cargar los datos: ' + error);
                }
                });
              }

              // Llamar a la función para cargar los datos al cargar la página
              $(document).ready(function () {
                cargarDatos();
              });

            </script>


            <!-- Ventana modal -->
            <div id="modalDetalle" class="modal">

              <div class="modal-content">
                <span class="close-button" onclick="cerrarModal()">&times;</span>

                <table class="preview-detalle">
                  <thead>
                    <tr>
                      <th class="fecha">Fecha</th>
                      <th class="estado">Estado de Compra</th>
                      <th class="detalle">Detalle</th>
                      <th class="cantidad">Cantidad</th>
                      <th class="total">Total</th>
                      <th class="subtotal">Subtotal</th>
                    </tr>
                  </thead>

                  <tbody id="detallecompra">
                    <!-- aqui va el contenido de detalles-->

                  </tbody>
                
                </table>
              </div>
            </div>


            <script>

              // Agrega una función para mostrar detalles de compra
              function mostrarDetalleCompra(idcompra) {
                // Realiza una solicitud Ajax al servidor para obtener los detalles de la compra con el idcompra
                $.ajax({
                  url: '../controllers/DetallesCompra.php?idcompra=' + idcompra,
                  method: 'GET',
                  dataType: 'json',
                  success: function (data) {
                    // Llena la ventana modal con los detalles de la compra
                    $('#detallecompra').empty();
                    data.forEach(function (detalle) {
                      var row = `<tr>
                        <td>${detalle.fecha}</td>
                        <td>${detalle.estadocompra}</td>
                        <td>${detalle.detallesventa}</td>
                        <td>${detalle.cantidad}</td>
                        <td>${detalle.total}</td>
                        <td>${detalle.subtotal}</td>
                      </tr>`;
                      $('#detallecompra').append(row);
                    });
                    // Abre la ventana modal
                    $('#modalDetalle').show();
                  },
                  error: function (error) {
                    console.log('Error al cargar los detalles de la compra: ' + error);
                  }
                });
              }

            </script>

          </div>
        </section>

      </div>
        
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
                      <label for="nombre_usuario">Introduce nombre de usuario </label>
                      <input type="text" id="nombre_usuario" name="nombre_usuario" required>
                    </div>

                    <div class="contenedoresparte1">
                      <label for="telefono">Ingrese numero de teléfono</label>
                      <input type="tel" id="telefono" name="telefono" required>
                    </div>

                  </section>
                </div>

                <div id="paypal_info" class="info-container hidden">

                  <h3>Datos Sensible para PayPal</h3>

                  <section class="parte1-formulario">
                    <div class="contenedoresparte1">
                      <label for="nombre_usuario">Introduce nombre de usuario </label>
                      <input type="text" id="nombre_usuario" name="nombre_usuario" required>
                    </div>

                    <div class="contenedoresparte1">
                      <label for="telefono">Teléfono</label>
                      <input type="tel" id="telefono" name="telefono" required>
                    </div>

                  </section>
                </div>

                <div id="bancolombia_info" class="info-container hidden">

                  <h3>Datos Sensible para Bancolombia<h3>

                      <section class="parte2-formulario">

                        <div class="contenedoresparte2">
                          <label for="telefono">Tipo cuenta natural o juridico</label>
                          <input type="text" id="nombrecompleto" name="nombrecompleto" required>
                        </div>

                        <div class="contenedoresparte2">
                          <label for="telefono">Cuenta de ahorro o corriente</label>
                          <input type="text" id="numerodocumento" name="numerodocumento" required>
                        </div>
                      </section>

                      <section class="parte3-formulario">
                        <div class="contenedoresparte2">
                          <label for="telefono">Numero de la tarjeta</label>
                          <input type="tel" id="telefono" name="telefono" required>
                        </div>

                        <div class="contenedoresparte2">
                          <label for="telefono">Propietario</label>
                          <input type="email" id="correo" name="correo" required>
                        </div>
                      </section>

                </div>

              </section>

              <button id="enviar">Enviar</button>
            </div>
          </div>

          <div id="contenido-farmacia" class="hidden">
            <div class="container">
              <div class="flecha_titulo" onclick="volverAopciones('farmacia')">
                <i class='bx bx-left-arrow-alt'></i>
                <h1>Solicitud para registrar farmacia</h1>
              </div>

              <section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="nombreFarmacia">Nombre de la Farmacia</label>
                  <input type="text" id="nombreFarmacia" name="nombreFarmacia" required>
                </div>

                <div class="contenedoresparte1">
                  <label for="direccion">Dirección</label>
                  <input type="text" id="direccion" name="direccion" required>
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
                  <label for="departamento">Departamento</label>
                  <select id="departamento" name="departamento" required>
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

                <div class="contenedoresparte1">
                  <label for="jornada">Jornada</label>
                  <select id="jornada" name="jornada" required>
                    <option value="manana">Mañana</option>
                    <option value="tarde">Tarde</option>
                  </select>
                </div>
              </section>

              <label for="epsRegistrado">¿Está registrado con una EPS?</label>
              <select id="epsRegistrado" name="epsRegistrado" required>
                <option value="si">Sí</option>
                <option value="no">No</option>
              </select>

              <label for="eps">EPS con la que está registrado</label>
              <select id="eps" name="eps" required>
                <option value="eps1">EPS 1</option>
                <option value="eps2">IPS 2</option>
                <!-- Agrega más EPS según sea necesario -->
              </select>

              <label for="nitEps">NIT de EPS</label>
              <input type="text" id="nitEps" name="nitEps" required>

              <button id="enviar">Enviar</button>
            </div>
          </div>
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
        <h2>
          <?php echo $correo_usuario; ?>
        </h2>
        <section class="dash-img">
          <img src="<?php echo $imgUser ?>" alt="">
        </section>
      </header>
      <section class="darf">
        <details class="fores-u">
          <summary> Mis cuentas</summary>
          <section class="count">
            <section class="fal">
              <div>
                <img src="<?php echo $rr[" imgUser"] ?>" alt="">
              </div>
            </section>
            <section class="fole">
              <h4>
                <?php echo $rr["nombre"] . " " . $rr["apellido"];?>
              </h4>
              <p>
                <?php echo $correo_usuario; ?>
              </p>
            </section>
          </section>
        </details>
        <form action="../config/cerrarSesion.php" method="post" class="from-details">
          <button><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesion en la cuenta</button>
        </form>
      </section>
    </section>
  </section>


  <section class="contenedor-form" id="VentanaPropia">
    <form class="abilisco" method="post" action="../controllers/registroFormulas.php" enctype="multipart/form-data">
      <header>
        <h2>Agregar formula a mi historial</h2>
        <div class="x-cerrar" id="X22">
          <i class='bx bx-x'></i>
        </div>
      </header>
      <section class="cuerpo-abilisco">
        <section class="scroll-abi">
          <div class="mauso">
            <p>Diagnostico</p>
            <div>Escriba en este espacio el codigo del diagnostico que aparece en su formula</div>
            <input type="text" name="" id="CodigoDiagnostico" placeholder="Numero del diagnostico" class="mauso-texto"
              autocomplete="off" value="">
            <input type="hidden" name="diagnostico" id="CodeDiag" class="mauso-texto" autocomplete="off" value="">
            <section id="resultados" class="mauso-resultados scrall">
              <!-- Aparecen dinamicamente los resultados de las busqueda del diagnostico AgregarMedicamentoVenatana.js(Linea 1 - 37)-->
            </section>
          </div>
          <div class="mauso">
            <p>Causa externa</p>
            <textarea name="causa" id="" cols="30" rows="10" class="mauso-texto rezine-none"
              placeholder="Causa de la cita medica"></textarea>
          </div>
          <section class="flex-mauso">
            <section class="mauso-boom">
              <div class="mauso">
                <p>Medico responsable</p>
                <input type="text" name="" id="MedicoResponsable" placeholder="Numero de tarjeta profesional"
                  class="mauso-texto">
                <input type="hidden" name="medico" id="MedicoFinal" class="mauso-texto" autocomplete="off" value="">
                <section id="medicosResult" class="mauso-resultados scrall">
                  <!-- Aparecen dinamicamente los resultados de las busqueda del diagnostico AgregarMedicamentoVenatana.js(Linea 41 - 76) -->
                </section>
              </div>
            </section>
            <section class="mauso-boom">
              <div class="mauso">
                <p>Foto de la formula</p>
                <input type="file" name="Fotoformula" id="" placeholder="Numero del diagnostico"
                  class="mauso-texto encojer" accept=".png, .jpg,">
              </div>
            </section>
          </section>
          <div class="mauso">
            <p>Cantidad de medicamentos recetados</p>
            <input type="text" name="cantidadMedicamentos" id="cantidadMedicamentos"
              placeholder="El numero total de los medicamentos que vienen en su formula" class="mauso-texto menor">
          </div>
        </section>
        <section class="padre-medicamentos">
          <!-- Contenedor donde llegan el resto del fomulario (AgregarMedicamentoVentana.js) -->
        </section>
        <section class="botones-abi">
          <button class="regresar" id="volverAlPrincipio" type="button">Volver a los datos basicos</button>
          <button class="continuar" id="cambiarMedicamento" type="button">Continuar con el formulario</button>
          <button class="continuar asss" id="EnviarPorComplero">Enviar formula</button>
        </section>
      </section>


    </form>
  </section>

  <script src="../assets/js/CambiarMenu.js"></script>
  <script src="../assets/js/usuarioJS.js"></script>
  <script src="../assets/js/filtros_formulas.js"></script>
  <script src="../assets/js/eliminar.js"></script>
  <script src="../assets/js/menu_card.js"></script>
  <script src="../assets/js/funcionusuario.js"></script>
  <script src="../assets/js/select_cuentaUsuariobancario.js"></script>
  <script src="../assets/js/mostrar_opcionesparte4.js"></script>
  <script src="../assets/js/AgregarMedicamentoVentana.js"></script>
  <script src="../assets/js/modalCompras.js"></script>
</body>

</html>