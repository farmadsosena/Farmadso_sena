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
    // registrar datos invitado
    public function registrarContraEntrega($datos, $idUsuario)
    {
        $nombre = $datos['nombre'];
        $apellido = $datos['apellido'];
        $direccion = $datos['direccion'];
        $telefono = $datos['telefono'];
        $email = $datos['correo'];
        $instrucciones = $datos['instrucciones'];
        
        if ($idUsuario) {
            $query = "INSERT INTO invitado (nombre, apellido, telefono, direccion, correo, instrucciones) 
                  VALUES (?,?,?,?,?,?)";
        } else {
            $query = "INSERT INTO usuarios (nombre, apellido, telefono, direccion, correo, instrucciones) 
                  VALUES (?,?,?,?,?,?)";
        }

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("ssisss", $nombre, $apellido, $telefono, $direccion, $email, $instrucciones);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function obtenerCarritoUsuario($idUsuario)
    {
        session_start(); // Iniciar la sesión
        if (!isset($_SESSION['carrito']) || $_SESSION['idusuario'] !== $idUsuario) {
            $_SESSION['idusuario'] = $idUsuario;
            $_SESSION['carrito'] = array();
        }
        return $_SESSION['carrito'];
    }
    public function obtenerCarritoInvitado($idInvitado)
    {
        session_start();
        if (!isset($_SESSION['carrito']) || $_SESSION['id_invitado'] !== $idInvitado) {
            $_SESSION['id_invitado'] = $idInvitado;
            $_SESSION['carrito'] = array();
        }
        return $_SESSION['carrito'];
    }

    public function consultar($consultardatos)
    {
        $consultardatos = mysqli_real_escape_string($this->conexion, $consultardatos);
        $query = $this->conexion->query("SELECT idusuario FROM usuarios WHERE idusuario = '$consultardatos' ");
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
