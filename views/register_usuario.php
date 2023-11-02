<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register_Usu.css">
    <title>Registro de Usuario</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="fondo">
    <section class="formulario">
        <form class="form" method="post">
            <p class="title">Registro de Usuario</p>
            <p class="message">Regístrate ahora y obtén acceso completo a nuestro sistema.</p>
            <section class="parte1-formulario">
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Nombre</span>
                        <input class="contenedores_input" type="text" name="nombre" placeholder="" required>
                    </label>
                </div>
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Apellido</span>
                        <input class="contenedores_input" type="text" name="apellido" placeholder="" required>
                    </label>
                </div>
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Tipo de Documento</span>
                        <select class="contendor_select" name="tipo_documento" required>
                            <?php
                            include "../config/Conexion.php";
                              $tipdocument=mysqli_query($conexion,"SELECT * FROM tipodocumento ORDER BY IdDocumento ASC");
                              if($tipdocument){
                                while($ras = mysqli_fetch_array($tipdocument)){
                                    echo "<option value='".$ras["IdDocumento"]."'>".$ras["NombreDocu"]."</option>";
                                }
                              }  
                            ?>
                            <option value="1">Cédula</option>
                            <option value="2">Tarjeta de identidad</option>
                        </select>
                    </label>
                </div>
            </section>

            <section class="parte1-formulario">
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Número de Documento</span>
                        <input class="contenedores_input" type="text" name="documento" placeholder="" required>

                    </label>
                </div>
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Email</span>
                        <input class="contenedores_input" type="email" name="correo" placeholder="" required>

                    </label>
                </div>
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Contraseña</span>
                        <input class="contenedores_input" type="password" name="passwordusuario" placeholder="" required>

                    </label>
                </div>
            </section>
            <section class="parte1-formulario">
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Confirmar contraseña</span>
                        <input class="contenedores_input" type="password" name="confirmar_contra" placeholder="" required>

                    </label>
                </div>
                <div class="contenedoresparte1">
                    <label class="contenedor_label">
                        <span class="letra_label">Teléfono</span>
                        <input class="contenedores_input" type="number" name="telefono" placeholder="" required>

                    </label>
                </div>
            </section>
                <div class="contenedoresparte1">
                <button class="submit" type="submit">Registrar</button>
                <p class="signin">¿Ya tienes una cuenta? <a href="login.php">Login</a></p>
                </div>
        </form>
    </section>
    </section>


    <?php
    include("../controllers/procesar_formulario.php");
    ?>
</body>

</html>