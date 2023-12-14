<?php
session_start();
include "../config/Conexion.php";

if (!isset($_SESSION["id"])) {
  echo "<script> window.location='login.php'</script>";
}

$id = $_SESSION["id"];

$eps = $_SESSION["eps"];
$imgUser = $_SESSION['img'];

$consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = '$id'");
$rr = mysqli_fetch_assoc($consulta); // El usuario está "iniciado sesión" manualmente, por lo que se le permite el acceso a esta parte de la aplicación.
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
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans&family=Pacifico&family=Poppins:wght@200;500;600&family=Roboto:wght@500&display=swap" rel="stylesheet">
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
            <a href="#" class="toggle-dic" onclick="confirmRedirect()">
              <div>
                <i class='bx bx-store'></i>
                Tienda virtual
              </div>
              <i class='bx bx-right-top-arrow-circle' style="color: #444746"></i>
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

            <!-- <div class="toggle-dic" id="trash" onclick="mostrarContenedoresMenu('tres', this)">
              <div>
                <i class='bx bx-trash-alt'></i>
                Papelera
              </div>
            </div> -->

            <a href="#" class="toggle-dic" onclick="confirmRedirect()">
              <div>
                <i class='bx bx-store'></i>
                Tienda virtual
              </div>
              <i class='bx bx-right-top-arrow-circle' style="color: #444746"></i>
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
                function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
                {
                  global $conexion;
                  $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
                  $stmt = $conexion->prepare($consulta);
                  $stmt->bind_param("ss", $usuario, $valorEstado);
                  $stmt->execute();
                  $resultado = $stmt->get_result();
                  return $resultado->num_rows > 0;
                }

                if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 2)) {
                  echo '<div class="option">
                  <i class="bx bx-car"></i> Domiciliario
                </div>';

                  $_SESSION["domi"] = $id;
                }
                if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
                  echo '<div class="option">
                  <i class="bx bxs-business"></i> Farmaceutico
                </div>';
                  $con = mysqli_query($conexion, "SELECT * FROM farmacias WHERE idusuario = '$id'");
                  if ($con) {
                    $fila_farm = mysqli_fetch_assoc($con);
                    $_SESSION["farm"] = $fila_farm["IdFarmacia"];
                  }
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
      <?php
      if (!$eps == 1) {
      ?>
        <section class="paginas" id="uno">
          <article class="formulas">
            <section class="new-formula">
              
              <button id="abrirNewVentana"><i class='bx bx-plus-medical'></i>Agregar nueva formula</button>
            </section>
            <div class="opt_config">
              <div class="search">
                <input type="search" placeholder="Buscar Formula..." id="cassos" />
                <i class='bx bx-filter'></i>
              </div>
              <div class="filtros">
                <div class="doctor config_filtros" data-tipo-filtro="IdMedico">
                  <div class="filtros-titulo">Doctor</div>
                  <i class='bx bx-chevron-right'></i>
                  <section class="ventana-sal scrall rrrf">
                    <?php
                    $medicos = mysqli_query($conexion, "SELECT * FROM formulas 
                INNER JOIN medicos ON formulas.IdMedico = medicos.idmedico
                WHERE idPaciente = '$id' and Estado='1'");

                    if ($medicos->num_rows > 0) {
                      $nombres_impresos = array();

                      while ($rg = mysqli_fetch_assoc($medicos)) {
                        $usuario = $rg["idusuario"];
                        $cons_med = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = $usuario");
                        $row = mysqli_fetch_assoc($cons_med);

                        $nombre_completo = $row["nombre"] . " " . $row["apellido"];

                        // Verificar si el nombre ya se ha impreso
                        if (!in_array($nombre_completo, $nombres_impresos)) {
                          echo "<div data-valor='" . $rg["idmedico"] . "'>" . $nombre_completo . "</div>";
                          // Agregar el nombre al array de nombres impresos
                          $nombres_impresos[] = $nombre_completo;
                        }
                      }
                    }
                    ?>

                  </section>

                </div>

                <div class="state config_filtros" data-tipo-filtro="estado">
                  <div class="filtros-titulo">Estado</div>
                  <i class='bx bx-chevron-right'></i>
                  <section class="ventana-sal scrall frrr">
                    <div data-valor="1">Pendiente</div>
                    <div data-valor="2">No aceptando</div>
                    <div data-valor="3">Entregado</div>
                  </section>
                </div>

                <div class="date config_filtros" data-tipo-filtro="fechaOrden">
                  <div class="filtros-titulo">Fecha</div>
                  <i class='bx bx-chevron-right'></i>
                  <section class="ventana-sal scrall frrr">
                    <input type="date" id="fecha">
                  </section>
                </div>
              </div>
            </div>

            <div class="cards_formulas" id="LLEGARFR">
              <!-- Comienzan tarjetas para formulas -->

              <!-- Final de tarjetas -->
            </div>

            <div class="formula-info">
              <!-- el archivo donde llegan todos estos datos es controllers/FOmrulasViews.php -->
            </div>
            <div id="mensajeNoResultados" class="imgBusqueda">
              <img src="../assets/img/notas.png" alt="">
              No se encontraron resultados parecidos
            </div>
          </article>

        </section>
      <?php
      }
      ?>

      <section class="paginas" id="dos">

        <div class="container-miscompras">

          <table class="preview-detalle tablauno">
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
            function cargarDatos() {
              $.ajax({
                url: '../controllers/compras.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                  $('#tabla-body').empty();

                  if (data.length === 1 && data[0].mensaje === 'Sin compras en el sistema') {
                    $('#tabla-body').html('<tr><td colspan="5">No tienes compras realizadas</td></tr>');
                  } else {
                    data.forEach(function(item) {
                      var fecha = new Date(item.fecha);
                      var opcionesFecha = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                      };
                      var fechaFormateada = fecha.toLocaleDateString('es-ES', opcionesFecha);

                      var totalFormateado = new Intl.NumberFormat('es-ES').format(item.total);

                      var row = `<tr>
                                    <td class="fecha">${fechaFormateada}</td>
                                    <td class="estado">${item.estado}</td>
                                    <td class="email">${item.correo_usuario}</td>
                                    <td class="total">${totalFormateado}</td> 
                                    <td class="accion"><button class="verdetalle" onclick="mostrarDetalleCompra(${item.idcompra})">Ver Más</button></td>
                                </tr>`;
                      $('#tabla-body').append(row);
                    });
                  }
                },
                error: function(xhr, status, error) {
                  console.log('Error al cargar los datos:');
                  console.log(xhr.responseText);
                  console.log(status);
                  console.log(error);
                }
              });
            }

            $(document).ready(function() {
              cargarDatos();
            });
          </script>


          <!-- Ventana modal -->
          <div id="modalDetalle" class="modal">
            <span class="close-button btnnmovil" onclick="cerrarModal()">&times;</span>

            <div class="modal-content">
              <span class="close-button pc" onclick="cerrarModal()">&times;</span>

              <table class="preview-detalle">
                <thead>
                  <tr>
                    <th class="estado">Medicamento</th>
                    <th class="cantidad">Cantidad</th>
                    <th class="total">Total</th>
                  </tr>
                </thead>

                <tbody id="detallecompra">
                  <!-- aqui va el contenido de detalles-->

                </tbody>

              </table>
            </div>
          </div>


          <script>
            function mostrarDetalleCompra(idcompra) {
              $.ajax({
                url: '../controllers/DetallesCompra.php?idcompra=' + idcompra,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                  $('#detallecompra').empty();

                  if (data.length === 1 && data[0].mensaje === 'No se encontraron detalles de compra para el ID proporcionado.') {
                    $('#detallecompra').html('<tr><td colspan="3">Esta compra no tiene detalles</td></tr>');
                  } else {
                    data.forEach(function(detalle) {
                      var row = `<tr>
                                    <td>${detalle.nombre_medicamento}</td>
                                    <td>${detalle.cantidad}</td>    
                                    <td>${detalle.preciototal}</td>              
                                </tr>`;
                      $('#detallecompra').append(row);
                    });
                  }

                  $('#modalDetalle').show();
                },
                error: function(error) {
                  console.log('Error al cargar los detalles de la compra: ' + error);
                }
              });
            }
          </script>

        </div>
      </section>

      <!-- <section class="paginas" id="tres">
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
      </section> -->

      <section class="paginas" id="cuatro">
        <div class="column" id="opciones">
          <?php
          if (!isset($_SESSION["domi"])) {
            echo '
            <div class="option2" onclick=mostrarContenido("domiciliario")>Quiero ser domiciliario del sistema
             <div class="arrow-icon">
               <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
            ';
          }

          if (!isset($_SESSION["farm"])) {
            echo '<div class="option2" onclick=mostrarContenido("farmacia")>Quiero registrar mi farmacia en el sistema
            <div class="arrow-icon">
              <i class="fa-solid fa-arrow-right"></i>
            </div>
          </div>';
          } else if (isset($_SESSION["farm"]) and isset($_SESSION["domi"])) {
            echo "Ya tiene todos los roles disponibles en el sistema";
          }
          ?>
        </div>
        <div id="contenido-domiciliario" class="hidden">
          <div class="container">
            <div class="flecha_titulo" onclick="volverAopciones('domiciliario')">
              <i class='bx bx-left-arrow-alt'></i>
              <h1>Solicitud para ser domiciliario</h1>
            </div>
            <section class="parte1-formulario">
              <form action="../controllers/procesar_registro_domiciliario.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user" value='<?php echo $id ?>'>
                <section class="parte1-formulario">
                  <div class="contenedoresparte1">
                    <label for="nombreCompleto">Nombre Completo</label>
                    <?php echo $rr["nombre"] ?>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="numeroDocumento">Numero de documento</label>
                    <?php echo $rr['documento']; ?>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="telefono">Teléfono</label>
                    <?php echo $rr['telefono']; ?>
                  </div>
                </section>

                <section class="parte1-formulario">
                  <div class="contenedoresparte1">
                    <label for="correo">Correo de Contacto</label>
                    <?php echo $rr['correo']; ?>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="imagen">Foto Perfil</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                </section>

                <section class="parte1-formulario">
                  <div class="contenedoresparte1">
                    <label for="datetime">Fecha de Inicio</label>
                    <input type="date" id="fechainicio" name="fechainicio" required>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="disponibilidad">Disponibilidad</label>
                    <input type="text" id="disponibilidad" name="disponibilidad" required>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="imagen">Historial</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                </section>

                <h2>Datos Sensibles</h2>

                <section class="parte1-formulario">

                  <div class="contenedoresparte1">
                    <label for="Tipovehiculo">Tipo de Vehiculo</label>
                    <select id="tipovehiculo" name="tipovehiculo" required>
                      <option value="moto">Moto</option>
                      <option value="carro">Carro</option>
                    </select>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="imagen">Foto de su vehiculo</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="Direcciónresidencia">Dirección de residencia</label>
                    <input type="text" id="direccion" name="direccion" required>
                  </div>

                </section>

                <section class="parte1-formulario">

                  <div class="contenedoresparte1">
                    <label for="imagen">Tarjeta de propiedad</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="imagen">Soat</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                  <div class="contenedoresparte1">
                    <label for="imagen">Licencia de conducir</label>
                    <input type="file" id="imagen" name="imagen" required>
                  </div>

                </section>

                <label for="tipoCuenta">Tipo de cuenta:</label>
                <select name="tipoCuenta" id="tipoCuenta">
                  <option value="nequi">Nequi</option>
                  <option value="paypal">PayPal</option>
                  <option value="bancolombia">Bancolombia</option>
                </select>
                <br>

                <label for="numeroCuenta">Número de cuenta:</label>
                <input type="text" name="numeroCuenta" id="numeroCuenta">
                <br>

                <button id="enviar" name="enviar">Enviar</button>
              </form>
            </section>
          </div>
        </div>

        <!-- SECCION PARA COMENZAR EL CONTENIDO DE FARMACIA -->
        <div id="contenido-farmacia" class="hidden">
          <div class="container">
            <div class="flecha_titulo" onclick="volverAopciones('farmacia')">
              <i class='bx bx-left-arrow-alt'></i>
              <h1>Solicitud para registrar farmacia</h1>
            </div>
            <form action="../controllers/procesar_registro_farmacia.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="idusuario" value='<?php echo $id ?>'>
              <section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="nombreFarmacia">Nombre de la Farmacia</label>
                  <input type="text" id="Nombref" name="Nombref" required>
                </div>

                <div class="contenedoresparte1">
                  <label for="direccion">Dirección</label>
                  <input type="text" id="Direccionf" name="Direccionf" required>
                </div>

                <div class="contenedoresparte1">
                  <label for="telefono">Teléfono</label>
                  <input type="tel" id="telefonof" name="telefonof" required>
                </div>
              </section>

              <section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="correo">Correo de Contacto</label>
                  <input type="email" id="correof" name="correof" required>
                </div>
                <div class="contenedoresparte1">
                  <label for="imagen"> Imagen de Presentación</label>
                  <input type="file" id="imagenf" name="imagenf" required>
                </div>
              </section>

              <h2>Datos Sensibles</h2>

              <section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="departamento">Departamento</label>
                  <select id="departamentof" name="departamentof" required>
                    <option value="departamento1">Caquetá</option>
                    <option value="departamento2">Cundinamarca</option>
                    <!-- Agrega más departamentos según sea necesario -->
                  </select>
                </div>

                <div class="contenedoresparte1">
                  <label for="ciudad">Ciudad</label>
                  <select id="ciudad" name="ciudadf" required>
                    <option value="departamento1">Florencia</option>
                    <option value="departamento2">Bogota</option>
                    <!-- Agrega más ciudades según sea necesario -->
                  </select>
                </div>
              </section>

              <section class="parte1-formulario">
                <div class="contenedoresparte1">
                  <label for="codigoPostal">Código Postal</label>
                  <input type="text" id="codigoPostalf" name="codigoPostalf" required>
                </div>

                <div class="contenedoresparte1">
                  <label for="horario">Días de Horario Laboral</label>
                  <select id="horariof" name="horariof" required>
                    <option value="lunes">Lunes</option>
                    <option value="martes">Martes</option>
                    <!-- Agrega más días según sea necesario -->
                  </select>
                </div>

              </section>

              <label for="epsRegistrado">¿Está registrado con una EPS?</label>
              <select id="epsRegistradof" name="epsRegistradof" required>
                <option>Escoge la opción</option>
                <option value="si">Sí</option>
                <option value="no">No</option>
              </select>

              <label for="eps">EPS con la que está registrado</label>
              <select id="idEpsf" name="idEpsf">
                <option>Escoge la opción</option>
                <option value="2">COOMEVA ENTIDAD PROMOTORA DE SALUD S.A. "COOMEVA E.P.S. S.A.</option>
                <option value="3">ASMET SALUD EPS S.A.S.</option>
                <option value="4">NUEVA EPS S.A.</option>
                <option value="5">ENTIDAD PROMOTORA DE SALUD SANITAS S.A.S.</option>
              </select>

              <label for="nitEps" class="niteps">NIT de EPS</label>
              <input type="text" id="nitEPS" name="nitEPS">

              <button id="enviar">Enviar</button>
            </form>
          </div>
        </div>
      </section>
      <!-- Etiqueta que termina el contenedor 4 -->
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
                <img src="<?php echo $rr["imgUser"] ?>" alt="">
              </div>
            </section>
            <section class="fole">
              <h4>
                <?php echo $rr["nombre"] . " " . $rr["apellido"]; ?>
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
    <form class="abilisco" id="MedicamentosAdd" enctype="multipart/form-data">
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
            <input type="text" name="" id="CodigoDiagnostico" placeholder="Numero del diagnostico" class="mauso-texto" autocomplete="off" value="" required>
            <input type="hidden" name="diagnostico" id="CodeDiag" class="mauso-texto" autocomplete="off" value="">
            <section id="resultados" class="mauso-resultados scrall">
              <!-- Aparecen dinamicamente los resultados de las busqueda del diagnostico AgregarMedicamentoVenatana.js(Linea 1 - 37)-->
            </section>
          </div>
          <div class="mauso">
            <p>Causa externa</p>
            <textarea name="causa" id="" cols="30" rows="10" class="mauso-texto rezine-none" placeholder="Causa de la cita medica" required></textarea>
          </div>
          <section class="flex-mauso">
            <section class="mauso-boom">
              <div class="mauso">
                <p>Medico responsable</p>
                <input type="text" name="" id="MedicoResponsable" placeholder="Numero de tarjeta profesional" class="mauso-texto" required>
                <input type="hidden" name="medico" id="MedicoFinal" class="mauso-texto" autocomplete="off" value="">
                <section id="medicosResult" class="mauso-resultados scrall">
                  <!-- Aparecen dinamicamente los resultados de las busqueda del diagnostico AgregarMedicamentoVenatana.js(Linea 41 - 76) -->
                </section>
              </div>
            </section>
            <section class="mauso-boom">
              <div class="mauso">
                <p>Foto de la formula</p>
                <input type="file" name="Fotoformula" id="" placeholder="Numero del diagnostico" class="mauso-texto encojer" accept=".png, .jpg," required>
              </div>
            </section>
          </section>
          <div class="mauso">
            <p>Cantidad de medicamentos recetados</p>
            <input type="text" name="cantidadMedicamentos" id="cantidadMedicamentos" placeholder="El numero total de los medicamentos que vienen en su formula" class="mauso-texto menor" required>
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

  <!-- ANIMACIION DE CARGA GENERAL -->
  <section class="tamaño" id="CargaDiseño">
    <section class="deco">
      <div class="spinner"></div>
    </section>
    <section class="daco">
      <p>Cargando...</p>
    </section>
  </section>

  <script>
    $(document).ready(function() {
      var zindex = 10;

      // Utiliza un delegado de eventos para manejar clics en elementos futuros
      $(document).on("click", ".carde", function(e) {
        e.preventDefault();

        var isShowing = $(this).hasClass("show");

        if ($(".cards").hasClass("showing")) {
          // Si ya hay una tarjeta visible, ocúltala
          $(".card .show").removeClass("show");
          $(".cards").removeClass("showing");
        } else {
          // No hay tarjetas visibles, muestra esta tarjeta
          $(this).css({
            zIndex: zindex
          }).toggleClass("show");
          $(".cards").addClass("showing");
        }

        zindex++;
      });
    });
  </script>

  <script src="../assets/js/CambiarMenu.js"></script>
  <script src="../assets/js/usuarioJS.js"></script>
  <script src="../assets/js/filtros_formulas.js"></script>
  <script src="../assets/js/eliminar.js"></script>
  <script src="../assets/js/menu_card.js"></script>
  <script src="../assets/js/funcionusuario.js"></script>
  <script src="../assets/js/mostrar_opcionesparte4.js"></script>
  <script src="../assets/js/AgregarMedicamentoVentana.js"></script>
  <script src="../assets/js/modalCompras.js"></script>
  <script src="../assets/js/mostrar_ocultarEPS.js"></script>
</body>

</html>