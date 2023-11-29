<?php
function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
{
  global $conexion;
  $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
  $stmt = $conexion->prepare($consulta);

  // Cambié "ss" a "is" para reflejar que $usuario es un número (asumiendo que es numérico).
  $stmt->bind_param("ii", $usuario, $valorEstado);

  $stmt->execute();
  $resultado = $stmt->get_result();
  return $resultado->num_rows > 0;
}


$Usuarios_generale = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY nombre ASC");

if ($Usuarios_generale) {
  if (mysqli_num_rows($Usuarios_generale) > 0) {
    while ($row = mysqli_fetch_assoc($Usuarios_generale)) {
      $estado = $row["estado"];
      $img = $row["imgUser"];
      $id = $row["idusuario"];

      $roles = array();

      //Funcion para determinar que roles tiene el Usuario en el sistem


      if (existe_en_tabla('usuarios', $id, 'estado', 2)) {
        $roles[] = "Usuario EPS";
      }
      if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
        $roles[] = "Farmacia";
      }
      if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 2)) {
        $roles[] = "Domiciliario";
      }

      $totalRoles = count($roles);
      $UnionRoles = implode(', ', $roles);

      //Para que el estado sea definido mas definidamente
      if ($estado == "2") {
        $estado = "Activo";
      }
      if ($estado == "3") {
        $estado = "Suspendido";
      }

      //En caso de que no tenga una imagen ponga una por defecto
      if (!empty($img)) {
        $img = $row["imgUser"];
      } else {
        $img = "../assets/img/aaaa.jpeg";
      }

      echo '
      <div class="tabla_acciones_encabezado remarca" data-id="' . $id . '" data-total="' . $totalRoles . '" data-roles-list="' . $UnionRoles . '">
        <div class="encabezado_part">
            <section>
              <img src="' . $img . '" alt="">
            </section>
        </div>
        <div class="encabezado_part1" data-column="' . $row["nombre"] . " " . $row["apellido"] . '">' . $row["nombre"] . " " . $row["apellido"] . '</div>
        <div class="encabezado_part2">' . $row["correo"] . '</div>
        <div class="encabezado_part3">
            <section>
              ' . $estado . '
            </section>
        </div>
        <div class="encabezado_part4">' . $row["telefono"] . '</div>
        <div class="encabezado_part5">' . $UnionRoles . '</div>
        </div>       
      ';
    }
  } else {
    // Mostrar mensaje si no hay solicitudes
    echo '<div class="no-solicitudes">No hay ususarios entrantes en el sistema.</div>';
  }
}
?>
<script>
  
</script>