<?php
 include("../config/Conexion.php");

 $id=$_POST["id"];

 $eliminarRegistro=mysqli_query($conexion,"DELETE FROM papelera WHERE idAcceso='$id'");

 if($eliminarRegistro){
  $elimarK=mysqli_query($conexion, "DELETE FROM formulas WHERE idFormula='$id'");
  if($elimarK){
    echo "Formula eliminada totalmente";
  }
 }else{
  echo "Hubo un error, revise su conexion a internet";
 }
