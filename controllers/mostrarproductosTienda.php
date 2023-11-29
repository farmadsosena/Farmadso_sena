<?php
include('../config/Conexion.php');

$sql_obtener_productos = "SELECT * FROM medicamentos ORDER BY idmedicamento DESC LIMIT 4";
$resultado_obtener_productos = $conexion->query($sql_obtener_productos);

if ($resultado_obtener_productos->num_rows > 0) {
    // Mostrar los productos
    while ($fila_producto = $resultado_obtener_productos->fetch_assoc()) {
        echo "<form action='agregarCarrito.php' method='POST' class='card'>";
        echo "<div class='top-product' id='productos'>";
        echo "<input type='hidden' name='idmedicamento' value=" . $fila_producto['idmedicamento'] . ">";
        echo "<img class='card-img-top' src=" . $fila_producto['imagenprincipal'] . ">";
        echo "<section class='card-container'>";
        echo "<h2 class='card_name'>" . $fila_producto["nombre"] . "</h2>";
        echo "<p class='card-title'>Precio: $" . $fila_producto["precio"] . "</p>";

        echo "</section>";
        echo "<button type='submit' name='comprar' class='comprar-tarje-comp'>";
        echo 'comprar';
        echo "</button>";
        echo "</div>";
        echo "</form>";
       
    }
} else {
    echo "No hay productos disponibles";
}

$conexion->close(); // Cerrar la conexión
