<?php

$conexion = mysqli_connect("localhost", "root", "", "farmadso");

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

        // Verificar si la consulta fue exitosa
        if (!$resultadoDomiciliario) {
            die("Error en la consulta de domiciliario: " . mysqli_error($conexion));
        }

        // Verificar si se encontró el domiciliario
        if (mysqli_num_rows($resultadoDomiciliario) > 0) {

    

            $sql = "SELECT * FROM reporteestadofinal WHERE idrepartidor = $idDomi";
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si la consulta fue exitosa
            if (!$resultado) {
                die("Error en la consulta: " . mysqli_error($conexion));
            }

            while ($datosdereporte = $resultado->fetch_assoc()) {
                $idcompra = $datosdereporte["idcompra"];
                $idestadocompra = $datosdereporte["idestadocompra"];

        
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
                        $idpaciente = $datosCompra["idPaciente"];
                        $direccionCliente = $datosCompra["direccion"];

                        if ($idpaciente) {
                            $consultaUsuarios = "SELECT * FROM usuarios WHERE idusuario = $idpaciente";
                            $resultadoUsuario = mysqli_query($conexion, $consultaUsuarios);

                            // Verificar si la consulta de usuarios fue exitosa
                            if (!$resultadoUsuario) {
                                die("Error en la consulta de usuarios: " . mysqli_error($conexion));
                            }

                            $datosUsuario = $resultadoUsuario->fetch_assoc();
                            $nombreUsuario = $datosUsuario["nombre"];
                            $apellidoUsuario = $datosUsuario["apellido"];

                        }
                    }
                }
                  
                            // Imprimir el bloque HTML con los datos
                            echo '<div class="c">
                                    <div class="inf">
                                      <div class="logo">
                                        <i class="fa-solid fa-box-archive"></i>
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
                                          <p>000 ' . $idcompra . '</p>
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
