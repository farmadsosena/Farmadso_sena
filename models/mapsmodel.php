<?php
// mapsmodel.php
namespace mapa;

require_once '../config/Conexion.php';

class Mapsmodel
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrarmapa($data)
    {
        $latitud = $data['latitud'];
        $longitud = $data['longitud'];
        $direction = $data['direction'];

        $query = "INSERT INTO mapa (lat,lng,direction) 
                  VALUES (?,?,?)";

        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("dds", $latitud, $longitud,$direction);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}
?>

