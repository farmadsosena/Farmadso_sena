<?php

$consulsql = mysqli_query($conexion, "SELECT * FROM comentario ORDER BY idComentario ASC");

if ($consulsql) {
  if (mysqli_num_rows($consulsql) > 0) {
    while ($rad = mysqli_fetch_assoc($consulsql)) {
      echo '
      <tr>
              <td>
                <input type="checkbox">
              </td>

              <td>

                <div class="aut">
                  <img src="../assets/img/acetaminofén-500mg-caja-16-tabletas-tecnoquimicas-sa.jpg" alt="imagen">
                  <div class="aut-nametel">
                    <p>Nombre</p>
                    <p>23456123</p>
                  </div>
                </div>
                <p class="correo-notificacion">ss@gmail.com</p>

              </td>

              <td class="">
                <p>'.$rad["Comentario"].'
                </p>
              </td>

              <td>
                <p>'.$rad["fechaComentario"].'</p>
              </td>
            </tr>
            ';
    }
  } else {
    echo "No existen comentarios por ahora";
  }
}
?>