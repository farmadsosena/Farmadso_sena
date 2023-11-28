<?php
include '../config/conexion.php';

if (isset( $_POST['idCategoria'])) {
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
        echo json_encode(['success' => true, 'data' => ['id' => $id,'Nombre' => $Nombre, 'descripcion' => $descripcion, 'img' => $img]]);
        exit();
    } else {
        // Si no hay resultados para el ID proporcionado, devolver un mensaje de error en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'No se encontraron datos para el ID proporcionado.']);
        exit();
    }
}


if(isset($_POST['enviar'])){

    $idCategoria = $_POST['number999'];
    $nuevoNombre = $_POST['nombrecategoria'];
    $nuevaDescripcion = $_POST['descripcioncategoria'];

    // Procesar la imagen
    $nombreArchivo = $_FILES['imgCategory']['name'];
    $tipoArchivo = $_FILES['imgCategory']['type'];
    $tamañoArchivo = $_FILES['imgCategory']['size'];
    $archivoTemporal = $_FILES['imgCategory']['tmp_name'];

    // Verificar si el archivo es una imagen
    $permitidos = array("image/jpeg", "image/jpg", "image/png");

    if (in_array($tipoArchivo, $permitidos)) {
        // Mover el archivo temporal a una ubicación permanente
        $rutaDestino = "../assets/img/"; // Ajusta la ruta según tus necesidades
        $rutaFinal = $rutaDestino . $nombreArchivo;

        move_uploaded_file($archivoTemporal, $rutaFinal);

        // Realizar la actualización en la base de datos
        $query = "UPDATE categoria SET nombrecategoria = ?, descripcion = ?, imgCategoria = ? WHERE idcategoria = ?";
        $stmt = $conexion->prepare($query);

        // Vincular los parámetros
        $stmt->bind_param("sssi", $nuevoNombre, $nuevaDescripcion, $nombreArchivo, $idCategoria);

        // Ejecutar la consulta
        $ejecuta = $stmt->execute();

        // Cerrar la conexión
        $stmt->close();
        $conexion->close();

        // Devolver una respuesta JSON indicando el éxito o fallo de la actualización
        header('Content-Type: application/json');
        echo json_encode(['success' => $ejecuta]);
        exit();
    } else {
        // Si el archivo no es una imagen, devolver un mensaje de error en formato JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'El archivo no es una imagen válida.']);
        exit();
    }
}
?>
