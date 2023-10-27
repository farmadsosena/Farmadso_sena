<?php
function consultarMonto(){

  $monto = 75500;
  $state = true;
  $data = array(
    'state' => $state,
    'amount' =>  $monto
  );

  echo json_encode ($data);
}

consultarMonto();

