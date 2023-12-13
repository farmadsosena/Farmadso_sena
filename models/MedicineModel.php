<?php

namespace modeloMedicina;

class MedicineModel
{
    public $conn = null;
    public function __construct($conexion)
    {
        $this->conn = $conexion;
    }


    public function medicineInsert($medicine, $imagenesBd)
    {

        $codigo = $medicine['codigo'];
        $nombre = $medicine['nombre'];
        $imagenprincipal = $imagenesBd[0];
        $descripcion = $medicine['descripcion'];
        $precio = $medicine['precio'];
        $fechavencimiento = $medicine['fechavencimiento'];
        $instrucciones = $medicine['instrucciones'];
        $lote = $medicine['lote'];
        $idcategoria = $medicine['idcategoria'];
        $idproveedor = $medicine['idproveedor'];
        $idpromocion = $medicine['idpromocion'];
        $formaadministracion = $medicine['administracion'];
        $idpromocion = $medicine['idpromocion'];
        $stock = $medicine['stock'];
        $idFramacia= $_SESSION["farm"];

        $imagenesComa = implode (', ', $imagenesBd);



        $status = $this->medicineQuery($codigo);

        if (!$status) {
            $insertMedicine = $this->conn->query("INSERT INTO medicamentos (codigo, nombre, precio, imagenprincipal,idfarmacia) VALUES ('$codigo', '$nombre', '$precio', '$imagenprincipal','$idFramacia')");

            if ($insertMedicine) {

                $idMedicine = $this->conn->insert_id;

                $this->conn->query("INSERT INTO inventario(idmedicamento, descripcion, fechavencimiento, instrucciones, lote,stock, idcategoria, idprovedor, idpromocion, formaadministracion,  imagendescrip) 
                VALUES ('$idMedicine', '$descripcion','$fechavencimiento','$instrucciones','$lote',  '$stock', '$idcategoria','$idproveedor','$idpromocion', '$formaadministracion', '$imagenesComa' )");

                // Insertar en inventario los demas campos

                return true;
            } else {
                // Manejo de errores si la inserción falla
                echo "Error en la inserción: " . $this->conn->error;
            }
        } else {
            return null;
        }


    }


    public function medicineQuery($cum)
    {
        $cum = mysqli_real_escape_string($this->conn, $cum);
        $query = $this->conn->query("SELECT idmedicamento FROM medicamentos WHERE codigo = '$cum'");
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function medicineUpdate($idMedicamento, $medicamentos, $inventario) {
        $idMedicamento = mysqli_real_escape_string($this->conn, $idMedicamento);
    
        $codigo  = mysqli_real_escape_string($this->conn, $medicamentos['codigo']);
        $nombre  = mysqli_real_escape_string($this->conn, $medicamentos['nombre']);
        $precio  = mysqli_real_escape_string($this->conn, $medicamentos['precio']);
    
        $insertMedicine = $this->conn->query("UPDATE medicamentos SET codigo = '$codigo', nombre ='$nombre', precio = '$precio' WHERE idmedicamento = '$idMedicamento' ");
    
        $descripcion  = mysqli_real_escape_string($this->conn, $inventario['descripcion']);
        $fechavencimiento = mysqli_real_escape_string($this->conn, $inventario['fechavencimiento']);
        $instrucciones = mysqli_real_escape_string($this->conn, $inventario['instrucciones']);
        $lote = mysqli_real_escape_string($this->conn, $inventario['lote']);
        $stock  = mysqli_real_escape_string($this->conn, $inventario['stock']);
        $idcategoria  = mysqli_real_escape_string($this->conn, $inventario['idcategoria']);
        $idprovedor  = mysqli_real_escape_string($this->conn, $inventario['idprovedor']);
        $formaadministracion  = mysqli_real_escape_string($this->conn, $inventario['formaadministracion']);
    
        $updateInventario = $this->conn->query("UPDATE inventario SET descripcion = '$descripcion', fechavencimiento = '$fechavencimiento', instrucciones = '$instrucciones', lote = '$lote', stock = '$stock', idcategoria ='$idcategoria', idprovedor = '$idprovedor', formaadministracion = '$formaadministracion' WHERE idmedicamento = '$idMedicamento'");
    
        if ($insertMedicine && $updateInventario) {
            return true;
        } else {
            return false;
        }
    }
    

}