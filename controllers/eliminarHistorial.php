<?php
session_start();

require_once '../config/Conexion.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtiene el ID de la sesión
    $id = $_SESSION["id"];

    // Realiza la consulta para eliminar el registro específico de la tabla 'historial'
    $query = "DELETE FROM historial WHERE id_usuario = ?";
    
    // Prepara la declaración y maneja errores
    if ($stmt = $conexion->prepare($query)) {
        // Vincula los parámetros
        $stmt->bind_param("i", $id);
        
        // Ejecuta la consulta y maneja errores
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo'
                <style>
                
            .loader-container {
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
                height: 100%;
                flex-direction: column;
                text-align: center;
            }
            
            .loader {
                border: 8px solid #f3f3f3;
                border-top: 8px solid #3498db;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1s linear infinite;
                margin: 20px auto;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
                </style>
                <div class="loader-container">
                <div class="loader"></div>
                <p>Vaciando historial...</p>
            </div>';
            
                header("Location: ../views/panelAdmin.php");
                exit();
     

            } else {   echo'
                <style>
                
            .loader-container {
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
                height: 100%;
                flex-direction: column;
                text-align: center;
            }
            
            .loader {
                border: 8px solid #f3f3f3;
                border-top: 8px solid #3498db;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1s linear infinite;
                margin: 20px auto;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
                </style>
                <div class="loader-container">
                <div class="loader"></div>
                <p>Buscando posibles registros...</p>
            </div>';
                echo "No se encontró ningún registro con ID $id.";
            }
            header("Location: ../views/panelAdmin.php");
                exit();
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }

    // Cierra la conexión a la base de datos
    $conexion->close();
}
?>
