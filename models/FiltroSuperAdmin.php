<?php
include "../config/Conexion.php";

if (isset($_POST["filtros"])) {
  function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
  {
    global $conexion;
    $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
    $stmt = $conexion->prepare($consulta);

    $stmt->bind_param("ii", $usuario, $valorEstado);

    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->num_rows > 0;
  }

  // Obtener los filtros enviados por AJAX
  $filtros = $_POST['filtros'];

  $Usuarios_generale = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY nombre ASC");

  // Establecer $noHayResultados a true antes de comenzar el bucle
  $noHayResultados = true;

  if ($Usuarios_generale) {
    if (mysqli_num_rows($Usuarios_generale) > 0) {
      while ($row = mysqli_fetch_assoc($Usuarios_generale)) {
        $estado = $row["estado"];
        $img = $row["imgUser"];
        $id = $row["idusuario"];

        if ($estado == "1") {
          $estado = "Activo";
        } else {
          $estado = "Suspendido";
        }

        if (empty($img)) {
          $img = "../assets/img/aaaa.jpeg";
        }

        $roles = array();

        if (existe_en_tabla('usuarios', $id, 'estado', 1)) {
          $roles[] = "Usuario EPS";
        }
        if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
          $roles[] = "Farmacia";
        }
        if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 2)) {
          $roles[] = "Domiciliario";
        }

        // Filtrar los resultados según los filtros
        $nombre = $row["nombre"] . " " . $row["apellido"];
        $correo = $row["correo"];
        $telefono = $row["telefono"];
        $filtrarNombre = empty($filtros['nombre']) || stripos($nombre, $filtros['nombre']) !== false;
        $filtrarCorreo = empty($filtros['correo']) || stripos($correo, $filtros['correo']) !== false;
        $filtrarEstado = empty($filtros['estado']) || stripos($estado, $filtros['estado']) !== false;
        $filtrarRol = empty($filtros['rol']) || count(array_intersect($roles, [$filtros['rol']])) > 0;
        $filtrarTelefono = empty($filtros['telefono']) || stripos($telefono, $filtros['telefono']) !== false;

        // Imprimir el elemento solo si cumple con todos los filtros
        if ($filtrarNombre && $filtrarCorreo && $filtrarEstado && $filtrarRol && $filtrarTelefono) {
          // Cambiar $noHayResultados a false si hay al menos un resultado
          $noHayResultados = false;

          echo '
                    <div class="tabla_acciones_encabezado remarca">
                        <div class="encabezado_part">
                            <section>
                                <img src="' . $img . '" alt="">
                            </section>
                        </div>
                        <div class="encabezado_part1" data-column="' . $nombre . '">' . $nombre . '</div>
                        <div class="encabezado_part2">' . $correo . '</div>
                        <div class="encabezado_part3">
                            <section>
                                ' . $estado . '
                            </section>
                        </div>
                        <div class="encabezado_part4">' . $telefono . '</div>
                        <div class="encabezado_part5">' . implode(', ', $roles) . '</div>
                        
                    </div>';
        }
      }

      // Verificar si no hay resultados después de aplicar los filtros
      if ($noHayResultados) {
        echo '<div class="no-filtros">No hay usuarios que coincidan con los filtros aplicados.</div>';
      }
    }
  }
} else {
  include "UsuarioSuper-admin.php";
}
?>