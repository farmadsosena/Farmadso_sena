<?php

require_once('../config/Conexion.php');

$idDomi = $_SESSION["id"];

// Verificar si la conexión está establecida correctamente
if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
} else {

    // Verificar si el idDomi está definido y es un valor numérico
    if (isset($idDomi) && is_numeric($idDomi)) {

        // Consultar si el domiciliario existe
        $consultaDomiciliario = "SELECT * FROM domiciliario WHERE idusuario = $idDomi";
        $resultadoDomiciliario = mysqli_query($conexion, $consultaDomiciliario);


        // Verificar si se encontró el domiciliario
        if ($resultadoDomiciliario->num_rows > 0) {

          $idDomiciliario = $resultadoDomiciliario->fetch_assoc();
          $id = $idDomiciliario['iddomiciliario'];

            $sql = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $id";
            $resultado = mysqli_query($conexion, $sql);

            while ($datosdereporte = $resultado->fetch_assoc()) {
                $idcompra = intval( $datosdereporte["idcompra"]);
                $idestadocompra =intval ($datosdereporte["idestadocompra"]);


                if ($idestadocompra === 4) {
                    $idestadocompra = "Entregado";
            
                    // Formatear la fecha
                    $fechaEntrega = date("d/m/Y", strtotime($datosdereporte["fechafinal"]));

                    if ($idcompra) {
                        $consultacompra = "SELECT * FROM compra WHERE idcompra = $idcompra";
                        $resultadocompra = mysqli_query($conexion, $consultacompra);

                        // Verificar si la consulta de compra fue exitosa
                        if (!$resultadocompra) {
                            die("Error en la consulta de compra: " . mysqli_error($conexion));
                        }

                        $datosCompra = $resultadocompra->fetch_assoc();
                        $direccionCliente = $datosCompra["direccion"];

                      




                            
                            // Imprimir el bloque HTML con los datos
                            echo '<div class="c">
                                    <div class="inf">
                                      <div class="logo">
                                        <img src="../assets/img/pedidoEntregado.png" class="pedidoEntregado">
                                      </div>
                                      <div class="infff">
                                        <p></p>
                                        <p>Dirección: ' . $direccionCliente . '</p>
                                        <div class="FechaDate">
                                          <h3>Fecha: ' . $fechaEntrega . '</h3>
                                          <p></p>
                                        </div>
                                      </div>
                                      <div class="listo">
                                        <div class="co">
                                          <p>000'. $idcompra . '</p>
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
        } else {
            echo "El domiciliario no existe.";
            
            // Mostrar el ID del domiciliario
            echo "ID del domiciliario: $idDomi";
        }

    } else {
        echo "ID de domiciliario no válido.";
    }
}
?>
