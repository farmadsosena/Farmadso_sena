<?php
session_start();
include("../config/Conexion.php"); 

if (isset($_POST['filtros'])) {
    $paciente= $_SESSION["id"];
    $filtros = json_decode($_POST['filtros'], true);

    // Construir la consulta SQL con múltiples condiciones de filtro
    $query = "SELECT * FROM formulas
    INNER JOIN diagnosticos ON formulas.idDiagnostico = diagnosticos.idDiag
     WHERE 1 and idPaciente='$paciente' and estado='1'";

    foreach ($filtros as $tipo => $valor) {
        // Verificar si el valor no está vacío antes de agregar a la consulta
        if ($valor !== '') {
            $query .= " AND $tipo = '$valor'";
        }
    }

    $result = mysqli_query($conexion, $query);

    // Mostrar resultados
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          $fecha = $row['fechaOrden'];
          $IdDiag = $row['nombreDiag'];
          $IdMedico = $row['IdMedico']; //Id del medico en la tabla Formulas
          $Estado = $row['EstadoFormula'];
          $pedido = "";
          if ($Estado == 1) {
              $pedido = " <div class='state-card1'>
                 No Asig.
              </div>";
          } else if ($Estado == 2) {
              $pedido = " <div class='state-card2'>
              Entregado
          </div>";
          }else if ($Estado == 3) {
              $pedido = " <div class='state-card3'>
             Pendiente
          </div>";
          } 





          $doc = mysqli_query($conexion, "SELECT * FROM medicos
          INNER JOIN usuarios ON medicos.idusuario = usuarios.idusuario
           WHERE idmedico = $IdMedico");
                $user_doc = mysqli_fetch_assoc($doc);
          $nombre = $user_doc['nombre']. " ". $user_doc['apellido']; //Variable que saca el nombre del medico

          $fecha_timestamp = strtotime($fecha);
          if ($fecha_timestamp !== false) {
            $fecha_formateada = date("j F Y", $fecha_timestamp);
          }

        
          echo "<div class='card' data-id='{$row['idFormula']}' data-informacion='$IdDiag'>
          <div class='firts_line'>
              <div class='date-card'>
                  <p>$fecha_formateada</p>
              </div>
  
              $pedido
          </div>
  
          <div class='second-line'>
              <h3 class='title_card'>$IdDiag</h3>
              <div class='doc'>
                  <p class='profesion'>Profesional de la salud</p>
                  <p class='name_doc'>" .$nombre. "</p>
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
    } else {
        echo '
        <div class="imgBusqueda flex">
            <img src="../assets/img/Notes-cuate.png" alt="">
            No hay resultados para los filtros seleccionados.
        </div>';
    }
} else {
    echo "No se proporcionaron filtros.";
}
?>

