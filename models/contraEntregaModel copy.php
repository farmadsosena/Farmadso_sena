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

    public function registrarContraEntrega($datos)
    {

        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $direccion = $datos['direccion'];
        $telefono = $datos['telefono'];
        $email = $datos['correo'];
        $instrucciones = $datos['instrucciones'];

        $query = "INSERT INTO invitado(nombre, apellido,direccion, telefono,correo, instrucciones) 
                  VALUES (?,?,?,?,?,?)";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssiss", $nombre, $apellido, $direccion, $telefono, $email, $instrucciones);
        $stmt->execute();
        $stmt->close();
    }



  


    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
