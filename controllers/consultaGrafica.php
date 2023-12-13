<?php
require_once '../config/Conexion.php';
session_start();
$bd = new Conexion();
$conn = $bd->getConexion();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el id de farmacia de la sesión
$idFarmacia = $_SESSION["farm"];

// Calcular fechas dinámicas basadas en la fecha actual
$fechaActual = date('Y-m-d');
$primerDiaMesActual = date('Y-m-01');

// Consulta para obtener los productos vendidos semanalmente con precios y subtotal
$sqlSemanal = "
    SELECT YEARWEEK(c.fecha) AS semana,
           dc.idmedicamento,
           m.nombre AS nombre_medicamento,
           SUM(dc.cantidad) AS total_vendido,
           m.precio AS precio_unitario,
           SUM(dc.cantidad * m.precio) AS subtotal
    FROM compra c
    JOIN detallecompra dc ON c.idcompra = dc.idcompra
    JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
    WHERE c.fecha >= '$primerDiaMesActual'
    AND m.idfarmacia = $idFarmacia
    GROUP BY semana, dc.idmedicamento
    ORDER BY semana, total_vendido DESC;
";

// Consulta para obtener los productos vendidos mensualmente con precios y subtotal
$sqlMensual = "
    SELECT DATE_FORMAT(c.fecha, '%Y-%m') AS mes,
           dc.idmedicamento,
           m.nombre AS nombre_medicamento,
           SUM(dc.cantidad) AS total_vendido,
           m.precio AS precio_unitario,
           SUM(dc.cantidad * m.precio) AS subtotal
    FROM compra c
    JOIN detallecompra dc ON c.idcompra = dc.idcompra
    JOIN medicamentos m ON dc.idmedicamento = m.idmedicamento
    WHERE c.fecha >= '$primerDiaMesActual'
    AND m.idfarmacia = $idFarmacia
    GROUP BY mes, dc.idmedicamento
    ORDER BY mes, total_vendido DESC;
";

$resultSemanal = $conn->query($sqlSemanal);

if (!$resultSemanal) {
    die("Error en la consulta semanal: " . $conn->error);
}

$data['semanal'] = array();

while ($row = $resultSemanal->fetch_assoc()) {
    $data['semanal'][] = $row;
}

// Suma total de subtotales semanales
$totalGeneralSemanal = array_sum(array_column($data['semanal'], 'subtotal'));

// Agregar el total general de ganancias semanales al resultado
$data['total_general_semanal'] = $totalGeneralSemanal;

$resultMensual = $conn->query($sqlMensual);

if (!$resultMensual) {
    die("Error en la consulta mensual: " . $conn->error);
}

$data['mensual'] = array();

while ($row = $resultMensual->fetch_assoc()) {
    $data['mensual'][] = $row;
}

// Suma total de subtotales mensuales
$totalGeneralMensual = array_sum(array_column($data['mensual'], 'subtotal'));

// Agregar el total general de ganancias mensuales al resultado
$data['total_general_mensual'] = $totalGeneralMensual;

$conn->close();

// Configuración de encabezado para permitir CORS (puedes ajustar esto según tus necesidades)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Devuelve los datos como JSON
echo json_encode($data);
?>
