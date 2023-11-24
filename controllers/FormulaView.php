<?php

include '../config/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['dataFormula'])) {
    // Obtener el valor de dataMedico
    $dataid = $_POST['dataFormula'];
    $dataMedico = $_POST['datamedico'];

    // Ejemplo: Obtener información de un médico desde la base de datos
    $query = mysqli_query($conexion, "SELECT * FROM formulas
    INNER JOIN medicos ON formulas.IdMedico = medicos.idmedico
    INNER JOIN usuarios ON formulas.idPaciente = usuarios.idusuario
    INNER JOIN diagnosticos ON formulas.idDiagnostico = diagnosticos.idDiag
    WHERE idFormula = $dataid");
    $row = mysqli_fetch_assoc($query);
?>
    <section class="bloque-formula">
      <i class="bx bx-x cass" onclick="removerClaseActiva()"></i>

      <section class="info-formulas">

        <div class="botones-formulas selee">Datos de la formula</div>
        <div class="botones-formulas"></div>

        <h2>Medico encargado</h2>

        <section class="encargado-formula">
          <div class="img">
            <img src="assets/img/banner-formulas.png" alt="">
          </div>

          <div class="nombre-datos">
            <p><?php

                $query = mysqli_query($conexion, "SELECT * FROM medicos WHERE idmedico = $dataMedico");
                $medico = mysqli_fetch_assoc($query);
                $idM = $medico['idusuario'];

                $InfoM = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = $idM");
                $raw = mysqli_fetch_assoc($InfoM);

                echo $raw['nombre'] . " " . $raw['apellido']
                ?></p>
            <h4>Tarjeta Profesional</h4>
            <p><?php echo $row['identificacionprofesional'] ?></p>
            <h4>Especialidad</h4>
            <p><?php echo $row['especialidad'] ?></p>
          </div>
        </section>

      </section>
      <section class="datos-formulas">
        <div class="overflowe scroll">
          <section class="e">
            <div class="cabezera-formulas">
              Datos personales
            </div>
            <section class="cuerpo-formula">
              <section class="cazz">
                <h3>Nombre del paciente</h3>
                <div><?php echo $row['nombre'] . " " . $row['apellido'] ?></div>
              </section>

              <section class="cazz flax">
                <h3>Identificacion</h3>
                <div><?php echo $row['documento'] ?></div>
              </section>

              <section class="cazz flax">
                <h3>Numero de telefono</h3>
                <div><?php echo $row['telefono'] ?></div>
              </section>

              <!-- <section class="cazz">
                <h3>Fecha de nacimiento</h3>
                <div><?php echo $row['fechaOrden'] ?></div>
              </section> -->

              <section class="cazz">
                <h3>fecha de orden</h3>
                <div><?php echo $row['fechaOrden'] ?></div>
              </section>

              <!-- <section class="cazz">
                <h3>Edad actual</h3>
                <div>18 años 23 dias</div>
              </section> -->


            </section>
          </section>

          <section class="e2">
            <div class="cabezera-formulas affr">
              Datos afiliacion
            </div>
            <section class="cuerpo-formula">
              <section class="cazz">
                <h3>Entidad benefactora</h3>
                <div><?php 
               $eps= $row['IdEps']; 
                $InfoM = mysqli_query($conexion, "SELECT * FROM eps WHERE ideps = $eps");
                $rew = mysqli_fetch_assoc($InfoM);
                
                echo $rew["nombre"];
                ?></div>
              </section>

              <section class="cazz flax">
                <h3>Plan de beneficios</h3>
                <div>prepagado</div>
              </section>

              <section class="cazz flax">
                <h3>Tipo de afiliacion</h3>
                <div>Beneficiario</div>
              </section>

              <section class="cazz">
                <h3>Causa registrada</h3>
                <div><?php echo $row['CausaExterna'] ?></div>
              </section>
            </section>
          </section>


          <section class="e">
            <div class="cabezera-formulas">
              Diagnosticos encontrados
            </div>
            <section class="cuerpo-formula">
              <section class="cazz cores">
                <section class="wat">
                  <h3>Entidad benefactora</h3>
                  <h4><?php  echo $rew["nit"]; ?></h4>
                </section>
                <div>
                  <?php echo $row['descripDiag'] ?>
                </div>
              </section>
            </section>
          </section>

          <section class="e">
            <div class="cabezera-formulas">
              Medicamentos
            </div>
            <section class="cuerpo-formula">
              <section class="cazz cores flex">
                <!-- COSAS DE VARIOSSSS -->

                <?php
                $detalles = mysqli_query($conexion, "SELECT * FROM  medicamentosformulas WHERE IdFormula= '$dataid'");

                if ($detalles) {
                  if (mysqli_num_rows($detalles) > 0) {
                    while ($raw = mysqli_fetch_assoc($detalles)) {
                      echo '<div class="cards">
                      <div class="carde">
                        <div class="card__image-holder">
                          <img class="card__image" src="https://source.unsplash.com/300x225/?wave" alt="wave" />
                        </div>
                        <div class="card-title">
                          <a href="#" class="toggle-info btn">
                            <span class="left"></span>
                            <span class="right"></span>
                          </a>
                          <h2>
                            Card title
                            <small>Image from unsplash.com</small>
                          </h2>
                        </div>
                        <div class="card-flap flap1">
                          <div class="card-description">
                            This grid is an attempt to make something nice that works on touch devices. Ignoring hover
                            states when theyre not available etc.
                          </div>
                          <div class="card-flap flap2">
                            <div class="card-actions">
                              <a href="#" class="btn">Read more</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>';
                    }
                  } else {
                  }
                }
                ?>
                <!-- TERMINA PRUEBA -->
              </section>
            </section>
          </section>
        </div>
      </section>
    </section>


    <script>
      $(document).ready(function() {
        var zindex = 10;

        $("div.carde").click(function(e) {
          e.preventDefault();
          console.log("HECHO")

          var isShowing = false;

          if ($(this).hasClass("show")) {
            isShowing = true
          }

          if ($("div.cards").hasClass("showing")) {
            // a card is already in view
            $("div.card.show")
              .removeClass("show");

            if (isShowing) {
              // this card was showing - reset the grid
              $("div.cards")
                .removeClass("showing");
            } else {
              // this card isn't showing - get in with it
              $(this)
                .css({
                  zIndex: zindex
                })
                .addClass("show");
            }
            zindex++;

          } else {
            // no cards in view
            $("div.cards")
              .addClass("showing");
            $(this)
              .css({
                zIndex: zindex
              })
              .addClass("show");

            zindex++;
          }

        });
      });
    </script>
<?php
  }
}
?>