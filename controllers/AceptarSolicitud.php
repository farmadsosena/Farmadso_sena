<?php
include "../config/Conexion.php";

if(isset($_POST["id"])){
 $id= $_POST["id"];

 $consulta= mysqli_query($conexion, "UPDATE farmacias SET EstadoSolicitud= '2' WHERE IdFarmacia= '$id'");
 if($consulta){
  $mysqli=mysqli_query($conexion, "SELECT * FROM farmacias 
  INNER JOIN usuarios ON farmacias.idusuario= usuarios.idusuario
  WHERE IdFarmacia='$id'");
  $row=mysqli_fetch_assoc($mysqli);

  $cuenta= "Farmaceutico";
  $numeroCuen= "1";
  $nombre= $row["nombre"]." ". $row["apellido"];
  $correo= $row["correo"];

  require_once '../services/GmailAceptar.php';
  echo "Solicitud de farmaceutico aceptada";
 }else{
  echo "Hubo un error contacte con el servicio para confirmar el error";
 }
}


if(isset($_POST["id_domiciliario"])){
  $id= $_POST["id_domiciliario"];
 
  $consulta= mysqli_query($conexion, "UPDATE domiciliario SET EstadoAcept= '2' WHERE iddomiciliario= '$id'");
  if($consulta){
   $mysqli=mysqli_query($conexion, "SELECT * FROM domiciliario 
   INNER JOIN usuarios ON domiciliario.idusuario= usuarios.idusuario
   WHERE iddomiciliario='$id'");
   $row=mysqli_fetch_assoc($mysqli);
 
   $cuenta= "Domiciliario";
   $numeroCuen= "1";
   $nombre= $row["nombre"]." ". $row["apellido"];
   $correo= $row["correo"];
 
   require_once '../services/GmailAceptar.php';
   echo "Solicitud de domiciliario aceptada";
  }else{
   echo "Hubo un error contacte con el servicio para confirmar el error";
  }
 }

?>