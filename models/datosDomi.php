<?php
require_once('../models/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar el ID enviado por AJAX
    $idDomi = $_POST['idDomi'];

    $sql = "SELECT * FROM repartidores WHERE idrepartidor = $idDomi";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $datosDomi = $resultado->fetch_assoc();
        // Asignar valores a variables
        $idrepartidor = $datosDomi['idrepartidor'];
        $nombre = $datosDomi['nombre'];
        $apellido = $datosDomi['apellido'];
        $contacto = $datosDomi['contacto'];
        $email = $datosDomi['email'];
        $documento = $datosDomi['documento'];
        $idtipodocumento = $datosDomi['idtipodocumento'];
        $direccionresidencia = $datosDomi['direccionresidencia'];
        $datosrunt = $datosDomi['datosrunt'];
        $password = $datosDomi['password'];
        $idrol = $datosDomi['idrol'];
        $fechaNacimiento = $datosDomi['fechaNacimiento'];
        $idEstado = $datosDomi['idEstado'];

        // Crear un array con los datos que deseas enviar
        $dataToSend = array(
            'idrepartidor' => $idrepartidor,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'contacto' => $contacto,
            'email' => $email,
            'documento' => $documento,
            'idtipodocumento' => $idtipodocumento,
            'direccionresidencia' => $direccionresidencia,
            'datosrunt' => $datosrunt,
            'password' => $password,
            'idrol' => $idrol,
            'fechaNacimiento' => $fechaNacimiento,
            'idEstado' => $idEstado
            // Agrega más datos según sea necesario
        );
        
        // Puedes usar el array $dataToSend como necesites
        // ...
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
}
?>
