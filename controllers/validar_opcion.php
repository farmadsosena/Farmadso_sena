<?php
// validar_opcion.php

// Obtén la opción seleccionada del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$selectedOption = $data['selectedOption'];

// Realiza la validación en el servidor
$allowedOptions = ['Domiciliario', 'Farmaceutico', 'Cuenta de usuario'];

if (in_array($selectedOption, $allowedOptions)) {
  // Opción válida, redirige según la opción
  switch ($selectedOption) {
    case 'Domiciliario':
      echo json_encode(['redirect' => '../views/domiciliario.php']);
      break;
    case 'Farmaceutico':
      echo json_encode(['redirect' => '../views/PanelAdmin.php']);
      break;
    case 'Cuenta de usuario':
      echo json_encode(['redirect' => '../views/Usuario.php']);
      break;
  }
} else {
  // Opción no válida, manejar el error según sea necesario
  echo json_encode(['error' => 'Opción no válida']);
}
?>
