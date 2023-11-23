<?php
include '../config/Conexion.php';


$html = '';


$consulta = mysqli_query($conexion, "SELECT * FROM categoria");
while ($row = mysqli_fetch_assoc($consulta)) {

    $html .= "<div class='category'>
                                    <div class='nombre'>
                                        <h1>{$row['nombrecategoria']}</h1>
                                    </div>
                                    <div class='descripcion'>
                                        <h1>{$row['descripcion']}</h1>
                                    </div>
                                    <div class='buttons'>
                                        <button class='btn-editar'>Editar<i class='bx bx-pencil'></i> </button>
                                        <button class='btn-eliminar' data-delete='{$row['idcategoria']}' >Eliminar <i class='bx bx-trash'></i> </button>
                                    </div>
                                </div>";


}
;


echo $html;

?>