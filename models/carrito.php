<?php
session_start();
require_once "../config/Conexion.php";

// Validar usuario
function userValidate()
{

    $idUser = (isset($_SESSION['id_invitado'])) ? $data = array('sessionId' => $_SESSION['id_invitado']) :
        ((isset($_SESSION['id'])) ? $data = array('id_cliente' => $_SESSION['id']) : null);

    return $idUser;
}


// Verificar si un usuario ha iniciado sesión (identificado por 'id_cliente' en la sesión)

$idUserSession = userValidate();

// Inicialmente, asignamos null a $idUserBd.
$idUserBd = null;

// Verificamos si existe 'sessionId' en $idUserSession, si es cierto, asignamos su valor a $idUserBd.
if (isset($idUserSession['sessionId'])) {
    $idUserBd = $idUserSession['sessionId'];
} 
// Si 'sessionId' no existe, verificamos si existe 'id_cliente' en $idUserSession, y si es cierto, asignamos su valor a $idUserBd.
elseif (isset($idUserSession['id_cliente'])) {
    $idUserBd = $idUserSession['id_cliente'];
}



    if (!empty($idUserSession['sessionId'])) {
        $consultaCarrito = "SELECT * FROM carrito
            INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento
            INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
            WHERE idinvitado = '$idUserBd'";
    } elseif (!empty($idUserSession['id_cliente'])) {
        $id = $idUserSession['id_cliente'];
        $consultaCarrito = "SELECT * FROM carrito
            INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento
            INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
            WHERE carrito.idusuario = '$id'";
    } else {
        $consultaCarrito = null;
    }



// Ejecutar la consulta
$resultadoCarrito = mysqli_query($conexion, $consultaCarrito);

// Verificar si el carrito de compras está vacío para el usuario actual
if (mysqli_num_rows($resultadoCarrito) == 0) {
    $response = array(
        'message' => 'No hay productos en el carrito <style>#contC,.contC,.successCarrito,#paypal-button-container,#form-eliminar  > p{display:none; }#carritoIcono{color: #363636;}</style>',
        'html' => '',
        'subtotal' => 0,
        'datosPedido' => ""
    );
} else {
    $html = '';
    $subtotal = 0;
    $datosPedido = array(); // Crear un arreglo para almacenar los datos del pedido

    // Recorrer cada producto en el carrito
    while ($fila = mysqli_fetch_assoc($resultadoCarrito)) {
        // Datos para la pasarela de pago
        $idProducto = $fila['idmedicamento'];
        $cantidadProducto = $fila['cantidadcarrito'];

        // Agregar los datos al arreglo $datosPedido directamente sin sobrescribir variables de sesión
        $datosPedido[$idProducto] = $cantidadProducto;

        $total = $fila['precio'];
        $subtotal += $total;

        // Generar filas para la tabla con los detalles del producto en el carrito
        $imagen = $fila['imagenprincipal'];
        $modificarRuta = '../';
        if (strpos($imagen, $modificarRuta) === 0) {
            $imagen = str_replace($modificarRuta, '', $imagen);
        }
        $precio = intval($fila['precio']);
        $html .= '
                <div id="itemCarrito">
                    <input type="checkbox" class="checkboxMarcados" value="' . $idProducto . '" name="id_productos[]">
                    <img src="' . $imagen . '" alt="">
                    <div class="contenido">
                        <p>' . $fila['nombre'] . '</p>
                        <p>Code #' . $fila['codigo'] . '</p>
                        <span class="costo">$' . $precio . '</span>
                    </div>
                    <div class="cantidad">
                        <p>Cantidad ' . $fila['cantidadcarrito'] . '</p>
                        <div class="eliminarProducto" data-id="' . $fila['idmedicamento'] . '">Eliminar <i class="fa-solid fa-trash"></i></div>
                        <input type="hidden" name="idProductos[]" value="' . $fila['idmedicamento'] . '  => ' . $fila['cantidadcarrito'] . '">
                    </div>
                </div>';
    }

    $html .= '</tbody></table>';

    $response = array(
        'message' => '',
        'html' => $html,
        'subtotal' => $subtotal

    );

    $_SESSION['datosPedido'] = $datosPedido; // Guardar el arreglo en la variable de sesión
    $_SESSION['subtotal'] = $subtotal;
}

// Devolver la respuesta en formato JSON
echo json_encode($response);

