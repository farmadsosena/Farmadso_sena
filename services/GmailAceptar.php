<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Incluye los archivos necesarios de PHPMailer
require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

// Crea una instancia de PHPMailer; pasando `true` habilita las excepciones
$mail = new PHPMailer(true);

// Configuración del servidor SMTP y autenticación
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilita la salida de depuración detallada del servidor
$mail->isSMTP(); // Utiliza el método SMTP para enviar el correo
$mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
$mail->SMTPAuth = true; // Habilita la autenticación SMTP
$mail->Username = 'farmadso70@gmail.com'; // Nombre de usuario de la cuenta de Gmail para enviar correos
$mail->Password = 'uovzjsaejcqopmng'; // Contraseña de la cuenta de Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Habilita la encriptación TLS implícita
$mail->Port = 465; // Puerto TCP para conectar con el servidor SMTP

// Configuración de los destinatarios y el contenido del correo
$mail->setFrom($correo, 'Solicitud cuenta farmadso'); // Dirección y nombre del remitente
$mail->addAddress($correo); // Agrega un destinatario y, opcionalmente, un nombre
$mail->addReplyTo('info@example.com', 'Information'); // Configura la dirección de respuesta del correo
$mail->isHTML(true); // Habilita el formato HTML para el contenido del correo
$mail->Subject = 'Respuesta a solicitud de cuenta'; // Asunto del correo

$mail->Body = '';

