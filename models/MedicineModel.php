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

        $imagenesComa = implode (', ', $imagenesBd);


        $status = $this->medicineQuery($codigo);

        if (!$status) {
            $insertMedicine = $this->conn->query("INSERT INTO medicamentos (codigo, nombre, precio, imagenprincipal) VALUES ('$codigo', '$nombre', '$precio', '$imagenprincipal')");

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
        $query = $this->conn->query("SELECT idmedicamento FROM medicamentos WHERE codigo = '$cum' ");
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }



}