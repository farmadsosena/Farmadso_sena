<?php
session_start();
// Obtener el hash, el valor cifrado y la clave secreta desde la URL
$hashRecibido = $_GET['hash'];
$cifradoRecibido = $_GET['cifrado'];
$claveSecretaRecibidaCodificada= $_GET['clave'];
// Decodificar la clave secreta recibida
$claveSecretaRecibida = base64_decode($claveSecretaRecibidaCodificada);

echo $claveSecretaRecibida;
// Verificar si el SMS ya se ha enviado
$smsEnviado = isset($_COOKIE['smsEnviado']) ? $_COOKIE['smsEnviado'] : false;

// Incluir el archivo SMS.php solo si el SMS no se ha enviado
if (!$smsEnviado) {
    require_once '../SMS.php';
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/codigoclave.css" />
    <script src="https://kit.fontawesome.com/6262aa5408.js" crossorigin="anonymous"></script>
    <title>Title</title>
  </head>

  <body>
    <header class="cabecera">
      <section>
        <div>
          <h2>Registro</h2>
          <h1>Gratuito en 360NRS</h1>
        </div>
        <p>Prueba de 360NRS sin compromiso con nuestro saldo de regalo</p>
      </section>
    </header>

    <div class="container">
      <article>
        <header>
          <h2>Verifica</h2>
          <h1>tu código SMS</h1>
        </header>
        <div>
          <p>
            Introduce el código que te acabamos de enviar por SMS para verificar
            tu cuenta.
          </p>

          <p>
            Estás a punto de poder disfrutar de la mejor
            <span>plataforma de marketing multicanal</span> al mejor precio.
          </p>
        </div>

        <form method="post">
          <article>
            <section>
              <i class="fa-solid fa-pen-to-square"></i>
            <input
              type="text"
              name="clave"
              id=""
              placeholder="Introduce aquí el código recibido"
            />
            </section>

            <div>
              <a href="">Volver a enviar el SMS</a>
            </div>
          </article>
          <button name="claveEscrita">Verifica el código y <span> <h2>accede</h2></span></button>
        </form>
      </article>

      <article>
        <p class="text">
          Si tienes algún problema durante el registro, por favor
          <span>contacta</span> con nosotros.
        </p>

        <section>
            <div>
                <span><i class="fa-solid fa-phone"></i></span>
                <section>
                    <h3>Teléfono:</h3>
                    <p>(+57) 324 345 67 89</p>
                </section>
              </div>
      
              <div>
                <span><i class="fa-solid fa-envelope"></i></span>
                <section>
                    <h3>Email:</h3>
                    <p id="info">info@360nrs.com</p>
                </section>
              </div>
        </section>
        
      </article>
    </div>
  </body>
</html>


<?php
if (isset($_POST["claveEscrita"])) {
    $claveRegistrada = $_POST["clave"];
    if ($claveRegistrada == $claveSecretaRecibida) {
        // Verificar el hash
        $hashCalculado = hash('sha256', $cifradoRecibido);

        if ($hashRecibido === $hashCalculado) {
            // Hash válido, proceder con el descifrado
            $valorOriginal = openssl_decrypt($cifradoRecibido, 'aes-256-cbc', $claveSecretaRecibida, 0, '1234567890123456');

            if ($valorOriginal !== false) {
                // Establecer la cookie indicando que el SMS se ha enviado
               // setcookie('smsEnviado', 'true', time() + 3600);  // Expire en una hora

                // Redirigir
                header('Location: pagoFormula.php');
                $_SESSION["clave"]= $valorOriginal;
                exit();
            } else {
                // Error en el descifrado
                echo "Error: No se pudo descifrar el valor.";
            }
        } else {
            // Hash no válido, manejar el error
            echo "Error: Hash no válido";
        }
    } else {
        echo "La clave es incorrecta, por favor revise el número de clave.";
    }
}
?>

