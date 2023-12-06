<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require '../correo/PHPMailer.php';
require '../correo/SMTP.php';
require '../correo/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el valor del campo de correo electrónico
   $correo = $email;

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
        $mail->addAddress($correo); // Destinatario
        $mail->addReplyTo('info@example.com', 'Information'); // Dirección de respuesta
        $mail->isHTML(true); // Habilita el formato HTML
        $mail->Subject = 'Compra realizada '; // Asunto del correo

        // Contenido del correo en formato HTML
        // Contenido del correo en formato HTML (ejemplo de factura)
        $mail->Body = '
<h2 style=" text-aling:center ; ">FARMADSO</h2>
<table border="1px" style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th>Medicamentos</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
    </thead>
';


        for ($i = 0; $i < sizeof($DATA_ALL); $i++) {
            $mail->Body .= $DATA_ALL[$i];
        }


        $mail->Body .= '</table><br> <p>Subtotal de Compra <b>' . intval($total) . '</b></p>';

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Cuerpo alternativo en texto plano para clientes que no admiten HTML

        // Envía el correo y manejo de excepciones
        $mail->send(); // Envía el correo

    } catch (Exception $e) {
    }
}