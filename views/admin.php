<?php

session_start();
#Validacion de rol
include('../config/Conexion.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="img/Rlogo-removebg-preview.png" type="image/x-icon">
  <link rel="stylesheet" href="../assets/css/admin.css" />
  <script src="https://kit.fontawesome.com/0015840e45.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- alertas toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <title>Panel administrador</title>
</head>

<body>



  <div id="menuResponsive">
    <h2><img src="../assets/img/sena.png" alt="" class="sena"> Asignación ambiente</h2>
    <div id="iconoMenu">
      <div id="desplegarMenu" class="">
        <i class="fa-solid fa-bars"></i>
      </div>

      <div id="cerrarMenu" class="">
        <i class="fa-solid fa-x"></i>
      </div>

    </div>
  </div>


  <!-- Ventana editar perfil -->
  <!-- EL PROPIO PROGRAMACONSUEÑOINADOR -->


  <div id="modal" class="modal">
    <div class="content-form">

      <form class="formularo-edit" action="../controllers/actualizar_ints_ap.php" method="POST" enctype="multipart/form-data">
        <span class="closeProfile" onclick="ocultarUserCard()">&times;</span>
        <h1 class="card-title">Editar Perfil</h1>
        <div class="campos-data">
          <div class="label-input">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="dato" value="<?php echo $nombre_usuario; ?>">
          </div>
          <div class="label-input">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="dato" value="<?php echo $apellido; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="documento">Documento:</label>
            <input type="text" name="documento" id="documento" class="dato" value="<?php echo $documento; ?>">
          </div>
          <div class="label-input">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="dato" value="<?php echo $password_usuario; ?>">
          </div>

        </div>
        <div class="campos-data">
          <div class="label-input">
            <label for="correo">Correo:</label>

            <input type="text" name="correo" id="correo" class="dato" value="<?php echo $correo; ?>">
          </div>
          <div class="label-input"><label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="dato" value="<?php echo $telefono; ?>">
          </div>
        </div>
        <div class="imgaa">
          <label for="imagen">Imagen Actual:</label>
          <img src="imgusuario/<?php echo $imagen; ?>" alt="Imagen Actual" class="imga" ondblclick="mostrarImagenAmpliada(this)" onclick="cerrarImagen(this)">
        </div>
        <div class="imgaa">
          <label for="new-imagen" class="btn-img">Subir nueva imagen</label>
          <input type="file" name="imagen" id="new-imagen" class="filenew">
        </div>
        <button type="submit" class="btn-cargar-novedad">Actualizar</button>
      </form>
    </div>
  </div>


  <aside id="aside">
    <section class="logo">
      <img src="imgusuario/<?php echo $_SESSION['img']; ?>" alt="" />
      <span class="name_rol">

      </span>

      <article class="BtnEditarPerfil" onclick="mostrarUserCard()" title='Editar perfil'>
        <i class="fa-solid fa-pen-to-square"></i>
      </article>

      <article class='BtnCargueAsignacion' onclick='mostrarCargueAsignacion()' title='Cargar asignaciones'>
        <i class='fa-solid fa-upload'></i>
      </article>

      <button class='Btninforme' id='abrirModalInforme' title='Generar informe'>
        <i class='fa-solid fa-file-export'></i>
      </button>
    </section>


    <!-- Anuncios sena mi papa -->
    <div id="anuncios">


      <div class="swiper mySwiper">
        <div class="swiper-wrapper"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
        <div class="autoplay-progress">
          <svg viewBox="0 0 48 48">
            <circle cx="24" cy="24" r="20"></circle>
          </svg>
          <span></span>
        </div>
      </div>
      <p id="textoAnuncio"></p>
    </div>


    <nav id="contenedor-botones">
      <button class="botones pri" id="1" onclick="mostrarContenedor('Inicio',this)">
        <i class="fas fa-building pri"></i>
        <p class="pri">Gestión de Usuarios</p>
      </button>
      <button class="botones" id="2" onclick="mostrarContenedor('servicio',this)">
        <i class="fa-solid fa-play"></i>
        <p class="pri">Servicio al cliente</p>
      </button>

      <button class='botones' id='3' onclick="mostrarContenedor('medicamentos',this)">
        <i class='fas fa-clipboard-list'></i>
        <p class="pri">Acceso de Medicamentos</p>
      </button>

      <button class='botones' id='6' onclick='mostrarContenedor("Graficas",this)'>
        <i class='fas fa-clipboard-list'></i>
        <p>Graficas del software</p>
      </button>

      <button class="botones" id="8" onclick="cerrarSesion()">
        <i class="fas fa-sign-out-alt"></i>
        <p>Cerrar sesión</p>
      </button>
    </nav>
  </aside>

  <main id="main">
    <section class="pages" id="Inicio">
      <h1>Inicio</h1>
    </section>

    <section class="pages" id="servicio">

      <aticle class="miniheader">
        <header>
          <article>
            <h1>Nofiticaciones de Medicamentos agotados</h1>
          </article>
          <article>
            <div>
              <i class="fa-solid fa-check"></i>
              <p>Todos(12)</p>
            </div>

            <div>
              <i class="fa-solid fa-xmark"></i>
              <p>Pendientes (12)</p>
            </div>

            <div>
              <i class="fa-solid fa-stamp"></i>
              <p>Spam (12)</p>
            </div>
           
            
          </article>
        </header>
  
        <section>
          <button>Acción por lote</button>
          <button>Aplicar</button>
        </section>
      </aticle>
      
      <main class="menuservicios">
        <article>  <!--Container-->
          <section></section>

          <section>
            <p>Autor</p>
          </section>

          <section>
            <p>Comentarios</p>
          </section>
          
          <section>
            <p>Enviado el</p>
          </section>
        </article>

        <section> <!--Contenedor de servicios al cliente-->
          <article>
            <section></section>
            <section>
              <div>
                <img src="" alt="">
                <article>
                  <h4>Alexander Caicedo</h4>
                  <p>3144645485</p>
                </article>
              </div>
              <h4>alexandercaicedo@gmail.com</h4>
            </section>

            <section>
              <h4>Aqui si no se</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore sapiente, 
                tenetur vel aliquam qui nisi ipsam beatae sunt suscipit quae quos similique 
                adipisci recusandae ratione nesciunt impedit quia voluptate ea.</p>
            </section>

            <section>
              <p>24/11/2023</p>
              <p>A las 6:OOAM</p>
            </section>
          </article>


          <article>
            <section></section>
            <section>
              <div>
                <img src="" alt="">
                <article>
                  <h4>Alexander Caicedo</h4>
                  <p>3144645485</p>
                </article>
              </div>
              <h4>alexandercaicedo@gmail.com</h4>
            </section>

            <section>
              <h4>Aqui si no se</h4>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore sapiente, 
                tenetur vel aliquam qui nisi ipsam beatae sunt suscipit quae quos similique 
                adipisci recusandae ratione nesciunt impedit quia voluptate ea.</p>
            </section>

            <section>
              <p>24/11/2023</p>
              <p>A las 6:OOAM</p>
            </section>
          </article>
        </section>
      </main>
      
    <div class="titulo-notificaciones">
      <h2>Notificaciones de medicamentos agotados</h2>
    </div>

    <div class="filtro-notificaciones">
      <a href="">Todos (0)</a>
      <a href="">Pendientes (3)</a>
      <a href="">Spam (5)</a>
    </div>

    <div class="btns-aplicar">

      <button>Accion por lote</button>
      <button>Aplicar</button>

    </div>

    <div class="scroll-tabla">

      <table class="tbl-notificaciones">
        <thead>
          <tr>
            <th>
              <input type="checkbox">
            </th>
            <th>Autor</ht>
            <th>Comentario</th>
            <th>Enviado el</th>
          </tr>
        </thead>
  
        <tbody>
          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>2345612376543987654</p>
                </div>
              </div>
              <p>svvvvvvvvfffffffffhhhhhhhhhhhhhhhhttttttttttttttts@gmail.com</p>
  
            </td>
  
            <td>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.
              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>

          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>23456123</p>
                </div>
              </div>
              <p>ssfewgdtferergmail.com</p>
  
            </td>
  
            <td>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officiis, quis aut, quas culpa nemo praesentium cum ipsum nisi quidem deserunt optio mollitia rem! Eius culpa aliquid commodi repellendus aliquam laudantium, ut enim! Culpa deserunt, nesciunt, impedit fugiat, nisi beatae corporis aliquam explicabo delectus autem doloribus. Odit ea dolores quod. Cum?
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et, consequatur officia? Consequatur eius soluta praesentium molestias repellendus nisi, animi provident aliquid aut necessitatibus facilis. Quis, officiis! Necessitatibus tempora ratione cumque dolore repellendus doloremque esse doloribus deserunt, sint amet impedit delectus reprehenderit vel architecto culpa aut aperiam, eos beatae tenetur pariatur nulla nihil animi! Et voluptatibus ratione facere fuga architecto porro deserunt animi nulla autem fugit, reiciendis earum maxime error eaque odio temporibus quaerat iste molestiae nesciunt! Doloremque fuga, voluptates tempora, dolorum quisquam facilis cupiditate, id laborum repellendus ab corrupti debitis rem voluptate provident fugit reprehenderit dolores quae unde minus porro?
              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>

          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>23456123</p>
                </div>
              </div>
              <p class="correo-notificacion">ss@gmail.com</p>
  
            </td>
  
            <td class="">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.

              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>

          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>23456123</p>
                </div>
              </div>
              <p>svvvs@gmail.com</p>
  
            </td>
  
            <td>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.
              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>

          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>23456123</p>
                </div>
              </div>
              <p>ss@gmail.com</p>
  
            </td>
  
            <td>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.
              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>


          <tr>
  
            <td>
              <input type="checkbox">
            </td>
  
            <td>
  
              <div class="aut">
                <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                <div class="aut-nametel">
                  <p>Nombre</p>
                  <p>23456123</p>
                </div>
              </div>
              <p>ss@gmail.com</p>
  
            </td>
  
            <td>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Incidunt accusantium earum minima tempora fugiat magnam beatae 
                facere aut delectus odio.
              </p>
            </td>
  
            <td>
              <p>20-11-2023</p>
            </td>
  
          </tr>
  
        </tbody>
      </table>

    </div>



    </section>

    <section class="pages" id="medicamentos">
      e
    </section>

    <section class="pages" id="Graficas">
      o
    </section>
    <!-- CUALQUIER ERROR DE AQUI HACIA ABAJO -->



    <!-- CUALQUIER ERROR SALE DE AQUI V: HACIA ARRIBA -->


  </main>

  <script src="../assets/js/admin.js"></script>
  <script src="../assets/js/menuResponsive.js"></script>

</body>

</html>