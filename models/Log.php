<?php

require_once '../config/conexion.php';



class Log
{

    private $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion;
    }
    public static function getIp()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    public static function typeDispositive(){
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {

            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            $ip = $_SERVER['REMOTE_ADDR'];

            if (strpos($userAgent, 'Mobile') !== false) {
                return 'Dispositivo movil';
            } elseif (strpos($userAgent, 'Tablet') !== false) {
                return 'Tableta';
            } else {
                return 'Computadora';
            }
        }
    }

    public function insert($consulta)
    {

        $nivel = $consulta['nivel'];
        $mensaje = $consulta['mensaje'];
        $id_usuario = $consulta['id_usuario'];
        $ip = $consulta['ip'];
        $tipo = $consulta['tipo'];
        $insertar = $this->conexion->Getconexion()->query("INSERT INTO historial
        (fecha, nivel, mensaje, id_usuario, ip, tipo_dispositivo) VALUES
        (NOW(), '$nivel', '$mensaje', '$id_usuario', '$ip', '$tipo')
        ");
        if ($insertar) {
            return true;
        } else {
            return false;
        }
    }
}




?>