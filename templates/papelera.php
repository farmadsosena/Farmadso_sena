<?php
$palpel = mysqli_query($conexion, "SELECT * FROM papelera 
INNER JOIN formulas ON papelera.idAcceso = formulas.idFormula");

if ($palpel) {
  if (mysqli_num_rows($palpel) > 0) {
    while ($rw = mysqli_fetch_array($palpel)) {
?>
      <div class="rect" data-id="<?php echo $rw["idAcceso"] ?>">
        <div class="cont-cd1">
          <div>
            <input id="botonAlerta" type="checkbox" class="ui-checkbox">
          </div>
          <div class="ppp">
            <h3><?php echo $rw["CausaExterna"] ?></h3>
          </div>
        </div>
        <div class="cont-cd2">
          <section class="icon-cuadro"><i class='bx bxs-user-circle'></i></section>
          <div class="medico">
            <h3><?php $idM = $rw["IdMedico"];
                $nombreMedico = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario='$idM'");
                $arr = mysqli_fetch_assoc($nombreMedico);

                echo $arr["nombre"] . " " . $arr["apellido"];
                ?></h3>
          </div>
          <section class="contenido-tactico">
            <section class="part1-contenido">
              <div class="titulo">
                <h3><?php
                    $fechaOriginal = $rw["fechaOrden"]; // Fecha en formato "2023-10-27 04:35:45"
                    setlocale(LC_TIME, 'es_ES'); // Establece la configuración regional en español

                    $timestamp = strtotime($fechaOriginal);
                    $fechaFormateada = strftime("%d %B de %Y", $timestamp);
                    echo $fechaFormateada; // Imprimirá "27 octubre de 2023"
                    ?>
                </h3>
              </div>
              <div class="borrar-desa">
                <button>Borrada</button>
              </div>
              <section class="part2-contenido">
                <i class='bx bx-trash trah' id="botonBorrar"></i>
              </section>
            </section>
          </section>
        </div>
      </div>
<?php
    }
  } else {
    echo "<div class='semantica-img'> <img src='../assets/img/Research paper-cuate.png'> <h3>No tienes formulas eliminadas por ahora</h3></div>";
  }
}
?>