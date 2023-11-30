<?php
include "../config/Conexion.php";

function consultarTabla($conexion, $tabla, $columna, $estado)
{
  $consulta = "SELECT *, '$tabla' as tabla FROM $tabla 
               INNER JOIN usuarios on $tabla.idusuario = usuarios.idusuario
               WHERE $columna = ?";
  $stmt = $conexion->prepare($consulta);
  $stmt->bind_param("i", $estado);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['query'])) {
  $estado = $_POST['query'];


  // Consultar la tabla 'farmacias'
  $farmacias = consultarTabla($conexion, 'farmacias', 'EstadoSolicitud', $estado);

  // Consultar la tabla 'domiciliario'
  $domiciliarios = consultarTabla($conexion, 'domiciliario', 'EstadoAcept', $estado);

  // Combinar resultados en un solo array
  $resultados = array_merge($farmacias, $domiciliarios);

  // Mostrar los resultados
  if (!empty($resultados)) {
    foreach ($resultados as $row) {
        $img = !empty($row["imgUser"]) ? $row["imgUser"] : "../assets/img/aaaa.jpeg";

        // Determinar el rol basándonos en la tabla de origen
        $rol = ($row['tabla'] == 'farmacias') ? 'Farmacia' : 'Domiciliario';

        if($rol == "Farmacia"){
          $idGeneral= $row["IdFarmacia"];
        }else{
          $idGeneral= $row["iddomiciliario"];
        }

        echo '
            <div class="tabla_acciones_encabezado remarca actionn" data-id="'.$idGeneral.'" data-rol="'.$rol.'">
                <div class="encabezado_part">
                    <section>
                        <img src="' . $img . '" alt="">
                    </section>
                </div>
                <div class="encabezado_part1">' . $row["nombre"] . " " . $row["apellido"] . '</div>
                <div class="encabezado_part2">' . $row["correo"] . '</div>
                <div class="encabezado_part3">
                    <section>
                        Solicitado
                    </section>
                </div>
                <div class="encabezado_part4">' . $row["telefono"] . '</div>
                <div class="encabezado_part5">Pedido: ' . $rol . '</div>
            </div>';
    }
} else {
    // Mostrar mensaje si no hay solicitudes
    echo '<div class="no-solicitudes">No hay solicitudes entrantes en el sistema.</div>';
}
}
?>

<script>
$(document).ready(function () {
  $(".actionn").on("click", function () {
    var id = $(this).data("id");
    var rol = $(this).data("rol");
    var ruta;
    if(rol =="Farmacia"){
      ruta= "../controllers/DatosSolicitud.php";
    }else{
      ruta= "../controllers/DatosDomiciliario.php";
    }

    $.ajax({
      type: "POST",
      url: ruta,
      data: { id: id, rol: rol }, // Enviar el id y el rol como datos
      success: function (data) {
        document.querySelector('.viltrum').classList.add('flex');
        $("#datos-solicitud").html(data);
      },
    });
  });
});

</script>