if ($numeroCuen == "1") {
    // Contenido específico para la cuenta "Farmaceutico"
    $mail->Body .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="format-detection" content="telephone=no">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title></title>
      <style type="text/css" emogrify="no">
      #outlook a {
        padding: 0;
      }
    
      .ExternalClass {
        width: 100%;
      }
    
      .ExternalClass,
      .ExternalClass p,
      .ExternalClass span,
      .ExternalClass font,
      .ExternalClass td,
      .ExternalClass div {
        line-height: 100%;
      }
    
      table td {
        border-collapse: collapse;
        mso-line-height-rule: exactly;
      }
    
      .editable.image {
        font-size: 0 !important;
        line-height: 0 !important;
      }
    
      .nl2go_preheader {
        display: none !important;
        mso-hide: all !important;
        mso-line-height-rule: exactly;
        visibility: hidden !important;
        line-height: 0px !important;
        font-size: 0px !important;
      }
    
      body {
        width: 100% !important;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        margin: 0;
        padding: 0;
      }
    
      img {
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
      }
    
      a img {
        border: none;
      }
    
      table {
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
      }
    
      th {
        font-weight: normal;
        text-align: left;
      }
    
      *[class="gmail-fix"] {
        display: none !important;
      }
      </style>
      <style type="text/css" emogrify="no">
      @media (max-width: 600px) {
        .gmx-killpill {
          content: "\03D1";
        }
      }
      </style>
      <style type="text/css" emogrify="no">
      @media (max-width: 600px) {
        .gmx-killpill {
          content: "\03D1";
        }
    
        .r0-o {
          border-style: solid !important;
          margin: 0 auto 0 auto !important;
          width: 320px !important
        }
    
        .r1-i {
          background-color: #ffffff !important
        }
    
        .r2-c {
          box-sizing: border-box !important;
          text-align: center !important;
          valign: top !important;
          width: 100% !important
        }
    
        .r3-o {
          border-style: solid !important;
          margin: 0 auto 0 auto !important;
          width: 100% !important
        }
    
        .r4-i {
          padding-bottom: 20px !important;
          padding-left: 10px !important;
          padding-right: 10px !important;
          padding-top: 20px !important
        }
    
        .r5-c {
          box-sizing: border-box !important;
          display: block !important;
          valign: top !important;
          width: 100% !important
        }
    
        .r6-o {
          border-style: solid !important;
          width: 100% !important
        }
    
        .r7-i {
          padding-left: 0px !important;
          padding-right: 0px !important
        }
    
        .r8-i {
          padding-bottom: 15px !important;
          padding-top: 15px !important
        }
    
        .r9-c {
          box-sizing: border-box !important;
          text-align: left !important;
          valign: top !important;
          width: 100% !important
        }
    
        .r10-o {
          border-style: solid !important;
          margin: 0 auto 0 0 !important;
          width: 100% !important
        }
    
        .r11-i {
          padding-top: 15px !important;
          text-align: left !important
        }
    
        .r12-c {
          box-sizing: border-box !important;
          padding: 0 !important;
          text-align: center !important;
          valign: top !important;
          width: 100% !important
        }
    
        .r13-o {
          border-style: solid !important;
          margin: 0 auto 0 auto !important;
          margin-bottom: 15px !important;
          margin-top: 15px !important;
          width: 100% !important
        }
    
        .r14-i {
          padding: 0 !important;
          text-align: center !important
        }
    
        .r15-r {
          background-color: #1B1B1B !important;
          border-radius: 4px !important;
          border-width: 0px !important;
          box-sizing: border-box;
          height: initial !important;
          padding: 0 !important;
          padding-bottom: 12px !important;
          padding-left: 5px !important;
          padding-right: 5px !important;
          padding-top: 12px !important;
          text-align: center !important;
          width: 100% !important
        }
    
        .r16-i {
          background-color: #eff2f7 !important;
          padding-bottom: 20px !important;
          padding-left: 15px !important;
          padding-right: 15px !important;
          padding-top: 20px !important
        }
    
        .r17-i {
          color: #3b3f44 !important;
          padding-bottom: 0px !important;
          padding-top: 15px !important;
          text-align: center !important
        }
    
        .r18-i {
          color: #3b3f44 !important;
          padding-bottom: 0px !important;
          padding-top: 0px !important;
          text-align: center !important
        }
    
        .r19-i {
          color: #3b3f44 !important;
          padding-bottom: 15px !important;
          padding-top: 15px !important;
          text-align: center !important
        }
    
        .r20-c {
          box-sizing: border-box !important;
          text-align: center !important;
          width: 100% !important
        }
    
        .r21-i {
          padding-bottom: 15px !important;
          padding-left: 0px !important;
          padding-right: 0px !important;
          padding-top: 0px !important
        }
    
        .r22-c {
          box-sizing: border-box !important;
          text-align: center !important;
          valign: top !important;
          width: 129px !important
        }
    
        .r23-o {
          border-style: solid !important;
          margin: 0 auto 0 auto !important;
          width: 129px !important
        }
    
        body {
          -webkit-text-size-adjust: none
        }
    
        .nl2go-responsive-hide {
          display: none
        }
    
        .nl2go-body-table {
          min-width: unset !important
        }
    
        .mobshow {
          height: auto !important;
          overflow: visible !important;
          max-height: unset !important;
          visibility: visible !important;
          border: none !important
        }
    
        .resp-table {
          display: inline-table !important
        }
    
        .magic-resp {
          display: table-cell !important
        }
      }
      </style>
      <style type="text/css">
      p,
      h1,
      h2,
      h3,
      h4,
      ol,
      ul {
        margin: 0;
      }
    
      a,
      a:link {
        color: #696969;
        text-decoration: underline
      }
    
      .nl2go-default-textstyle {
        color: #3b3f44;
        font-family: arial, helvetica, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        word-break: break-word
      }
    
      .default-button {
        color: #ffffff;
        font-family: arial, helvetica, sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: bold;
        line-height: 1.15;
        text-decoration: none;
        word-break: break-word
      }
    
      .default-heading1 {
        color: #1F2D3D;
        font-family: arial, helvetica, sans-serif;
        font-size: 36px;
        word-break: break-word
      }
    
      .default-heading2 {
        color: #1F2D3D;
        font-family: arial, helvetica, sans-serif;
        font-size: 32px;
        word-break: break-word
      }
    
      .default-heading3 {
        color: #1F2D3D;
        font-family: arial, helvetica, sans-serif;
        font-size: 24px;
        word-break: break-word
      }
    
      .default-heading4 {
        color: #1F2D3D;
        font-family: arial, helvetica, sans-serif;
        font-size: 18px;
        word-break: break-word
      }
    
      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: inherit !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
      }
    
      .no-show-for-you {
        border: none;
        display: none;
        float: none;
        font-size: 0;
        height: 0;
        line-height: 0;
        max-height: 0;
        mso-hide: all;
        overflow: hidden;
        table-layout: fixed;
        visibility: hidden;
        width: 0;
      }
      </style>
      <!--[if mso]><xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]-->
      <style type="text/css">
      a:link {
        color: #696969;
        text-decoration: underline;
      }
      </style>
    </head>
    
    <body bgcolor="#ffffff" text="#3b3f44" link="#696969" yahoo="fix" style="background-color: #ffffff;">
      <table cellspacing="0" cellpadding="0" border="0" role="presentation" class="nl2go-body-table" width="100%"
        style="background-color: #ffffff; width: 100%;">
        <tr>
          <td>
            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="600" align="center" class="r0-o"
              style="table-layout: fixed; width: 600px;">
              <tr>
                <td valign="top" class="r1-i" style="background-color: #ffffff;">
                  <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" align="center"
                    class="r3-o" style="table-layout: fixed; width: 100%;">
                    <tr>
                      <td class="r4-i" style="padding-bottom: 20px; padding-top: 20px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                          <tr>
                            <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                              <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                class="r6-o" style="table-layout: fixed; width: 100%;">
                                <tr>
                                  <td valign="top" class="r7-i">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                      <tr>
                                        <td class="r2-c" align="center">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="600"
                                            class="r3-o" style="table-layout: fixed; width: 600px;">
                                            <tr>
                                              <td class="r8-i"
                                                style="font-size: 0px; line-height: 0px; padding-bottom: 15px; padding-top: 15px;">
                                                <img
                                                  src="https://creative-assets.mailinblue.com/editor/templates/image-placeholder-2x-2.png"
                                                  width="600" border="0" style="display: block; width: 100%;">
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="left" valign="top" class="r11-i nl2go-default-textstyle"
                                                style="color: #3b3f44; font-family: arial,helvetica,sans-serif; font-size: 16px; line-height: 1.5; word-break: break-word; padding-top: 15px; text-align: left;">
                                                <div>
                                                  <h1 class="default-heading1"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 36px; word-break: break-word;">
                                                    <strong>Confirmación de Aprobación de Cuenta - ' . $cuenta . '</strong>
                                                  </h1>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="left" valign="top" class="r11-i nl2go-default-textstyle"
                                                style="color: #3b3f44; font-family: arial,helvetica,sans-serif; font-size: 16px; line-height: 1.5; word-break: break-word; padding-top: 15px; text-align: left;">
                                                <div>
                                                  <h4 class="default-heading4"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 18px; word-break: break-word;">
                                                    Estimado' . $nombre . ',</h4>
                                                  <h4 class="default-heading4"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 18px; word-break: break-word;">
                                                    Martes 17 de abril a las 9:30 a. m., EST</h4>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Nos complace informarte que tu solicitud para
                                                    obtener una cuenta de tipo farmacia ha sido aceptada con éxito.
                                                    ¡Bienvenido a nuestra comunidad!.</p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Para acceder a tu cuenta, simplemente utiliza las
                                                    credenciales proporcionadas durante el proceso de registro. Ingresa:</p>
                                                  <ul style="margin: 0;">
                                                    <li>Tu numero de cédula</li>
                                                    <li>contraseña para tener acceso a todas las funciones y características
                                                      diseñadas para satisfacer las necesidades de $tipo.</li>
                                                  </ul>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Además, te recomendamos revisar la parte superior
                                                    izquierda de tu panel una vez que hayas iniciado sesión. Allí
                                                    encontrarás un<strong> menú desplegable</strong> con acceso rápido a las
                                                    diferentes secciones y herramientas disponibles para tu cuenta. Esto te
                                                    facilitará la navegación y te permitirá aprovechar al máximo todas las
                                                    capacidades que ofrecemos.</p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Si tienes alguna pregunta o necesitas asistencia, no
                                                    dudes en ponerte en contacto con nuestro equipo de soporte técnico en
                                                    farmadso2023@gmail.com o +57 324 5570819</p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Agradecemos tu elección de confiar en nosotros para
                                                    satisfacer tus necesidades farmacéuticas en línea. Estamos seguros de
                                                    que encontrarás nuestra plataforma fácil de usar y beneficiosas para tu
                                                    negocio.</p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">¡Gracias por formar parte de nuestra comunidad!</p>
                                                  <p style="margin: 0;">Atentamente,</p>
                                                  <p style="margin: 0;"><strong>Farmadso servicios de salud</strong> </p>
                                                  <p style="margin: 0;">Equipo de Soporte</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r12-c" align="center"
                                          style="align: center; padding-bottom: 15px; padding-top: 15px; valign: top;">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="300"
                                            class="r13-o"
                                            style="background-color: #1B1B1B; border-collapse: separate; border-color: #1B1B1B; border-radius: 4px; border-style: solid; border-width: 0px; table-layout: fixed; width: 300px;">
                                            <tr>
                                              <td height="20" align="center" valign="top"
                                                class="r14-i nl2go-default-textstyle"
                                                style="word-break: break-word; background-color: #1B1B1B; border-radius: 4px; color: #ffffff; font-family: arial,helvetica,sans-serif; font-size: 16px; font-style: normal; line-height: 1.15; padding-bottom: 12px; padding-left: 5px; padding-right: 5px; padding-top: 12px; text-align: center;">
                                                <a href="#top" class="r15-r default-button" target="_blank" data-btn="1"
                                                  style="font-style: normal; font-weight: bold; line-height: 1.15; text-decoration: none; word-break: break-word; word-wrap: break-word; display: block; -webkit-text-size-adjust: none; color: #ffffff; font-family: arial,helvetica,sans-serif; font-size: 16px;">
                                                  <span>Registrarse</span></a>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" align="center"
                    class="r3-o" style="table-layout: fixed; width: 100%;">
                    <tr>
                      <td class="r16-i" style="background-color: #eff2f7; padding-bottom: 20px; padding-top: 20px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                          <tr>
                            <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                              <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                class="r6-o" style="table-layout: fixed; width: 100%;">
                                <tr>
                                  <td valign="top" class="r7-i" style="padding-left: 15px; padding-right: 15px;">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r17-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0;"><strong>Farmadso servicios de salud</strong></p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r18-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">calle 20 Norte 8-23, 180001,
                                                    Florencia</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r17-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">Este e-mail se envió a
                                                    {{contact.EMAIL}}
                                                  </p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r18-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">Lo recibiste porque estás suscrit a
                                                    nuestra newsletter.</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r19-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-bottom: 15px; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;"></p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>                                    
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    
    </html>';
} else {
    // Contenido para otras cuentas
    $mail->Body .= '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
    
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="format-detection" content="telephone=no">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title></title>
      <style type="text/css" emogrify="no">
        #outlook a {
          padding: 0;
        }
    
        .ExternalClass {
          width: 100%;
        }
    
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%;
        }
    
        table td {
          border-collapse: collapse;
          mso-line-height-rule: exactly;
        }
    
        .editable.image {
          font-size: 0 !important;
          line-height: 0 !important;
        }
    
        .nl2go_preheader {
          display: none !important;
          mso-hide: all !important;
          mso-line-height-rule: exactly;
          visibility: hidden !important;
          line-height: 0px !important;
          font-size: 0px !important;
        }
    
        body {
          width: 100% !important;
          -webkit-text-size-adjust: 100%;
          -ms-text-size-adjust: 100%;
          margin: 0;
          padding: 0;
        }
    
        img {
          outline: none;
          text-decoration: none;
          -ms-interpolation-mode: bicubic;
        }
    
        a img {
          border: none;
        }
    
        table {
          border-collapse: collapse;
          mso-table-lspace: 0pt;
          mso-table-rspace: 0pt;
        }
    
        th {
          font-weight: normal;
          text-align: left;
        }
    
        *[class="gmail-fix"] {
          display: none !important;
        }
      </style>
      <style type="text/css" emogrify="no">
        @media (max-width: 600px) {
          .gmx-killpill {
            content: "\03D1";
          }
        }
      </style>
      <style type="text/css" emogrify="no">
        @media (max-width: 600px) {
          .gmx-killpill {
            content: "\03D1";
          }
    
          .r0-o {
            border-style: solid !important;
            margin: 0 auto 0 auto !important;
            width: 320px !important
          }
    
          .r1-i {
            background-color: #ffffff !important
          }
    
          .r2-c {
            box-sizing: border-box !important;
            text-align: center !important;
            valign: top !important;
            width: 100% !important
          }
    
          .r3-o {
            border-style: solid !important;
            margin: 0 auto 0 auto !important;
            width: 100% !important
          }
    
          .r4-i {
            padding-bottom: 20px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
            padding-top: 20px !important
          }
    
          .r5-c {
            box-sizing: border-box !important;
            display: block !important;
            valign: top !important;
            width: 100% !important
          }
    
          .r6-o {
            border-style: solid !important;
            width: 100% !important
          }
    
          .r7-i {
            padding-left: 0px !important;
            padding-right: 0px !important
          }
    
          .r8-i {
            padding-bottom: 15px !important;
            padding-top: 15px !important
          }
    
          .r9-c {
            box-sizing: border-box !important;
            text-align: left !important;
            valign: top !important;
            width: 100% !important
          }
    
          .r10-o {
            border-style: solid !important;
            margin: 0 auto 0 0 !important;
            width: 100% !important
          }
    
          .r11-i {
            padding-top: 15px !important;
            text-align: left !important
          }
    
          .r12-i {
            padding-bottom: 20px !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            padding-top: 20px !important
          }
    
          .r13-c {
            box-sizing: border-box !important;
            text-align: center !important;
            width: 100% !important
          }
    
          .r14-i {
            background-color: transparent !important
          }
    
          .r15-i {
            background-color: #eff2f7 !important;
            padding-bottom: 20px !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            padding-top: 20px !important
          }
    
          .r16-i {
            color: #3b3f44 !important;
            padding-bottom: 0px !important;
            padding-top: 15px !important;
            text-align: center !important
          }
    
          .r17-i {
            color: #3b3f44 !important;
            padding-bottom: 0px !important;
            padding-top: 0px !important;
            text-align: center !important
          }
    
          .r18-i {
            color: #3b3f44 !important;
            padding-bottom: 15px !important;
            padding-top: 15px !important;
            text-align: center !important
          }
    
          .r19-i {
            padding-bottom: 15px !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
            padding-top: 0px !important
          }
    
          .r20-c {
            box-sizing: border-box !important;
            text-align: center !important;
            valign: top !important;
            width: 129px !important
          }
    
          .r21-o {
            border-style: solid !important;
            margin: 0 auto 0 auto !important;
            width: 129px !important
          }
    
          body {
            -webkit-text-size-adjust: none
          }
    
          .nl2go-responsive-hide {
            display: none
          }
    
          .nl2go-body-table {
            min-width: unset !important
          }
    
          .mobshow {
            height: auto !important;
            overflow: visible !important;
            max-height: unset !important;
            visibility: visible !important;
            border: none !important
          }
    
          .resp-table {
            display: inline-table !important
          }
    
          .magic-resp {
            display: table-cell !important
          }
        }
      </style>
      <style type="text/css">
        p,
        h1,
        h2,
        h3,
        h4,
        ol,
        ul {
          margin: 0;
        }
    
        a,
        a:link {
          color: #696969;
          text-decoration: underline
        }
    
        .nl2go-default-textstyle {
          color: #3b3f44;
          font-family: arial, helvetica, sans-serif;
          font-size: 16px;
          line-height: 1.5;
          word-break: break-word
        }
    
        .default-button {
          color: #ffffff;
          font-family: arial, helvetica, sans-serif;
          font-size: 16px;
          font-style: normal;
          font-weight: bold;
          line-height: 1.15;
          text-decoration: none;
          word-break: break-word
        }
    
        .default-heading1 {
          color: #1F2D3D;
          font-family: arial, helvetica, sans-serif;
          font-size: 36px;
          word-break: break-word
        }
    
        .default-heading2 {
          color: #1F2D3D;
          font-family: arial, helvetica, sans-serif;
          font-size: 32px;
          word-break: break-word
        }
    
        .default-heading3 {
          color: #1F2D3D;
          font-family: arial, helvetica, sans-serif;
          font-size: 24px;
          word-break: break-word
        }
    
        .default-heading4 {
          color: #1F2D3D;
          font-family: arial, helvetica, sans-serif;
          font-size: 18px;
          word-break: break-word
        }
    
        a[x-apple-data-detectors] {
          color: inherit !important;
          text-decoration: inherit !important;
          font-size: inherit !important;
          font-family: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
        }
    
        .no-show-for-you {
          border: none;
          display: none;
          float: none;
          font-size: 0;
          height: 0;
          line-height: 0;
          max-height: 0;
          mso-hide: all;
          overflow: hidden;
          table-layout: fixed;
          visibility: hidden;
          width: 0;
        }
      </style>
      <!--[if mso]><xml> <o:OfficeDocumentSettings> <o:AllowPNG/> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]-->
      <style type="text/css">
        a:link {
          color: #696969;
          text-decoration: underline;
        }
      </style>
    </head>
    
    <body bgcolor="#ffffff" text="#3b3f44" link="#696969" yahoo="fix" style="background-color: #ffffff;">
      <table cellspacing="0" cellpadding="0" border="0" role="presentation" class="nl2go-body-table" width="100%"
        style="background-color: #ffffff; width: 100%;">
        <tr>
          <td>
            <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="600" align="center" class="r0-o"
              style="table-layout: fixed; width: 600px;">
              <tr>
                <td valign="top" class="r1-i" style="background-color: #ffffff;">
                  <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" align="center"
                    class="r3-o" style="table-layout: fixed; width: 100%;">
                    <tr>
                      <td class="r4-i" style="padding-bottom: 20px; padding-top: 20px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                          <tr>
                            <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                              <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                class="r6-o" style="table-layout: fixed; width: 100%;">
                                <tr>
                                  <td valign="top" class="r7-i">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                      <tr>
                                        <td class="r2-c" align="center">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="600"
                                            class="r3-o" style="table-layout: fixed; width: 600px;">
                                            <tr>
                                              <td class="r8-i"
                                                style="font-size: 0px; line-height: 0px; padding-bottom: 15px; padding-top: 15px;">
                                                <img
                                                  src="https://creative-assets.mailinblue.com/editor/templates/image-placeholder-2x-2.png"
                                                  width="600" border="0" style="display: block; width: 100%;"></td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="left" valign="top" class="r11-i nl2go-default-textstyle"
                                                style="color: #3b3f44; font-family: arial,helvetica,sans-serif; font-size: 16px; line-height: 1.5; word-break: break-word; padding-top: 15px; text-align: left;">
                                                <div>
                                                  <h1 class="default-heading1"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 36px; word-break: break-word;">
                                                    <strong>Notificación de Rechazo de Solicitud de Cuenta -
                                                      '.$cuenta.'</strong></h1>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="left" valign="top" class="r11-i nl2go-default-textstyle"
                                                style="color: #3b3f44; font-family: arial,helvetica,sans-serif; font-size: 16px; line-height: 1.5; word-break: break-word; padding-top: 15px; text-align: left;">
                                                <div>
                                                  <h4 class="default-heading4"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 18px; word-break: break-word;">
                                                    Estimado/a '.$nombre.',</h4>
                                                  <p style="margin: 0;"> </p>
                                                  <h4 class="default-heading4"
                                                    style="margin: 0; color: #1f2d3d; font-family: arial,helvetica,sans-serif; font-size: 18px; word-break: break-word;">
                                                    Martes 17 de abril a las 9:30 a. m., EST</h4>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Lamentamos informarte que tu solicitud para obtener
                                                    una cuenta de tipo farmacia ha sido revisada, y lamentablemente no
                                                    podemos aprobarla en este momento. </p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Agradecemos tu interés en unirte a nuestra
                                                    plataforma, y entendemos que esta notificación puede ser decepcionante.
                                                  </p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Hemos evaluado cuidadosamente todas las solicitudes
                                                    recibidas, y aunque apreciamos tu interés, hemos tomado la difícil
                                                    decisión de no avanzar con la aprobación de tu cuenta en este momento.
                                                    Las razones específicas para esta decisión se deben a:</p>
                                                  <ul style="margin: 0;">
                                                    <li>'.$mensaje.'</li>
                                                  </ul>
                                                  <p style="margin: 0;">Entendemos que esto puede generar preguntas o
                                                    inquietudes, y estamos disponibles para proporcionar más detalles o
                                                    discutir cualquier aspecto específico que desees abordar. Si consideras
                                                    que ha habido algún malentendido o si hay información adicional que
                                                    puedas proporcionar, no dudes en ponerte en contacto con nosotros a
                                                    través de <a href="mailto:farmadso2023@gmail.com"
                                                      style="color: #696969; text-decoration: underline;">farmadso2023@gmail.com</a>
                                                    o al  +57 3224788975</p>
                                                  <p style="margin: 0;"> </p>
                                                  <p style="margin: 0;">Apreciamos tu comprensión y agradecemos el tiempo y
                                                    el esfuerzo que invertiste en tu solicitud. Te deseamos éxito en tus
                                                    futuros esfuerzos y esperamos que encuentres la solución que mejor se
                                                    adapte a tus necesidades.</p>
                                                  <p style="margin: 0;">Atentamente,</p>
                                                  <p style="margin: 0;"><strong>Farmadso sena y servicios</strong></p>
                                                  <p style="margin: 0;">Equipo de Soporte</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" align="center"
                    class="r3-o" style="table-layout: fixed; width: 100%;">
                    <tr>
                      <td class="r12-i" style="padding-bottom: 20px; padding-top: 20px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                          <tr>
                            <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                              <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                class="r6-o" style="table-layout: fixed; width: 100%;">
                                <tr>
                                  <td valign="top" class="r7-i" style="padding-left: 15px; padding-right: 15px;">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                      <tr>
                                        <td class="r13-c" align="center">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="570"
                                            class="r3-o" style="table-layout: fixed; width: 570px;">
                                            <tr>
                                              <td height="30" class="r14-i"
                                                style="font-size: 30px; line-height: 30px; background-color: transparent;">
                                                ­ </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%" align="center"
                    class="r3-o" style="table-layout: fixed; width: 100%;">
                    <tr>
                      <td class="r15-i" style="background-color: #eff2f7; padding-bottom: 20px; padding-top: 20px;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                          <tr>
                            <th width="100%" valign="top" class="r5-c" style="font-weight: normal;">
                              <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                class="r6-o" style="table-layout: fixed; width: 100%;">
                                <tr>
                                  <td valign="top" class="r7-i" style="padding-left: 15px; padding-right: 15px;">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" role="presentation">
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r16-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0;"><strong>Farmadso sena y servicios</strong></p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r17-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">calle 20 Norte 8-23, 180001,
                                                    Florencia</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r16-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">Este e-mail se envió a
                                                    '.$correo.'</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r17-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;">Lo recibiste porque estás suscrit a
                                                    nuestra newsletter.</p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="r9-c" align="left">
                                          <table cellspacing="0" cellpadding="0" border="0" role="presentation" width="100%"
                                            class="r10-o" style="table-layout: fixed; width: 100%;">
                                            <tr>
                                              <td align="center" valign="top" class="r18-i nl2go-default-textstyle"
                                                style="font-family: arial,helvetica,sans-serif; word-break: break-word; color: #3b3f44; font-size: 18px; line-height: 1.5; padding-bottom: 15px; padding-top: 15px; text-align: center;">
                                                <div>
                                                  <p style="margin: 0; font-size: 14px;"></p>
                                                </div>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                            </th>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
    
    </html>
    ';
}


$mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; // Cuerpo alternativo en texto plano para clientes que no admiten HTML

// Envía el correo y manejo de excepciones
$mail->send(); // Envía el correo
