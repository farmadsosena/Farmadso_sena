<?php

include '../config/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_POST['dataMedico'])) {
        // Obtener el valor de dataMedico
        $dataMedico = $_POST['dataMedico'];


        // Ejemplo: Obtener información de un médico desde la base de datos
        $query = mysqli_query($conexion, "SELECT * FROM medicos WHERE idmedico = $dataMedico");
        $medico = mysqli_fetch_assoc($query);

        $idM = $medico['idusuario'];

        $InfoM = mysqli_query($conexion, "SELECT * FROM usuarios WHERE idusuario = $idM");
        $row = mysqli_fetch_assoc($InfoM);




$html = "       
      <div class='card_info'>
      <img class='closeWionds' src='../assets/img/close.png' alt='' onclick='removerClaseActiva()'>

                <div class='infoMedico'>
                  <h1 class='title_infoMedico'>Medico</h1>
                  <div class='medico'>
                    <img class='foto_medico' src='../assets/img/medico_img.jpg' alt=''>
                    <p class='name_medico'>
                      {$row['nombre']} {$row['apellido']}
                    </p>
                  </div>
                  <div class='datos_medicoss'>
                    <div class='tarjeta '>
                      <p class='T_name'>Tarjeta profesional</p>
                      <p class='T_number'>{$medico['identificacionprofesional']}</p>
                    </div>
                    <div class='especialidad'>
                      <p class='E_name'>Especialidad</p>
                      <p class='E_espe'>{$medico['especialidad']}</p>
                    </div>

                  

                  </div>

                </div>
                <div class='infoFormula'>
                  <div class='contendor_info_formula'>
                    <h2>Datos Personales</h2>
                    <div class='datos_user'>

                      <div class='first_line_user'>
                        <div class='content_user'>
                          <p class='subtitle_user'>Nombre paciente</p>
                          <p class='contenido'>Nicolas Caicedo</p>
                        </div>

                        <div class='content_user'>
                          <p class='subtitle_user'>Identificación</p>
                          <p class='contenido'>1006537933</p>
                        </div>

                        <div class='content_user'>
                          <p class='subtitle_user'>Telefono</p>
                          <p class='contenido'>3115866621</p>
                        </div>

                        <div class='content_user'>
                          <p class='subtitle_user'>Fecha nacimiento</p>
                          <p class='contenido'>05/11/2002</p>
                        </div>
                      </div>


                      <div class='second_line_user'>
                        <div>
                          <p class='content_user'>Fecha de orden</p>
                          <p class='contenido'>11/09/23</p>
                        </div>
                        <div>
                          <p class='content_user'>Edad actual</p>
                          <p class='contenido'>21 años</p>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class='contendor_info_formula'>
                    <h2>Datos de afiliación</h2>
                    <div class='datos_afilicion'>
                      <div>
                        <p class='subtitle_user'>Entidad</p>
                        <p class='contenido'>SALUCOOP</p>
                      </div>

                      <div>
                        <p class='subtitle_user'>Plan de beneficios</p>
                        <p class='contenido'>prepagado</p>
                      </div>

                      <div>
                        <p class='subtitle_user'>Tipo de afiliación</p>
                        <p class='contenido'>Beneficiario</p>
                      </div>

                      <div>
                        <p class='subtitle_user'>Causa externa</p>
                        <p class='contenido'>Enfermedad general</p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <h2>Diagnostico encontrados</h2>
                    <div>
                      <p>Descripción del diagnostico</p>
                      <p class='contenido'>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ducimus nulla optio voluptas, vel
                        quae ipsa est fugiat voluptates! Ducimus dicta a modi eum incidunt libero temporibus quidem
                        officiis itaque aliquam.</p>
                    </div>
                  </div>
                  <div class='contendor_info_formula'>
                    <h2>Medicamentos</h2>
                    <div class='content_medicamentos'>

                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/loratadina.webp' class='medicamento_img' alt=''>
                        <p>Loratadina</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/Naproxeno.webp' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>


                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>

                      <div class='medicamento'>
                        <img src='../assets/img/ibuprofeno.png' class='medicamento_img' alt=''>
                        <p>Ibuprofeno</p>
                        <p class='state_med'>Disponible</p>
                      </div>


                    </div>
                  </div>
                </div>
              </div>";
              echo $html;
}
}