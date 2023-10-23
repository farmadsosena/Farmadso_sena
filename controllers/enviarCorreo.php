<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require '../correo/PHPMailer.php';
require '../correo/SMTP.php';
require '../correo/Exception.php';
try {
    // Tu código existente aquí

    // Crea una instancia de PHPMailer
    $mail = new PHPMailer(true);

    // Configuración del servidor SMTP y autenticación
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Salida de depuración detallada
    $mail->isSMTP(); // Utiliza SMTP para enviar el correo
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
    $mail->SMTPAuth = true; // Habilita la autenticación SMTP
    $mail->Username = 'mejiayohany6@gmail.com'; // Tu dirección de correo
    $mail->Password = 'mwfnqrcypvdimyzu'; // Tu contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Encriptación TLS implícita
    $mail->Port = 465; // Puerto TCP

    // Configuración de los destinatarios y el contenido del correo
    $mail->setFrom('mejiayohany6@gmail.com', 'Compra exitosa'); // Remitente
    $mail->addAddress('yohsantanilla@misena.edu.co', ''); // Destinatario
    $mail->addReplyTo('info@example.com', 'Information'); // Dirección de respuesta
    $mail->isHTML(true); // Habilita el formato HTML
    $mail->Subject = 'Compra realizada '; // Asunto del correo

    // Contenido del correo en formato HTML

    // Contenido del correo en formato HTML (tabla con los 5 medicamentos)
    $mail->Body = '
<html>
<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>    <h4>Su compra ha sido realizada con éxito</h4>
<table>
    <tr>
        <th>Nombre Medicamento</th>
        <th>Código</th>
        <th>Precio Unitario</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
    </tr>
    <tr>
        <td>Aspirina</td>
        <td>Código #01</td>
        <td>$12.000</td>
        <td>2</td>
        <td>$24.000</td>
    </tr>
    <tr>
        <td>Paracetamol</td>
        <td>Código #02</td>
        <td>$4.000</td>
        <td>2</td>
        <td>$8.000</td>
    </tr>
    <tr>
        <td>Ibuprofeno</td>
        <td>Código #03</td>
        <td>$6.500</td>
        <td>1</td>
        <td>$6.500</td>
    </tr>
    <tr>
        <td>Omeprazol</td>
        <td>Código #04</td>
        <td>$8.000</td>
        <td>2</td>
        <td>$16.000</td>
    </tr>
    <tr>
        <td>Amoxicilina</td>
        <td>Código #05</td>
        <td>$7.000</td>
        <td>3</td>
        <td>$21.000</td>
    </tr>
</table>
<p>Subtotal de compra: $75.500</p>
</body>
</html>';


    // Envía el correo
    $mail->send();

} catch (Exception $e) {

}