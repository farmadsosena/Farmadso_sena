<?php
include("../config/Conexion.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idusuario = $_POST["idusuario"];
    $nombreFarmacia = $_POST["Nombref"];
    $direccion = $_POST["Direccionf"];
    $departamento = $_POST["departamentof"];
    $ciudad = $_POST["ciudadf"];
    $horario = $_POST["horariof"];
    $eps = $_POST["idEpsf"];
    $nitEps = $_POST["nitEPS"];
    $codigoPostal = $_POST["codigoPostalf"];
    $telefono = (int)$_POST["telefonof"];
    $correo = $_POST["correof"];
    $epsregustrado = $_POST["epsRegistradof"];
    $id_Epsf = $_POST["idEpsf"];
    $estado = 1;


    //Consultar si hay mas d eun registro del mismo usuario
    $consulta= mysqli_query($conexion,"SELECT * FROM farmacias WHERE idusuario= '$idusuario' and EstadoSolicitud='1'");

    if(mysqli_num_rows($consulta) > 0){
        echo "<script> 
        alert('Usted ya hizo una solicitud para pedir ser una farmacia, por tanto tiene que esperar la respuesta por su correo')
        window.location= '../views/Usuario.php'
        </script>";
        exit; // Detener la ejecución del código si hay un error al guardar la imagen
    }

    if($epsregustrado == "no"){
        $id_Epsf =1;
    }

    // Validar que la imagen se haya cargado correctamente
    if ($_FILES['imagenf']['error'] === UPLOAD_ERR_OK) {
        $carpeta_destino = "../uploads/imgUsuario/";
        $nombre_archivo = $_FILES['imagenf']['name'];
        $archivo_subido = $_FILES['imagenf']['tmp_name'];
        $ruta_archivo = $carpeta_destino . $nombre_archivo;

        if (move_uploaded_file($archivo_subido, $ruta_archivo)) {
            $ruta_imagen = $ruta_archivo;
        } else {
            echo "<div class='alert error'>Ha ocurrido un error al guardar la imagen. Por favor, inténtelo de nuevo.</div>";
            exit; // Detener la ejecución del código si hay un error al guardar la imagen
        }
    } else {
        echo "<div class='alert error'>Error al cargar la imagen. Por favor, inténtelo de nuevo.</div>";
        exit; // Detener la ejecución del código si hay un error al cargar la imagen
    }

    if ($_POST["codigoPostalf"] < 0 || $_POST["telefonof"] < 0) {
        echo "<script>
            alert('El código postal y el teléfono no pueden ser números negativos.');
            window.history.back();
        </>";
    } elseif (!filter_var($_POST['correof'], FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('El correo no es válido. Por favor, ingrese un correo válido.');
        </script>";
    } else {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO farmacias (idusuario,Nombre, Direccion, telefono, correo, imgfarmacia, Departamento, ciudad, codigoPostal, horario,  IdEps, nitEPS, EstadoSolicitud) VALUES ('$idusuario','$nombreFarmacia', '$direccion', '$telefono', '$correo', '$ruta_imagen','$departamento','$ciudad','$codigoPostal', '$horario', '$id_Epsf', '$nitEps', '$estado')";

        if ($conexion->query($sql) === TRUE) {
            echo "<script>
                alert('Registro exitoso');
                window.location.href = '../views/Usuario.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar la farmacia: " . "');
            </script>";
        }
    }
}
