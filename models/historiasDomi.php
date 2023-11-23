<?php
require_once('../config/Conexion.php');

// Verificar si la conexión está establecida correctamente
if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}

$sql = "SELECT * FROM reporteestadofinal";
$resultado = mysqli_query($conexion, $sql);

// Verificar si la consulta fue exitosa
if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

while ($datosdereporte = $resultado->fetch_assoc()) {
    $idcompra = $datosdereporte["idcompra"];
    $idestadocompra = $datosdereporte["idestadocompra"];

    if ($idestadocompra == 4) {
       $idestadocompra = "Entregado";
          // Formatear la fecha
    $fechaEntrega = date("d/m/Y", strtotime($datosdereporte["fechafinal"]));

    if ($idcompra) {
        $consultacompra = "SELECT * FROM compra WHERE idcompra = $idcompra";
        $resultadocompra = mysqli_query($conexion, $consultacompra);
        $datosCompra = $resultadocompra->fetch_assoc();
        $idpaciente = $datosCompra["idPaciente"];
        $direccionCliente = $datosCompra["direccion"];

        if ($idpaciente) {
            $consultaUsuarios = "SELECT * FROM usuarios WHERE id = $idpaciente";
            $resultadoUsuario = mysqli_query($conexion, $consultaUsuarios);
            $datosUsuario = $resultadoUsuario->fetch_assoc();
            $nombreUsuario = $datosUsuario["nombre"];
            $apellidoUsuario = $datosUsuario["apellido"];

            // Imprimir el bloque HTML con los datos
            echo '<div class="c">
                    <div class="inf">
                      <div class="logo">
                        <i class="fa-solid fa-box-archive"></i>
                      </div>
                      <div class="infff">
                        <p>' . $nombreUsuario . ' ' . $apellidoUsuario . '</p>
                        <p>Dirección: ' . $direccionCliente . '</p>
                        <div class="FechaDate">
                          <h3>Fecha:</h3>
                          <p>' . $fechaEntrega . '</p>
                        </div>
                      </div>
                      <div class="listo">
                        <div class="co">
                          <p>000' . $idcompra . '</p>
                        </div>
                        <div class="chulo">
                          <i class="fa-solid fa-check"></i>
                          <p>' . $idestadocompra . '</p>
                        </div>
                      </div>
                    </div>
                    <div id="b">
                      <button id="but" onclick="abrirG(' . $idcompra . ')" class="openModalButton">
                        Ver más...
                      </button>
                    </div>
                  </div>';
        }
    }
    
    }
 
}

?>
