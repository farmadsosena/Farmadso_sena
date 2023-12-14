<?php
require_once "../config/Conexion.php";
$id_medi_masBuscado = base64_decode($_POST["id_medi_masBuscado"]);

$conexion->query("INSERT INTO medicamentos_mas_busca (id_medicamento) VALUES ('$id_medi_masBuscado')");
