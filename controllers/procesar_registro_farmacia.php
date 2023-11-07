<?php
include("../config/Conexion.php");

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idusuario      = $_POST["idusuario"];
    $nombreFarmacia = $_POST["Nombref"];
    $direccion      = $_POST["Direccionf"];
    $departamento = $_POST["departamentof"];
    $ciudad = $_POST["ciudadf"];
    $horario = $_POST["horariof"];
    $eps = $_POST["idEpsf"];
    $nitEps = $_POST["nitEPS"];
    $codigoPostal = $_POST["codigoPostalf"];
    $telefono = (int)$_POST["telefonof"];
    $correo = $_POST["correof"];

    if (isset($_POST['epsRegistradof'])  == "si") {
        $stmt_get_user_id = $conexion->prepare("SELECT idEps FROM eps WHERE ideps = ?");
        $stmt_get_user_id->bind_param("i", $eps);
        $stmt_get_user_id->execute();
        $result_user_id = $stmt_get_user_id->get_result();
        if ($result_user_id->num_rows === 1) {
            $row_user_id = $result_user_id->fetch_assoc();
            $id_eps = $row_user_id['idEps'];
        } else {
            $response['error'] = 'no encontrado';
        }
    } elseif (isset($_POST['epsRegistradof'])  == "no") {
        $id_eps =  1;
    }
}

// Validar que la imagen se haya cargado correctamente
if ($_FILES['imagenf']['error'] === UPLOAD_ERR_OK) {
    $carpeta_destino = "../uploads/imgUsuario";
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
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El código postal y el teléfono no pueden ser números negativos.'
            });
        </script>";
} else {
    // Validación de correo
    if (!filter_var($_POST ['correof'], FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El correo no es válido. Por favor, ingrese un correo válido.'
            });
        </script>";
    
    } else {



        // Insertar los datos en la base de datos
        $sql = "INSERT INTO farmacias (idusuario ,Nombre, Direccion, telefono, correo, imgfarmacia, Departamento, ciudad, codigoPostal, horario, idEps, nitEPS) VALUES ('$idusuario','$nombreFarmacia', '$direccion', '$telefono', '$correo', '$ruta_imagen ','$departamento','$ciudad','$codigoPostal', '$horario', '$id_eps', '$nitEps')";

        if ($conexion->query($sql) === TRUE) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Registro exitoso'
            });
        </script>";
            header("location: ../views/Usuario.php");
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al registrar la farmacia: 
            });
        </script>";
        }
    }
}
