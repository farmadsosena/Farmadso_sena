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
                echo "Registro con ID $id eliminado correctamente.";
            } else {
                echo "No se encontró ningún registro con ID $id.";
            }
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
