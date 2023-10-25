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
        <form class="form" method="post" action="../controllers/procesar_formulario.php">
            <p class="title">Registro de Usuario</p>
            <p class="message">Regístrate ahora y obtén acceso completo a nuestro sistema.</p>
            <label class="contenedor_label">
                <span class="letra_label">Nombre</span>
                <input class="contenedores_input" type="text" name="nombre" placeholder="" required>
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Apellido</span>
                <input class="contenedores_input" type="text" name="apellido" placeholder="" required>
             
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Tipo de Documento</span>
                <select class="contendor_select" name="tipo_documento" required>
                    <option value="1">Cédula</option>
                    <option value="2">Tarjeta de identidad</option>
                </select>
              
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Número de Documento</span>
                <input class="contenedores_input" type="text" name="documento" placeholder="" required>
         
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Email</span>
                <input class="contenedores_input" type="email" name="correo" placeholder="" required>
           
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Contraseña</span>
                <input class="contenedores_input" type="password" name="passwordusuario" placeholder="" required>
              
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Confirmar contraseña</span>
                <input class="contenedores_input" type="password" name="confirmar_contra" placeholder="" required>
               
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">Teléfono</span>
                <input class="contenedores_input" type="number" name="telefono" placeholder="" required>
                
            </label>
            <label  class="contenedor_label">
                <span class="letra_label">EPS</span>
                <select class="contendor_select" name="IdEps" required>
                    <option value="1">EPS 1</option>
                    <option value="2">EPS 2</option>
                    <option value="3">EPS 3</option>
                </select>
           
            </label>
            <button class="submit" type="submit">Registrar</button>
            <p class="signin">¿Ya tienes una cuenta? <a href="login.php">Login</a></p>
        </form>
    </section>
</body>

</html>