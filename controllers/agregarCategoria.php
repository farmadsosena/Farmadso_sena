<?php
require_once '../config/Conexion.php';
require_once '../models/Log.php';
session_start();


// ESO DEBE IR DENTRO DE EL CUMPLIMIENTO TOTAL DE LA CONSULTA (guarda backlog de cambio realizado o agregamiento jijija de categoria miking)

        //    $ip = $log::getIp();
        // $type = $log::typeDispositive();
        // $info = array(
        //     'nivel' => 'SUCCESS',   
        //     'mensaje' => "Se ha registrado un nuevo medicamento con el nombre  " . $medicine['nombre']  . " ",
        //     'ip' => $ip,
        //     'id_usuario' => $_SESSION['id'],
        //     'tipo' => $type 
        // );
        // $resultt = $log->insert($info);

      
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si todos los campos necesarios están presentes
            if (isset($_POST['nombrecategoria']) && isset($_POST['descripcion']) && isset($_FILES['imgCategory'])) {
                // Recuperar los valores del formulario
                $nombreCategoria = $_POST['nombrecategoria'];
                $descripcion = $_POST['descripcion'];
                $Estado = 1;
                // Procesar la imagen
                $nombreArchivo = $_FILES['imgCategory']['name'];
                $tipoArchivo = $_FILES['imgCategory']['type'];
                $tamañoArchivo = $_FILES['imgCategory']['size'];
                $archivoTemporal = $_FILES['imgCategory']['tmp_name'];
        
                // Verificar si el archivo es una imagen
                $permitidos = array("image/jpeg", "image/jpg", "image/png");
                if (in_array($tipoArchivo, $permitidos)) {
                    // Mover el archivo temporal a una ubicación permanente
                    $NombreImg = $nombreArchivo; // Ajusta la carpeta de destino según tus necesidades
                  
        
                    // Aquí puedes realizar la inserción en la base de datos o realizar otras acciones según tus necesidades
                    // Por ejemplo, puedes utilizar una conexión a la base de datos y ejecutar una consulta INSERT
        
                    
                    $query = "INSERT INTO categoria (nombrecategoria, descripcion, imgCategoria, Estado) VALUES (?, ?, ?, ?)";
                    $stmt = $conexion->prepare($query);
                    
                    // Vincular los parámetros
                    $stmt->bind_param("sssi", $nombreCategoria, $descripcion, $NombreImg, $Estado);
            
                    // Ejecutar la consulta
                    $ejecuta = $stmt->execute();
            
                    // Cerrar la conexión
                    $stmt->close();
                    $conexion->close();
            
                    // Si todo se realiza correctamente, puedes redirigir a una página de éxito
                    header('Content-Type: application/json');
                    if ($ejecuta) {
                        echo json_encode(['success' => $ejecuta]);
                        exit();
                    } else {
                        echo "Error al ejecutar la consulta: " . $stmt->error;
                    }
                } else {
                    // Si el archivo no es una imagen, puedes manejar el error de alguna manera
                    echo "Error: El archivo no es una imagen válida.";
                }
            } else {
                // Si no se han proporcionado todos los campos necesarios, puedes manejar el error de alguna manera
                echo "Error: Todos los campos son obligatorios.";
            }
        } else {
            // Si no se ha enviado el formulario de manera adecuada, puedes manejar el error de alguna manera
            echo "Error: Acceso no permitido.";
        }
        ?>
        

   
     