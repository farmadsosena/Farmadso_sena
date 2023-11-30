<?php
function existe_en_tabla($tabla, $usuario, $columna, $valorEstado)
{
  global $conexion;
  $consulta = "SELECT * FROM $tabla WHERE idusuario = ? AND $columna = ?";
  $stmt = $conexion->prepare($consulta);

  // Cambié "ss" a "is" para reflejar que $usuario es un número (asumiendo que es numérico).
  $stmt->bind_param("ii", $usuario, $valorEstado);

  $stmt->execute();
  $resultado = $stmt->get_result();
  return $resultado->num_rows > 0;
}


$Usuarios_generale = mysqli_query($conexion, "SELECT * FROM usuarios ORDER BY nombre ASC");

if ($Usuarios_generale) {
  if (mysqli_num_rows($Usuarios_generale) > 0) {
    while ($row = mysqli_fetch_assoc($Usuarios_generale)) {
      $estado = $row["estado"];
      $img = $row["imgUser"];
      $id = $row["idusuario"];

      $roles = array();

      //Funcion para determinar que roles tiene el Usuario en el sistem


      if (existe_en_tabla('usuarios', $id, 'estado', 2)) {
        $roles[] = "Usuario EPS";
      }
      if (existe_en_tabla('farmacias', $id, 'EstadoSolicitud', 2)) {
        $roles[] = "Farmacia";
      }
      if (existe_en_tabla('domiciliario', $id, 'EstadoAcept', 2)) {
        $roles[] = "Domiciliario";
      }

      $totalRoles = count($roles);
      $UnionRoles = implode(', ', $roles);

      //Para que el estado sea definido mas definidamente
      if ($estado == "2") {
        $estado = "Activo";
      }
      if ($estado == "3") {
        $estado = "Suspendido";
      }

      //En caso de que no tenga una imagen ponga una por defecto
      if (!empty($img)) {
        $img = $row["imgUser"];
      } else {
        $img = "../assets/img/aaaa.jpeg";
      }

      echo '
      <div class="tabla_acciones_encabezado remarca" data-id="' . $id . '" data-total="' . $totalRoles . '" data-roles-list="' . $UnionRoles . '">
        <div class="encabezado_part">
            <section>
              <img src="' . $img . '" alt="">
            </section>
        </div>
        <div class="encabezado_part1" data-column="' . $row["nombre"] . " " . $row["apellido"] . '">' . $row["nombre"] . " " . $row["apellido"] . '</div>
        <div class="encabezado_part2">' . $row["correo"] . '</div>
        <div class="encabezado_part3">
            <section>
              ' . $estado . '
            </section>
        </div>
        <div class="encabezado_part4">' . $row["telefono"] . '</div>
        <div class="encabezado_part5">' . $UnionRoles . '</div>
        </div>       
      ';
    }
  } else {
    // Mostrar mensaje si no hay solicitudes
    echo '<div class="no-solicitudes">No hay ususarios entrantes en el sistema.</div>';
  }
}
?>
<script>

  (function () {
    // Almacena la referencia al último elemento clicado
    let ultimoElementoClicado = null;
    var role;

    function manejarClic(checkbox) {
      if (ultimoElementoClicado !== null) {
        ultimoElementoClicado.classList.remove('marcar');
      }
      checkbox.classList.add('marcar');
      ultimoElementoClicado = checkbox;

      var userId = checkbox.getAttribute('data-id');
      var totalRoles = checkbox.getAttribute('data-total');
      var rolesList = checkbox.getAttribute('data-roles-list');

      // Solo adjunta los eventos una vez fuera del bucle
      $('#activar').off('click').on('click', function () {
        activarCuenta(userId, totalRoles, rolesList);
      });

      $('#desactivar').off('click').on('click', function () {
        desactivarCuenta(userId, totalRoles, rolesList);
      });

      $('#Editar').off('click').on('click', function () {
        editarUsu(userId);
      });
    }



    function editarUsu(userId) {
    
      $.ajax({
        type: 'POST',
        url: '../controllers/EditarUsuario.php',
        data: { id_editar: userId},
        success: function (response) {
          document.getElementById('EditarUsuario').classList.add('flex');
          $("#EditarUsuario").html(response);
        },
        error: function (error) {
          console.error('Error en la solicitud AJAX:', error);
        }
      });
    }


    function activarCuenta(userId, totalRoles, rolesList) {
      var VentanaSeleccionar = document.getElementById('ActivarAtom');
      var CerrarVentanaSeleccionada = document.getElementById('removeVentanaAC'); // Reemplaza 'CerrarVentana' con el ID correcto
      var AbrirVentanas = document.getElementById('desactivar');


      if (parseInt(totalRoles) >= 2) {
        // Agrega un evento de clic para abrir la ventana para cada botón 'AbrirVentana'
        VentanaSeleccionar.classList.add('flex');


        // Agrega un evento de clic para cerrar la ventana
        CerrarVentanaSeleccionada.addEventListener('click', () => {
          VentanaSeleccionar.classList.remove('flex');
        });

        $.ajax({
          type: 'POST',
          url: '../controllers/ConsultarRol.php',
          data: { id_pedido: userId },
          success: function (response) {
            var roles = JSON.parse(response);
            $('#selectRoleAC').html(roles.join(''));
          },
          error: function (error) {
            console.error('Error en la solicitud AJAX:', error);
          }
        });

        // Manejar el evento del botón de aceptar
        $('#selectRoleBtnAC').on('click', function () {
          var selectedRole = $('#selectRoleAC').val();
          if (selectedRole !== null) {
            // El usuario hizo una selección
            VentanaSeleccionar.classList.remove('flex');
            ConfirmaeactivarCuenta(userId, selectedRole);
          }
        });
      } else {
        // Si tiene solo un rol, desactivar directamente
        ConfirmaeactivarCuenta(userId);
      }
    }



    function ConfirmaeactivarCuenta(userId, selectedRole) {
      $.ajax({
        type: 'POST',
        url: '../controllers/CambiarEstadoCuenta.php',
        data: { id_activar: userId, selected_role: selectedRole },
        success: function (response) {
          $("#iniciar").html(response);
          alert("Cuenta Activada con éxito");
        },
        error: function (error) {
          console.error('Error en la solicitud AJAX:', error);
        }
      });
    }


    function desactivarCuenta(userId, totalRoles, rolesList) {
      var VentanaSeleccionar = document.getElementById('VentanaAtom');
      var CerrarVentanaSeleccionada = document.getElementById('removeVentana'); // Reemplaza 'CerrarVentana' con el ID correcto
      var AbrirVentanas = document.getElementById('desactivar');


      if (parseInt(totalRoles) >= 2) {
        console.log("Entró al if" + totalRoles);
        // Agrega un evento de clic para abrir la ventana para cada botón 'AbrirVentana'
        VentanaSeleccionar.classList.add('flex');


        // Agrega un evento de clic para cerrar la ventana
        CerrarVentanaSeleccionada.addEventListener('click', () => {
          VentanaSeleccionar.classList.remove('flex');
        });


        // Si tiene más de un rol, mostrar un cuadro de diálogo personalizado
        var roali = rolesList.split(', ');

        // Rellenar el cuadro de selección con opciones
        var select = $('#selectRole');
        select.empty();
        roali.forEach(function (role) {
          select.append($('<option>', {
            value: role,
            text: role
          }));
        });

        // Manejar el evento del botón de aceptar
        $('#selectRoleBtn').on('click', function () {
          var selectedRole = $('#selectRole').val();
          if (selectedRole !== null) {
            // El usuario hizo una selección
            document.getElementById('VentanaAtom').classList.remove('flex');
            ConfirmoDesactivar(userId, selectedRole);
          }
        });
      } else {
        // Si tiene solo un rol, desactivar directamente
        ConfirmoDesactivar(userId);
      }
    }


    // Muestra los valores en la consola (puedes hacer lo que quieras con estos valores)
    function ConfirmoDesactivar(userId, selectedRole) {
      $.ajax({
        type: 'POST',
        url: '../controllers/CambiarEstadoCuenta.php',
        data: { id_desactivar: userId, selected_role: selectedRole },
        success: function (response) {
          $("#iniciar").html(response);
          alert("Cuenta Desactivada con éxito");
        },
        error: function (error) {
          console.error('Error en la solicitud AJAX:', error);
        }
      });
    }


    const checkboxes = document.querySelectorAll('.tabla_acciones_encabezado');

    // Agrega un evento de clic a cada checkbox
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('click', function () {
        manejarClic(checkbox);
      });
    });
  })();

</script>