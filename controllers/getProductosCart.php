<?php
session_start();
include('../config/Conexion.php');

// Verifica si la solicitud es un método GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Inicia la sesión
    $where = '';
    // Verifica si está establecido el id de usuario en la sesión
    if (isset($_SESSION['id'])) {
        $where = $_SESSION['id'];
    } elseif (isset($_SESSION['idinvitado'])) {
        $where =  $_SESSION['idinvitado'];
    }

    $query = "SELECT medicamentos.nombre, carrito.idmedicamento, medicamentos.precio, medicamentos.codigo, medicamentos.imagenprincipal, carrito.cantidadcarrito, (medicamentos.precio * carrito.cantidadcarrito) AS costo FROM carrito INNER JOIN medicamentos ON carrito.idmedicamento = medicamentos.idmedicamento WHERE  carrito.idinvitado ='$where' or carrito.idusuario = '$where'";
    $result = $conexion->query($query);

    if ($result) {
        $medicamentos = array();
        $subtotal = 0;
        $medicamentosList  = array();

        while ($producto = $result->fetch_assoc()) {
            $costo = $producto['precio'] * $producto['cantidadcarrito'];
            $subtotal += $costo;
            $id = $producto['idmedicamento'];
            // Agrega el producto al array $medicamentos
            $producto['costo'] = $costo;
            $medicamentosList[$id] = $producto['cantidadcarrito'];
            $medicamentos[] = $producto;
        }

        $response = array(
            'medicamentos' => $medicamentos,
            'subtotal' => $subtotal
        );

        $_SESSION['medicamentos'] = $medicamentosList;

        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Error en la consulta'));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' and isset($_POST['paypalFormula'])) {
    // Inicia la sesión

    $where = $_SESSION['id'];


    $query = "SELECT medicamentos.nombre, medicamentos.idmedicamento, medicamentos.precio, medicamentos.codigo, medicamentos.imagenprincipal, medicamentosformulas.CantidadMedi, (medicamentos.precio * medicamentosformulas.CantidadMedi) AS costo FROM medicamentos INNER JOIN medicamentosformulas M ON M.CodigoMedicamento = medicamentos.codigo WHERE idusuario = '$where'";
    $result = $conexion->query($query);

    if ($result) {
        $medicamentos = array();
        $subtotal = 0;
        $medicamentosList  = array();

        while ($producto = $result->fetch_assoc()) {
            $costo = $producto['precio'] * $producto['cantidadcarrito'];
            $subtotal += $costo;
            $id = $producto['idmedicamento'];
            // Agrega el producto al array $medicamentos
            $producto['costo'] = $costo;
            $medicamentosList[$id] = $producto['cantidadcarrito'];
            $medicamentos[] = $producto;
        }

        $response = array(
            'medicamentos' => $medicamentos,
            'subtotal' => $subtotal
        );

        $_SESSION['medicamentos'] = $medicamentosList;

        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Error en la consulta'));
    }
}
