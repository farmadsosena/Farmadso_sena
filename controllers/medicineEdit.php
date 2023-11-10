<?php
require_once '../config/Conexion.php';
$bd = new Conexion();
$conexion = $bd->getConexion();  // Obtener la conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cum']) && isset($_POST['medicineName']) && isset($_POST['priceMedicine']) && isset($_POST['loteMedicine']) && isset($_POST['StockMedicine']) && isset($_POST['descriptionMedicine']) && isset($_POST['instructionMedicine']) && isset($_POST['expirationDate']) && isset($_POST['formaAdminis']) && isset($_POST['category']) && isset($_POST['provideMedicine'])) {

        // Obtener los valores del formulario
        $cum = $_POST['cum'];
        $medicineName = $_POST['medicineName'];
        $priceMedicine = $_POST['priceMedicine'];
        $loteMedicine = $_POST['loteMedicine'];
        $StockMedicine = $_POST['StockMedicine'];
        $descriptionMedicine = $_POST['descriptionMedicine'];
        $instructionMedicine = $_POST['instructionMedicine'];
        $expirationDate = $_POST['expirationDate'];
        $formaAdminis = $_POST['formaAdminis'];
        $category = $_POST['category'];
        $provideMedicine = $_POST['provideMedicine'];

        // Aquí puedes realizar la validación y procesamiento de los datos antes de guardarlos en la base de datos

        // Por ejemplo, puedes ejecutar una consulta SQL para actualizar el medicamento
        $sql = "UPDATE medicamentos m 
                INNER JOIN inventario i ON m.idmedicamento = i.idmedicamento
                SET m.codigo = '$cum', m.precio = '$priceMedicine', m.nombre = '$medicineName', i.descripcion = '$descriptionMedicine', i.fechavencimiento = '$expirationDate', i.stock = '$StockMedicine', i.instrucciones = '$instructionMedicine', i.lote = '$loteMedicine', i.idcategoria = '$category', i.idprovedor = '$provideMedicine', i.formaadministracion = '$formaAdminis'
                WHERE m.idmedicamento = $idMedicamento";

        $result = mysqli_query($conexion, $sql);

        if ($result) {
            // Si la actualización fue exitosa, puedes redirigir a otra página o mostrar un mensaje de éxito
            header("Location: lista_medicamentos.php"); // Cambia "lista_medicamentos.php" por la página a la que quieras redirigir
            exit();
        } else {
            // Si hubo un error en la consulta, puedes mostrar un mensaje de error
            echo "Error al actualizar el medicamento: " . mysqli_error($conexion);
        }
    } else {
        // Si no se enviaron todos los campos necesarios, puedes mostrar un mensaje de error
        echo "Todos los campos son obligatorios.";
    }
}

mysqli_close($conexion); // Cerrar la conexión
?>
