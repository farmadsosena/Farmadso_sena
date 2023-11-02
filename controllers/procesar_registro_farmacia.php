<?php
include("../config/Conexion.php");

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['enviar'])) {
    $idusuario = $_POST["idusuario"];
    $nombreFarmacia = $_POST["Nombre"];
    $direccion = $_POST["Direccion"];
    $telefono = (int)$_POST["telefono"];
    $correo = $_POST["correo"];
    $departamento = $_POST["Departamento"];
    $ciudad = $_POST["ciudad"];
    $codigoPostal = (int)$_POST["codigoPostal"];
    $horario = $_POST["horario"];
    $epsRegistrado = $_POST["epsRegistrado"];
    $eps = $_POST["idEps"];
    $nitEps = $_POST["nitEPS"];


    if (isset($_POST['epsRegistrado'])  == "si") {
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
    } elseif (isset($_POST['epsRegistrado'])  == "no") {
        $id_eps =  1;
    }
    // Validar que la imagen se haya cargado correctamente
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $carpeta_destino = "../uploads/imgUsuario";
        $nombre_archivo = $_FILES['imagen']['name'];
        $archivo_subido = $_FILES['imagen']['tmp_name'];
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

    // Validación de números negativos en documento y teléfono
    if ($codigoPostal < 0 || $telefono < 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El código postal y el teléfono no pueden ser números negativos.'
            });
        </script>";
    } else {
        // Validación de correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El correo no es válido. Por favor, ingrese un correo válido.'
            });
        </script>";
        } else {

            // // Subir la imagen al servidor (ajusta la ubicación de la carpeta según tu configuración)
            // $uploadDir = '../uploads/imgUsuario/';
            // $imagenPath = $uploadDir . $imagen;
            // move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagenPath);


            // Insertar los datos en la base de datos
            $sql = "INSERT INTO farmacias (idusuario ,Nombre, Direccion, telefono, correo, imgfarmacia, Departamento, ciudad, codigoPostal, horario, epsRegistrado, idEps, nitEPS)
                VALUES ('$idusuario','$nombreFarmacia', '$direccion', '$telefono', '$correo', '$ruta_imagen ', '$departamento', '$ciudad', '$codigoPostal', '$horario', '$epsRegistrado', '$eps', '$nitEps')";

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
                        text: 'Error al registrar la farmacia: " . mysqli_error($conexion) . "'
                    });
                </script>";
            }
        }
    }
}
