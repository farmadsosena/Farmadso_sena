<?php 
// ContraEntregaModel.php
namespace contraentrega;

require_once '../config/Conexion.php';

class ContraEntregaModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarContraEntrega($datos) {
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $direccion = $datos['direccion'];
        $ciudad = $datos['ciudad'];
        $codigoPostal = $datos['codigo_postal'];
        $telefono = $datos['telefono'];
        $email = $datos['correo'];
        $instrucciones = $datos['instrucciones'];

        $query = "INSERT INTO compras (nombre, apellido, telefono, direccion, ciudad, codigopostal, correo, instrucciones) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssississ", $nombre, $apellido, $telefono, $direccion, $ciudad, $codigoPostal, $email, $instrucciones);
        $stmt->execute();
        $stmt->close();
    }
}




?>