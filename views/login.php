<?php
session_start();

if (isset($_SESSION["usu"])) {
    header("Location: Usuario.php");
    exit; // Asegúrate de salir del script para evitar que se ejecute más código no deseado
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login copy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/img/logoFarmadso - cambio.png" type="image/x-icon">
    <script src="../assets/js/app.js" defer></script>
    <script src="../assets/js/Font.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="form-case">
        <section class="regresar" id="caso">
            <a href="../index.php">
                <p>Pagina principal</p>
            </a>
            <a href="inicio_tienda.php">
                <p>Tienda</p>
            </a>
        </section>
    </div>
    <section class="padre">
        <section class="form-contenedor">
            <form method="post" class="form" action="../controllers/logeo.php">
                <?php
                if (isset($_GET['_mlzO'])) {
                ?>
                    <input type="hidden" name="miFarm_tienda" value="1">
                <?php
                }
                ?>
                <div class="form-title">
                    <img src="../assets/img/guest.webp" alt="">
                    <h1>Inicio de sesion</h1>
                </div>
                <div class="form-field">
                    <div class="form-field-input">
                        <input id="email" name="usuario" class="js-user" type="text">
                        <label for="email">Numero de cedula</label>
                    </div>
                    <div class="form-field-input">
                        <input id="password" name="contraseña" class="js-pass" type="password">
                        <label for="password">Contraseña</label>
                        <svg class="showpass" xmlns="http://www.w3.org/2000/svg" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5s5 2.24 5 5s-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3s3-1.34 3-3s-1.34-3-3-3z" />
                        </svg>
                        <svg class="hidepass" xmlns="http://www.w3.org/2000/svg" style="vertical-align: -0.125em;" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3h-.17m-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7Z" />
                        </svg>
                        <a href="recuperar.php">Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" name="enviar" class="primary-btn">Iniciar sesión</button>
                    <span class="divider">O</span>
                    <a class="secondary-btn" href="register_usuario.php">Crear una cuenta</a>
                </div>
            </form>
        </section>
        <section class="imagen">
            <img src="../assets/img/Reset password-amico.png" alt="">
        </section>
    </section>
</body>

</html>