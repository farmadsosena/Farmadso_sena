<?php
session_start();
$id = $_SESSION["id"];

include("../config/conexion.php");

$html = '';


$consulta = mysqli_query($conexion, "SELECT * FROM formulas WHERE idPaciente = '$id' and Estado = 1");

if ($consulta->num_rows > 0) {
    while ($card = mysqli_fetch_assoc($consulta)) {
        $IdMedico = $card['IdMedico'];
        $IdDiag = $card['idDiagnostico'];
        $fecha = $card['fechaOrden'];

        $fecha_timestamp = strtotime($fecha);
        if ($fecha_timestamp !== false) {
            $fecha_formateada = date("j F Y", $fecha_timestamp);
        }

        // Consulta Medico
        $doc = mysqli_query($conexion, "SELECT * FROM medicos WHERE idmedico = $IdMedico");
        $user_doc = mysqli_fetch_assoc($doc);
        $id_medico = $user_doc['idusuario'];


        $cons_med = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = $id_medico");
        $row = mysqli_fetch_assoc($cons_med);
        $name_med = $row["nombre"];
        $lastname = $row['apellido'];

        // Consulta Diagnostico
        $diagnostico = mysqli_query($conexion, "SELECT * FROM diagnosticos WHERE idDiag = $IdDiag");
        $di = mysqli_fetch_assoc($diagnostico);
        $name_di = $di['nombreDiag'];

        $html .= "<div class='card'  data-medico='{$IdMedico}'  data-id='{$card['idFormula']}' data-informacion='$name_di'>
        <div class='firts_line'>
            <div class='date-card'>
                <p>$fecha_formateada</p>
            </div>

            <div class='state-card'>
                Entregado
            </div>
        </div>

        <div class='second-line' data-medico='{$IdMedico}'>
            <h3 class='title_card'>$name_di</h3>
            <div class='doc'>
                <p class='profesion'>Profesional de la salud</p>
                <p class='name_doc'>" . $row['nombre'] . ' ' . $row['apellido'] . "</p>
            </div>
            <div class='eps'></div>
            <div class='opt-card'></div>
        </div>

        <div class='third-line'>Descargar
            <img class='open_menu ' onclick='agregarClase()'  src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAATlJREFUSEudVdsWwyAIw///6O54qQRIqmd92DqHJoSAzf55mpk942Pvxl/5PQbFfQ5fDm3W7AGINzQBfyEnkgkspl54rYX+RZ+vDS6MmcFBjNAEILL40n5Lgrc2aoAAhKrIgCK64PPvjkBqEPmKIEKrVHRlIFi/ck0AdIjSdAGAdFOig8ZXEhGHeh8QcogJAKrSyu/af65mW4XSsmAVgzu794jTCmooMt+ANg1ZVnmJliFI2W7RShkQFy0ANBy4aPlXN90ngJKrZnDRmdWcsYgyA5xmta9q25ZkcWHLlevOdJxnF4kGicO8mBIVWQqVHsNnEQn1M3sP0TuJzno+TdUsgiFyATFCBoBbHW0a08jJ7l2u6UFYNSWK3pcSlYF5N1pGvqLRDhc69cBrsyxXvjIVO5SF+J3fDc1+swO8Ib35RvAAAAAASUVORK5CYII=' />
        </div>
        <div class='menu_card ' >
            <ul>
                <li class='open' >Abrir</li>
                <li class='delete' onclick='eliminarFormula()' data-delete='{$card['idFormula']}'>Eliminar</li>
            </ul>
        </div>
    </div>";
    }


} else {
    // Pendiente por colocar una mejor presentación para cuando 
    // no se encuentren formulas
    echo "No hay formulas";
}


echo $html;
?>