?>



// require_once('../config/Conexion.php');

// // Crear una conexión a la base de datos
// $conexionDataBase = new Conexion();
// $conexion = $conexionDataBase->Getconexion();

// // Validar usuario
// function userValidate()
// {
//     if (isset($_SESSION['idinvitado'])) {
//         return array('idinvitado' => $_SESSION['idinvitado']);
//     } elseif (isset($_SESSION['id'])) {
//         return array('id' => $_SESSION['id']);
//     } else {
//         return null;
//     }
// }

// // Verificar si un usuario ha iniciado sesión (identificado por 'id' en la sesión)
// $idUserSession = userValidate();

// if ($idUserSession) {
//     if (isset($idUserSession['idinvitado'])) {
//         $idUserBd = $idUserSession['idinvitado'];
//         $consultaCarrito = "SELECT * FROM carrito
//             INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento
//             INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
//             WHERE carrito.idcarrito = '$idUserBd'";
//     } elseif (isset($idUserSession['id'])) {
//         $idUserBd = $idUserSession['id'];
//         $consultaCarrito = "SELECT * FROM carrito
//             INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento
//             INNER JOIN inventario ON medicamentos.idmedicamento = inventario.idmedicamento
//             WHERE carrito.idusuario = '$idUserBd'";
//     }

//     $resultadoCarrito = mysqli_query($conexion, $consultaCarrito);

//     if ($resultadoCarrito) {
//         if (mysqli_num_rows($resultadoCarrito) === 0) {
//             $response = array(
<!-- //                 'message' => 'No hay productos en el carrito <style>#contC,.contC,.successCarrito,#paypal-button-container,#form-eliminar  > p{display:none; }#carritoIcono{color: #363636;}</style>', -->
//                 'html' => '',
//                 'subtotal' => 0,
//                 'datosPedido' => ""
//             );
//         } else {
//             $html = '';
//             $subtotal = 0;
//             $datosPedido = array();

//             while ($fila = mysqli_fetch_assoc($resultadoCarrito)) {
//                 $idProducto = $fila['idmedicamento'];
//                 $cantidadProducto = $fila['cantidadcarrito'];
//                 $datosPedido[$idProducto] = $cantidadProducto;

//                 $total = $fila['precio'];
//                 $subtotal += $total;

//                 $imagen = $fila['imagenprincipal'];
//                 $modificarRuta = '../';
//                 if (strpos($imagen, $modificarRuta) === 0) {
//                     $imagen = str_replace($modificarRuta, '', $imagen);
//                 }
//                 $precio = intval($fila['precio']);
//                 $html .= '
<!-- //                     <div id="itemCarrito">
//                         <input type="checkbox" class="checkboxMarcados" value="' . $idProducto . '" name="id_productos[]">
//                         <img src="' . $imagen . '" alt="">
//                         <div class="contenido">
//                             <p>' . $fila['nombre'] . '</p>
//                             <p>Code #' . $fila['codigo'] . '</p>
//                             <span class="costo">$' . $precio . '</span>
//                         </div>
//                         <div class="cantidad">
//                             <p>Cantidad ' . $fila['cantidadcarrito'] . '</p>
//                             <div class="eliminarProducto" data-id="' . $fila['idmedicamento'] . '">Eliminar <i class="fa-solid fa-trash"></i></div>
//                             <input type="hidden" name="idProductos[]" value="' . $fila['idmedicamento'] . '  => ' . $fila['cantidadcarrito'] . '">
//                         </div>
//                     </div>'; -->
//             }

<!-- //             $html .= '</tbody></table>'; -->

//             $response = array(
//                 'message' => '',
//                 'html' => $html,
//                 'subtotal' => $subtotal
//             );

//             $_SESSION['datosPedido'] = $datosPedido;
//             $_SESSION['subtotal'] = $subtotal;
//         }
//     } else {
        
//         $response = array(
//             'message' => 'Error en la consulta: ' . $error,
//             'html' => '',
//             'subtotal' => 0,
//             'datosPedido' => ""
//         );
//     }
// } else {
//     $response = array(
//         'message' => 'No hay sesión de usuario',
//         'html' => '',
//         'subtotal' => 0,
//         'datosPedido' => ""
//     );
// }
// echo $error = mysqli_error($conexion);
// echo json_encode($response);
?>
