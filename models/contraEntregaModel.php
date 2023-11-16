<?php
// ContraEntregaModel.php
namespace contraentrega;

require_once '../config/Conexion.php';

class ContraEntregaModel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrarContraEntrega($datos, $data)
    {
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        
        $codigoPostal = $datos['codigo_postal'];
        $telefono = $datos['telefono'];
        $email = $datos['correo'];
        $instrucciones = $datos['instrucciones'];
        $latitud = $data['results'][0]['geometry']['location']['lat'];
        $longitud = $data['results'][0]['geometry']['location']['lng'];

        $direccion = $latitud and $longitud;

        $query = "INSERT INTO compras (nombre, apellido, telefono, direccion, codigopostal, correo, instrucciones) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssisiss", $nombre, $apellido, $telefono, $direccion,  $codigoPostal, $email, $instrucciones);
        $stmt->execute();
        $stmt->close();
    }
}
