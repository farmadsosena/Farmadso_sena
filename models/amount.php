<?php
function consultarMonto(){

  $monto = 103000;
  $state = true;
  $data = array(
    'state' => $state,
    'amount' =>  $monto
  );

  echo json_encode ($data);
}

consultarMonto();

