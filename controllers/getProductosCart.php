<?php
include('../config/Conexion.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_start();
    $_SESSION['id'] = 1;
    $where = '';
    if (isset($_SESSION['id'])) {
        $where = 'idusuario =' . $_SESSION['id'];
    } else if (isset($_SESSION['idinvitado'])) {
        $where = 'idinvitado =' . $_SESSION['idinvitado'];
    } else {
        $where = '';
    }

    $data = $conexion->query("SELECT *  FROM carrito $where");
    $dataAll = array();
    while ($productos  =  $data->fetch_assoc()) {
        $dataAll[] = $productos;
    }
    echo json_encode($dataAll);
}
