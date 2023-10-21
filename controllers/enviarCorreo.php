<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require '../correo/PHPMailer.php';
require '../correo/SMTP.php';
require '../correo/Exception.php';

// Crea una instancia de PHPMailer; pasando `true` habilita las excepciones
$mail = new PHPMailer(true);


// Configuración del servidor SMTP y autenticación
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilita la salida de depuración detallada del servidor
$mail->isSMTP(); // Utiliza el método SMTP para enviar el correo
$mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
$mail->SMTPAuth = true; // Habilita la autenticación SMTP
$mail->Username = 'mejiayohany6@gmail.com'; // Nombre de usuario de la cuenta de Gmail para enviar correos
$mail->Password = 'ssvbkuipfwxgwcxm'; // Contraseña de la cuenta de Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilita la encriptación TLS implícita
$mail->Port = 465; // Puerto TCP para conectar con el servidor SMTP

// Configuración de los destinatarios y el contenido del correo
$mail->setFrom('mejiayohany6@gmail.com', 'Compra realizada'); // Dirección y nombre del remitente
$mail->addAddress($usuarioFinal, ''); // Agrega un destinatario y, opcionalmente, un nombre
$mail->addReplyTo('info@example.com', 'Information'); // Configura la dirección de respuesta del correo
$mail->isHTML(true); // Habilita el formato HTML para el contenido del correo
$mail->Subject = 'Factura de compra'; // Asunto del correo

// Contenido del correo en formato HTML (ejemplo de factura)
$mail->Body = '
    <h2 style=" text-aling:center ; ">Desayunos sorpresa</h2>
    <table border="1px" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
    ';


for ($i = 0; $i < sizeof($DATA_ALL); $i++) {
    $mail->Body .= $DATA_ALL[$i];
}

$mail->Body .= '</table><br> <p>Subtotal de compra <b>' . intval($total) . '</b></p>';

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Cuerpo alternativo en texto plano para clientes que no admiten HTML

// Envía el correo y manejo de excepciones
$mail->send(); // Envía el correo

?>