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
      $estado= $row["estado"];
      $img= $row["imgUser"];
      $id= $row["idusuario"];

      //Para que el estado sea definido mas definidamente
      if($estado == "1"){
        $estado= "Activo";
      }else{
        $estado= "Suspendido";
      }

      //En caso de que no tenga una imagen ponga una por defecto
      if(!empty($img)){
        $img= $row["imgUser"];
      }else{
        $img= "../assets/img/aaaa.jpeg";
      }

      $roles= array();

      //Funcion para determinar que roles tiene el Usuario en el sistem


      if (existe_en_tabla('usuarios', $id, 'estado', 1)) {
        $roles[]= "Usuario EPS";
      }
      if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
        $roles[]= "Farmacia";
      }
      if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 2)) {
        $roles[]= "Domiciliario";
      }
      echo '
      <div class="tabla_acciones_encabezado remarca">
        <div class="encabezado_part">
            <section>
              <img src="'.$img.'" alt="">
            </section>
        </div>
        <div class="encabezado_part1">'.$row["nombre"] . " " . $row["apellido"].'</div>
        <div class="encabezado_part2">'.$row["correo"].'</div>
        <div class="encabezado_part3">
            <section>
              '.$estado.'
            </section>
        </div>
        <div class="encabezado_part4">'.$row["telefono"].'</div>
        <div class="encabezado_part5">'.implode(', ', $roles).'</div>
        <div class="encabezado_part6">
            <button class="activado"><i class="bx bx-power-off"></i></button>
            <button class="desac"><i class="bx bxs-user"></i></i></button>
        </div>
        </div>       
      ';
    }
  }
}
?>