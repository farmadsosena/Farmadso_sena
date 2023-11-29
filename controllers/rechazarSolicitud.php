<?php
include "../config/Conexion.php";


//RECHAZAR SOLICITUD DE PARTE DE FARMACEUTICO
if(isset($_POST["ids_farmacia"])){
  $id= $_POST["ids_farmacia"];
 
  $consulta= mysqli_query($conexion, "UPDATE farmacias SET EstadoSolicitud= '0' WHERE IdFarmacia= '$id'");
  if($consulta){
   $mysqli=mysqli_query($conexion, "SELECT * FROM farmacias 
   INNER JOIN usuarios ON farmacias.idusuario= usuarios.idusuario
   WHERE IdFarmacia='$id'");
   $row=mysqli_fetch_assoc($mysqli);
 
   $cuenta= "Farmaceutico";
   $mensaje=$_POST["motivo"];
   $numeroCuen= "2";
   $nombre= $row["nombre"]." ". $row["apellido"];
   $correo= $row["correo"];
 
   require_once '../services/GmailAceptar.php';
   echo "Solicitud de domiciliario aceptada";
  }else{
   echo "Hubo un error contacte con el servicio para confirmar el error";
  }
 }
 

 if(isset($_POST["id_domicc"])){
  $id= $_POST["id_domicc"];
 
  $consulta= mysqli_query($conexion, "UPDATE domiciliario SET EstadoAcept= '0' WHERE iddomiciliario= '$id'");
  if($consulta){
   $mysqli=mysqli_query($conexion, "SELECT * FROM domiciliario 
   INNER JOIN usuarios ON domiciliario.idusuario= usuarios.idusuario
   WHERE iddomiciliario='$id'");
   $row=mysqli_fetch_assoc($mysqli);
 
   $cuenta= "Farmaceutico";
   $mensaje=$_POST["motivo"];
   $numeroCuen= "2";
   $nombre= $row["nombre"]." ". $row["apellido"];
   $correo= $row["correo"];
 
   require_once '../services/GmailAceptar.php';
   echo "Solicitud de domiciliario aceptada";
  }else{
   echo "Hubo un error contacte con el servicio para confirmar el error";
  }
 }


?>