<?php
session_start();
require_once('conexion.php');

// Crear una conexión a la base de datos
$conexionDataBase = new Conexion();
$conexion = $conexionDataBase->Getconexion();


// Validar usuario
function userValidate()
{

    $idUser = (isset($_SESSION['sessionId'])) ? $data = array('sessionId' => $_SESSION['sessionId']) :
        ((isset($_SESSION['id_cliente'])) ? $data = array('id_cliente' => $_SESSION['id_cliente']) : null);

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
            INNER JOIN producto ON carrito.id_producto = producto.id_producto
            INNER JOIN inventario ON producto.id_producto = inventario.id_producto
            WHERE idsession = '$idUserBd'";
    } elseif (!empty($idUserSession['id_cliente'])) {


        $id = $idUserSession['id_cliente'];
        $consultaCarrito = "SELECT * FROM carrito
            INNER JOIN producto ON carrito.id_producto = producto.id_producto
            INNER JOIN inventario ON producto.id_producto = inventario.id_producto
            WHERE carrito.id_cliente = '$id'";
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
        $idProducto = $fila['id_producto'];
        $cantidadProducto = $fila['cantidad'];

        // Agregar los datos al arreglo $datosPedido directamente sin sobrescribir variables de sesión
        $datosPedido[$idProducto] = $cantidadProducto;

        $total = $fila['preciototal'];
        $subtotal += $total;

        // Generar filas para la tabla con los detalles del producto en el carrito
        $imagen = $fila['imagen'];
        $modificarRuta = '../';
        if (strpos($imagen, $modificarRuta) === 0) {
            $imagen = str_replace($modificarRuta, '', $imagen);
        }
        $precio = intval($fila['preciototal']);
        $html .= '
                <div id="itemCarrito">
                    <input type="checkbox" class="checkboxMarcados" value="' . $idProducto . '" name="id_productos[]">
                    <img src="' . $imagen . '" alt="">
                    <div class="contenido">
                        <p>' . $fila['nombre_producto'] . '</p>
                        <p>Code #' . $fila['codigo_producto'] . '</p>
                        <span class="costo">$' . $precio . '</span>
                    </div>
                    <div class="cantidad">
                        <p>Cantidad ' . $fila['cantidad'] . '</p>
                        <div class="eliminarProducto" data-id="' . $fila['id_producto'] . '">Eliminar <i class="fa-solid fa-trash"></i></div>
                        <input type="hidden" name="idProductos[]" value="' . $fila['id_producto'] . '  => ' . $fila['cantidad'] . '">
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