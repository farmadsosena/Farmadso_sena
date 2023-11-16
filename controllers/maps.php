<?php
require_once '../config/Conexion.php';
require_once '../models/mapsmodel.php';

use mapa\Mapsmodel;

$conexion = new Conexion();
$mapaModel = new Mapsmodel($conexion->getConexion());

$response = null; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $geocode = $_POST['geolocationData'];
    $api_key = 'AIzaSyARqXhqVZfBQNW43eJ1fHsyMdq3cUjYRS8';

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($geocode) . "&key=" . $api_key;
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status'] == 'OK' && isset($data['results'][0]['geometry']['location'])) {
        $direction = $data['results'][0]['formatted_address'];
        // Accede a los datos necesarios
        $latitud = $data['results'][0]['geometry']['location']['lat'];
        $longitud = $data['results'][0]['geometry']['location']['lng'];

        // Luego, realiza tu inserción en la base de datos con $latitud y $longitud
        $result = $mapaModel->registrarmapa([
            'latitud' => $latitud,
            'longitud' => $longitud,
            'direction' => $direction
        ]);

        $response = [
            'status' => $result ? true : false,
            'message' => $result ? 'Registro exitoso.' : 'Ocurrió un problema',
            'data' => $result ? [
                'formattedAddress' => $direction,
                'latitude' => $latitud,
                'longitude' => $longitud
            ] : null
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Error en la geocodificación: ' . $data['status']
        ];
    }
} else {
    // Puedes definir un valor predeterminado si no hay datos para guardar
    $response = [
        'status' => false,
        'message' => 'No se recibieron datos para guardar.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $geocode = $_POST['geolocationData'];
    $api_key = 'AIzaSyARqXhqVZfBQNW43eJ1fHsyMdq3cUjYRS8';

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($geocode) . "&key=" . $api_key;
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['status'] == 'OK' && isset($data['results'][0]['geometry']['location'])) {
        $direction = $data['results'][0]['formatted_address'];
        // Accede a los datos necesarios
        $latitud = $data['results'][0]['geometry']['location']['lat'];
        $longitud = $data['results'][0]['geometry']['location']['lng'];

        // Luego, realiza tu inserción en la base de datos con $latitud y $longitud
        $result = $mapaModel->registrarmapa([
            'latitud' => $latitud,
            'longitud' => $longitud,
            'direction' => $direction
        ]);

        $response = [
            'status' => $result ? true : false,
            'message' => $result ? 'Registro exitoso.' : 'Ocurrió un problema',
            'data' => $result ? [
                'formattedAddress' => $direction,
                'latitude' => $latitud,
                'longitude' => $longitud
            ] : null
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Error en la geocodificación: ' . $data['status']
        ];
    }
} else {
    // Puedes definir un valor predeterminado si no hay datos para guardar
    $response = [
        'status' => false,
        'message' => 'No se recibieron datos para guardar.'
    ];
}




?>
