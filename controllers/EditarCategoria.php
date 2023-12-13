<?php
include '../config/conexion.php';
require_once '../models/Log.php';

// Verificar la existencia de la variable de sesión
session_start();
if (!isset($_SESSION['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'No hay sesión activa.']);
    exit();
}

// Verificar la existencia de datos POST
if (isset($_POST['idCategoria'])) {
    $idCategoria = $_POST['idCategoria'];

    $consulta = mysqli_query($conexion, "SELECT * FROM categoria WHERE idcategoria = $idCategoria");

    if (mysqli_num_rows($consulta) > 0) {
        $row = mysqli_fetch_assoc($consulta);

        $Nombre = $row['nombrecategoria'];
        $descripcion = $row['descripcion'];
        $img = $row['imgCategoria'];
        $id = $row['idcategoria'];

        // Devolver los datos en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => ['id' => $id, 'Nombre' => $Nombre, 'descripcion' => $descripcion, 'img' => $img]]);
        exit();
    } else {
        // Si no hay resultados para el ID proporcionado, devolver un mensaje de error en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'No se encontraron datos para el ID proporcionado.']);
        exit();
    }
} else if (isset($_POST['number999'])) {
    // Obtener datos del formulario
    $idCategoria = $_POST['number999'];
    $nuevoNombre = $_POST['editcategoria'];
    $nuevaDescripcion = $_POST['descripcion'];

    // Verificar si se cargó una nueva imagen
    $nombreArchivo = null;
    if (!empty($_FILES['imgCategory']['name'])) {
        $nombreArchivo = $_FILES['imgCategory']['name'];
        $tipoArchivo = $_FILES['imgCategory']['type'];
        $archivoTemporal = $_FILES['imgCategory']['tmp_name'];

        // Verificar si el archivo es una imagen
        $permitidos = ["image/jpeg", "image/jpg", "image/png"];
        if (!in_array($tipoArchivo, $permitidos)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'El archivo no es una imagen válida.']);
            exit();
        }

        // Obtener el nombre de la imagen anterior
        $consulta_select = mysqli_query($conexion, "SELECT imgCategoria FROM categoria WHERE idcategoria = $idCategoria");
        $row_select = mysqli_fetch_assoc($consulta_select);
        $imagen_anterior = $row_select['imgCategoria'];

        // Eliminar el archivo anterior si existe
        if ($imagen_anterior != null && file_exists("../assets/img/" . $imagen_anterior)) {
            unlink("../assets/img/" . $imagen_anterior);
        }

        // Mover el archivo temporal a una ubicación permanente
        $rutaDestino = "../assets/img/";
        $rutaFinal = $rutaDestino . $nombreArchivo;
        move_uploaded_file($archivoTemporal, $rutaFinal);
    }

    // Realizar la actualización en la base de datos
    $query = "UPDATE categoria SET nombrecategoria = ?, descripcion = ?";
    
    // Si se proporcionó un nuevo nombre de archivo, agregar la columna imgCategoria a la actualización
    if ($nombreArchivo !== null) {
        $query .= ", imgCategoria = ?";
    }

    $query .= " WHERE idcategoria = ?";
    
    $stmt = $conexion->prepare($query);

    // Vincular los parámetros
    if ($nombreArchivo !== null) {
        $stmt->bind_param("sss", $nuevoNombre, $nuevaDescripcion, $nombreArchivo, $idCategoria);
    } else {
        $stmt->bind_param("ssi", $nuevoNombre, $nuevaDescripcion, $idCategoria);
    }

    // Ejecutar la consulta
    $ejecuta = $stmt->execute();

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();

    // Devolver una respuesta JSON indicando el éxito o fallo de la actualización
    header('Content-Type: application/json');
    echo json_encode(['success' => $ejecuta]);

    // Ajustar el mensaje LOG del cambio realizado
    $log = new Log();
    $ip = $log::getIp();
    $type = $log::typeDispositive();
    $info = [
        'nivel' => $ejecuta ? 'INFO' : 'ERROR',
        'mensaje' => $ejecuta ? "Se ha editado la categoría ($nuevoNombre)" : "Error al editar la categoría",
        'ip' => $ip,
        'id_usuario' => $_SESSION['id'],
        'tipo' => $type 
    ];
    $resultt = $log->insert($info);

    exit();
}
?>
