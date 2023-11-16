<?php
// DatosProductos.php

// Obtén el idMedicamento del cuerpo de la solicitud
$idMedicamento = $_POST['id'];

// Realiza tu consulta y obtén los datos necesarios
// ...

// Forma la respuesta en un array asociativo
$respuesta = array(
    'resultado' => 'Éxito',
    'datos' => $tusDatos,
);

// Convierte el array en JSON y devuelve la respuesta
echo json_encode($respuesta);
?>
