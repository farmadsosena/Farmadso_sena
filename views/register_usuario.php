<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register_Usu.css">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="fondo">
    <section class="formulario">
        <form class="form" method="post">
            <p class="title">Registro de Usuario</p>
            <p class="message">Regístrate ahora y obtén acceso completo a nuestro sistema.</p>
            <label class="contenedor_label">
                <span class="letra_label">Nombre</span>
                <input class="contenedores_input" type="text" name="nombre" placeholder="" required>
            </label>
            <label class="contenedor_label">
                <span class="letra_label">Apellido</span>
                <input class="contenedores_input" type="text" name="apellido" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Tipo de Documento</span>
                <select class="contendor_select" name="tipo_documento" required>
                <?php
                    include "../config/Conexion.php";
                    $eps_rett = mysqli_query($conexion, "SELECT * FROM tipodocumento ORDER BY IdDocumento");
                    if ($eps_rett) {
                        while ($sett = mysqli_fetch_assoc($eps_rett)) {
                            echo '<option value="' . $sett["IdDocumento"] . '">' . $sett["NombreDocu"] . '</option>';
                        }
                    }
                    ?>
                </select>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Número de Documento</span>
                <input class="contenedores_input" type="text" name="documento" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Email</span>
                <input class="contenedores_input" type="email" name="correo" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Contraseña</span>
                <input class="contenedores_input" type="password" name="passwordusuario" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Confirmar contraseña</span>
                <input class="contenedores_input" type="password" name="confirmar_contra" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">Teléfono</span>
                <input class="contenedores_input" type="number" name="telefono" placeholder="" required>

            </label>
            <label class="contenedor_label">
                <span class="letra_label">EPS</span>
                <select class="contendor_select" name="IdEps" required>
                    <?php
                    $eps_rett = mysqli_query($conexion, "SELECT * FROM eps ORDER BY nombre");
                    if ($eps_rett) {
                        while ($sett = mysqli_fetch_assoc($eps_rett)) {
                            echo '<option value="' . $sett["ideps"] . '">' . $sett["nombre"] . '</option>';
                        }
                    }
                    ?>
                </select>

            </label>
            <button class="submit" type="submit">Registrar</button>
            <p class="signin">¿Ya tienes una cuenta? <a href="login.php">Login</a></p>
        </form>
    </section>

    <?php
    include("../controllers/procesar_formulario.php");
    ?>
</body>

</html>