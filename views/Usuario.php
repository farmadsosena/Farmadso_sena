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
  <title>Farmadso cuenta verificada</title>
</head>

<body>
  <header class="adder">
    <section class="nabber">
      <i class='bx bx-menu'></i>
      <div>
        <img src="../assets/img/logoFarmadso - cambio.png" alt="">
        <p>Farmadso</p>
      </div>
    </section>
    <section class="buscador">
      <div>
        <input type="search" name="" id="" placeholder="Buscar campo">
        <i class='bx bx-search-alt-2'></i>
      </div>
    </section>
    <section class="optio">
      <section class="option-true">
        <a href="configuracion.html"><i class='bx bx-cog'></i></a>

        <div class="custom-select">
          <div class="selected-option">
            <i class='bx bx-car'></i> Opción 1
          </div>
          <div class="options">
            <div class="option">
              <i class='bx bx-user-circle'></i> Usuario estandar
            </div>
            <div class="option">
              <i class='bx bx-car'></i> Domiciliario
            </div>
            <div class="option">
              <i class='bx bxs-business'></i> Farmaceutico
            </div>
            <div class="option">
              <i class='bx bx-world'></i> Super Admin
            </div>
            <div class="option">
              <i class='bx bx-user-plus'></i> Invitado
            </div>
          </div>
        </div>

        <section class="cont-usu" id="cuenta-fasd">
          <section class="cont-img">
            <img src="../assets/img/logoFarmadso.png" alt="">
          </section>
        </section>

      </section>
    </section>
  </header>
  <main class="mader">
    <section class="naver">
      <section class="hoss">
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

        </div>
      </section>
    </section>
    <section class="cuerpores">
    
      <section class="paginas" id="uno">
        <div class="formulas">
          <div class="opt_config">
            <div class="search">
              <input type="search" placeholder="Buscar Formula..." />
              <div class="lupa">
                <img
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAp5JREFUSEuN1s3LFmUUBvDfIWkRWZBgugmTsBbmGwnRIoUSEg3aloEtlKCgWhi08A9Q2iRiYi4MVELwDxBXgkpFG18JpFAIRHFRZJL0pdWReWae97nn67V7Mczcc+Z8Xee67gnFCuTswuS+tGi2xvbbppOnynTQ0cy28XYfp2N5xey7ELKs4AlsI7aSc3U1MR/yVHIC10unvU40mdcVtN8+IuM4+Xq/RU0SdeNOYofwR/U0UGAdoqyAfAjfYi3+Fg7L2B/yxwaK1cGuDO9IDza2G4i7PbCapIsAk51j2E5cIzfj+zZEC3isk3E65MrkU3zUw2waoOjOs/gO/+CFYL7Oug1y0feNOIs7xJMhb7QmsBWg9nEgeD/5DB8MTNzQwH2Jt4jd5N76m3JYWhi4EjyVdf8vjYK2QI2Jo5eTM8R5sqqoU3FlM1u/owL5Afw30J1OBZMUHsMvxE1yWT9Au4LfgqXJw6iCDawe6Srb28TPIZdPMZvxacrk2tVFzGE9cWFMIzpkfBHf4EywqQ9yq0XxSciPk8/x3tjYlWUFR5O3cQAftlo0MKZrgh8y/CvLMR2dpw3kuebtelyYWpYD0pKK4EiGHdLV4NUMlwfVlOeI0+TjOIx3e2kUcJUa3EhFrA35V4ZD0j5ca/i2Bruwk1jS4FRhULH+9qC8Dyjio6gI9FqHxCUst6Q9eBPPYx6v4NYCExrHfTWdsXFVTlhqC9bhz6bPX+MgfkXFg4pocyEvZtgk3ZwRJko17czHSPMHrKogX+EZ4Yr0UvDT9CDsqmkxXIuIfKk59f3yyUSFp6WdwRftAGPC03dUn3o9HZk4WIE3sL9bZVeR/6dKlKdYKSHtbOsWjZ/riwbrsX0gTv+vYtGTvMvRhU73/2+a6PcASOINLVWIdesAAAAASUVORK5CYII=" />
              </div>
            </div>
            <div class="filtros">
              <div class="doctor config_filtros">
                Doctor
                <img class="img"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAeZJREFUSEuVlT8vBFEUxX9XRFQShUKtQEgUZLVUdHwAH0BU24tOL6r9AKKno6K2UUhEKNQKhUQlIvtkZ97Mu++9O7NMsZl9f+655957zghtjwCu+PGnBMHV/1rvFpvD8+rRofx+AjAipA8Q4owCqPPOiARSGaZn6dkrBs30dUYtkU16UYmMZIrUi7oL4zjpC27ghHUcP3bB0p6lp3Rj45oegxx6BsP3I938jJlVIn0oafgqcAeM+XwGIB3B3VdDFucdQ9ccsuTLW5PAIzCXkH0FlhG+0rkNcVqmSIH1BPbLTGNeAj0nHNR90lOn3o3lemkLx1XIPJ40D7cNXDc1vJyiTCDF6jTCC44ZfUaD+Uq/A/PAhwUitnqLoxfATnwpO11tXwK7IwCiy3sCZ5UD2frIoPccnJf+E/wqUrKnPAs8C0wFi2t1hmrzE1gAeQsA0RTVDG6ADZ2fbRVmuW6BzXgoYqZdhBPlzn+0Hj0l0hXcqRZgBbEg8OBgwlReNm7Gd6Jc+gZWhmVOvwd9gbVIUMb4GnpLZqBoct8JnWEl1JjKk+AWkw+Y7WdNKCGhJwdLgYEttP9XSntCo5tmttjmk41KqaGUDrxjjC6ybTtqNU1JRzZ9qcVOTKPUuimb/OeyxLlkLmto7xdNs8gneRCFOwAAAABJRU5ErkJggg==" />
              </div>

              <div class="state config_filtros">
                Estado
                <img
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAeZJREFUSEuVlT8vBFEUxX9XRFQShUKtQEgUZLVUdHwAH0BU24tOL6r9AKKno6K2UUhEKNQKhUQlIvtkZ97Mu++9O7NMsZl9f+655957zghtjwCu+PGnBMHV/1rvFpvD8+rRofx+AjAipA8Q4owCqPPOiARSGaZn6dkrBs30dUYtkU16UYmMZIrUi7oL4zjpC27ghHUcP3bB0p6lp3Rj45oegxx6BsP3I938jJlVIn0oafgqcAeM+XwGIB3B3VdDFucdQ9ccsuTLW5PAIzCXkH0FlhG+0rkNcVqmSIH1BPbLTGNeAj0nHNR90lOn3o3lemkLx1XIPJ40D7cNXDc1vJyiTCDF6jTCC44ZfUaD+Uq/A/PAhwUitnqLoxfATnwpO11tXwK7IwCiy3sCZ5UD2frIoPccnJf+E/wqUrKnPAs8C0wFi2t1hmrzE1gAeQsA0RTVDG6ADZ2fbRVmuW6BzXgoYqZdhBPlzn+0Hj0l0hXcqRZgBbEg8OBgwlReNm7Gd6Jc+gZWhmVOvwd9gbVIUMb4GnpLZqBoct8JnWEl1JjKk+AWkw+Y7WdNKCGhJwdLgYEttP9XSntCo5tmttjmk41KqaGUDrxjjC6ybTtqNU1JRzZ9qcVOTKPUuimb/OeyxLlkLmto7xdNs8gneRCFOwAAAABJRU5ErkJggg==" />
              </div>

              <div class="date config_filtros">
                Fecha
                <img
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAbJJREFUSEuNVstNRDEMHNeBhIQ4QDc0w4UOoCEK4bI3BBJ9GCVx4rHjwO5p9z3Hn/k4K8gfAaACgUL5XX8O2Os6psfHsy3eTsVKli+Vj0/5l3/nTkbqsoBl5p6rYdWmHHmKZOFFAcvEqc3dIUofNcykejngihM8AXgF5NGLGaZbgQiFFb4AeAbwzvNwUz8AbrY+ywf1SIB8Ano/JyaIehaCdMfjILhNUQLIPB0KNCD/I80hZTmuafrxXoAQZPbLwps43AxRO0ycHcryWrhc4wOGLMUv1UlqxmR3ojlaqzfMzndYjAPBKOD5IrPFGJtj614MmekDZ0FnR1Z2Qpi5cTLH2cnpJv8wAakoBPbnA4rp2LxCRgMOl8s0LSxLxFuTRfYHrbQRgg8YU4FOH+zIlpshhVUkp5Bs39ZMuxuscAHRSJqosy3XgHSZ9m9Zpr2AG3wtR9+yA3xlLTpEQUUh0XX77hy1DHxYdkxsBH+zRs1N7QMA3wBuY2MxZVJdcQfhS4A7dzjpF9B24bwBeKh3UZysuAE/oPICqF04u5NXR1dCUZqE91veResPwKnAefVMc8eIX5jHxyJ9drbKAAAAAElFTkSuQmCC" />
              </div>



            </div>
          </div>
          <div class="cards_formulas">


            <div class="card" data-id="1">
              <div class="firts_line">
                <div class="date-card">
                  <p>05 de Noviembre de 2023</p>
                </div>

                <div class="state-card2">
                  Entregado
                </div>

              </div>

              <div class="second-line">
                <h3 class="title_card">
                  Formulación de software para el catéter de rodilla maxilar </h3>

                <div class="doc">
                  <p class="profesion">Profesional de la salud</p>
                  <p class="name_doc">Diego Hoyos Linares</p>
                </div>

                <div class="eps">

                </div>

                <div class="opt-card">

                </div>
              </div>

              <div class="third-line">

                Descargar

                <img class="open_menu"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />

              </div>
              <div class="menu_card">
                <ul>
                  <li>Abrir</li>
                  <li class="delete">Eliminar</li>
                </ul>
              </div>


              <div class="modal_card">
          
              </div>
            </div>

            <div class="card" data-id="1">
              <div class="firts_line">
                <div class="date-card">
                  <p>05 de Noviembre de 2023</p>
                </div>

                <div class="state-card2">
                  Entregado
                </div>

              </div>

              <div class="second-line">
                <h3 class="title_card">
                  Formulación de software para el catéter de rodilla maxilar </h3>

                <div class="doc">
                  <p class="profesion">Profesional de la salud</p>
                  <p class="name_doc">Diego Hoyos Linares</p>
                </div>

                <div class="eps">

                </div>

                <div class="opt-card">

                </div>
              </div>

              <div class="third-line">

                Descargar

                <img class="open_menu"
                  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=" />

              </div>
              <div class="menu_card">
                <ul>
                  <li>Abrir</li>
                  <li class="delete">Eliminar</li>
                </ul>
              </div>


              <div class="modal_card">
          
              </div>
            </div>

            <div class="card">
              <div class="firts_line">
                <div class="date-card">
                  <p>10 de Diciembre de 2023</p>
                </div>

                <div class="state-card">
                  Pendiente
                </div>

              </div>

              <div class="second-line">
                <h3 class="title_card">
                  Formulación de software para el catéter de rodilla maxilar </h3>

                <div class="doc">
                  <p class="profesion">Profesional de la salud</p>
                  <p class="name_doc">Diego Hoyos Linares</p>
                </div>

                <div class="eps">

                </div>

                <div class="opt-card">

                </div>
              </div>

              <div class="third-line">

                Descargar

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


            <div class="card">
              <div class="firts_line">
                <div class="date-card">
                  <p>10 de Diciembre de 2023</p>
                </div>

                <div class="state-card3">
                No pedido
                </div>

              </div>

              <div class="second-line">
                <h3 class="title_card">
                  Formulación de software para el catéter de rodilla maxilar </h3>

                <div class="doc">
                  <p class="profesion">Profesional de la salud</p>
                  <p class="name_doc">Diego Hoyos Linares</p>
                </div>

                <div class="eps">

                </div>

                <div class="opt-card">

                </div>
              </div>

              <div class="third-line">

                Descargar

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
          </div>
        </div>


      

      </section>
    
      <section class="paginas" id="dos">
        ejem 2
      </section>

      <section class="paginas" id="tres">
        <div class="cont-p">
          <div class="icon"><i class='bx bx-left-arrow-alt'></i></div>
            <div class="bt-form">

              <button class="title-formula">
                <h1>Formulas</h1>
              </button>

              <button class="eliminar-razon">Eliminar</button>

              <div class="seleccion-todo">

                <input type="checkbox" id="seleccionarTodo">
                <p>Seleccionar todo</p>

              </div>

            </div>

            <div class="sect-p">
              <div class="rect">
                <div class="cont-cd"> 
                  <input id="botonAlerta" type="checkbox" class="ui-checkbox"> 
                <div><h3>Razon de la formula 1</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula 2</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula 3</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>

              <div class="rect">
                <div class="cont-cd"> 
                  <input type="checkbox" class="ui-checkbox">
                <div><h3>Razon de la formula</h3></div>
                </div>
                <div class="cont-cd">          
                  <div class="icon-cuadro"><i class='bx bxs-user-circle' ></i></i></div>
                  <div><h3>Doctor</h3></div></div>
                <div><h3>Fecha</h3></div>
                <div><button>Estado</button></div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </section>
  </main>

  <section class="cuentas" id="datos-user">
    <section class="overflow">
      <header>
        <h2>diegohlinares2004@gmail.com</h2>
        <section class="dash-img">
          <img src="" alt="">
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
        <form action="" method="post" class="from-details">
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
</body>

</html>