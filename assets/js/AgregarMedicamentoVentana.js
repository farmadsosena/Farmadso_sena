var botonAbrirVentana = document.getElementById("abrirNewVentana");
var VentanaAbrir = document.getElementById("VentanaPropia");
var CerrarVentanA = document.getElementById("X22");

botonAbrirVentana.addEventListener("click", () => {
  VentanaAbrir.classList.add("aggdisplay");
});

CerrarVentanA.addEventListener("click", () => {
  VentanaAbrir.classList.remove("aggdisplay");
});

function CloseWindows(){
  VentanaAbrir.classList.remove("aggdisplay");
}

//MOSTRAR TODOS LOS DIAGNOSTICOS POSIBLES DEPENDIEDNO DEL CODIGO
$(document).ready(function () {
  $("#CodigoDiagnostico").on("input", function () {
    var query = $(this).val();

    if (query === "") {
      // Si el input está vacío, oculta el elemento resultados
      document.getElementById("resultados").classList.remove("agg");
      $("#resultados").html(""); // Limpia el contenido si es necesario
      return; // Sal de la función
    }

    $.ajax({
      type: "POST",
      url: "../controllers/CodigoDiagnostico.php",
      data: { query: query },
      success: function (data) {
        document.getElementById("resultados").classList.add("agg");
        $("#resultados").html(data);

        // Capturar el valor de data-diag y asignarlo al input al hacer clic en un elemento mauso-diagnee
        $(".mauso-diagnee").on("click", function () {
          var valor = $(this).data("codigo");
          var nombre = $(this).data("nombre");
          var id = $(this).data("ids");

          $("#CodeDiag").val(id);
          $("#CodigoDiagnostico").val(valor + " //  " + nombre);
          document.getElementById("resultados").classList.remove("agg");
        });
      },
    });
  });
});
//Final de codigo para diagnosticos esenciales

//MOSTRAR Y SACAR LA LISTA DE MEDICOS QUE HAY EN EL SISTEMA DEPENDIENDO DE LA TARJETA PROFESIONAL
$(document).ready(function () {
  $("#MedicoResponsable").on("input", function () {
    var caso = $(this).val();

    if (caso === "") {
      // Si el input está vacío, oculta el elemento resultados
      document.getElementById("resultados").classList.remove("agg");
      $("#medicosResult").html("");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../controllers/CodigoMedico.php",
      data: { query: caso },
      success: function (data) {
        document.getElementById("medicosResult").classList.add("agg");
        $("#medicosResult").html(data);

        // Capturar el valor de data-diag y asignarlo al input al hacer clic en un elemento mauso-diagnee
        $(".mauso-medicaa").on("click", function () {
          var valor = $(this).data("codigo");
          var nombre = $(this).data("nombre");
          var id = $(this).data("ids");

          $("#MedicoFinal").val(id);
          $("#MedicoResponsable").val(valor + " //  " + nombre);
          document.getElementById("medicosResult").classList.remove("agg");
        });
      },
    });
  });
});

//Final de codigo para doctor

document.addEventListener("DOMContentLoaded", function () {
  const cantidadMedicamentosInput = document.getElementById(
    "cantidadMedicamentos"
  );
  const mostrarMedicamentosButton =
    document.getElementById("cambiarMedicamento");
  const volverAlPrincipio = document.getElementById("volverAlPrincipio");
  const padreMedicamentos = document.querySelector(".padre-medicamentos");
  const scrollabi = document.querySelector(".scroll-abi");
  var indiceVisible = 0;

  function mostrarFormularioActual() {
    const medicamentos = document.querySelectorAll(".medicamentos-abilisco");

    if (medicamentos.length > 0) {
      medicamentos.forEach((medicamento, index) => {
        medicamento.style.display = index === indiceVisible ? "block" : "none";
      });

      // Incrementa el índice o vuelve al principio si alcanza el final
      indiceVisible = (indiceVisible + 1) % medicamentos.length;

      if (indiceVisible === 0) {
        // Muestra el botón de enviar
        document.getElementById("EnviarPorComplero").style.display = "block";
      }
    }
  }

  //Mostrar el boton de continuar
  cantidadMedicamentosInput.addEventListener("input", function () {
    const cantidad = parseInt(cantidadMedicamentosInput.value);

    if (!isNaN(cantidad) && cantidad > 0) {
      mostrarMedicamentosButton.style.display = "block";
    } else {
      mostrarMedicamentosButton.style.display = "none";
      document.getElementById("EnviarPorComplero").style.display = "none";
    }
  });

  //Mostrar el conteendore donde se encuentra el formulario de medicmanrtos
  mostrarMedicamentosButton.addEventListener("click", function () {
    if (padreMedicamentos.style.display === "none") {
      // Si el padre-medicamentos está oculto, lo mostramos
      padreMedicamentos.classList.remove("abrir");
      scrollabi.classList.remove("cerrar");
    } else {
      padreMedicamentos.classList.add("abrir");
      scrollabi.classList.add("cerrar");
      mostrarFormularioActual();
    }
  });

  //Mostrar el conteendore donde se encuentra el formulario de medicmanrtos
  volverAlPrincipio.addEventListener("click", function () {
    padreMedicamentos.classList.remove("abrir");
    scrollabi.classList.remove("cerrar");
  });

  cantidadMedicamentosInput.addEventListener("input", function () {
    const cantidad = parseInt(cantidadMedicamentosInput.value);

    if (cantidad > 8) {
      alert(
        "Imposible hacer esta formula, no debe llevar tantos medicamentos en una sola formula. Redondeando...."
      );
      document.getElementById("cantidadMedicamentos").value = cantidad;
    } else {
      // Limpiar el contenedor padre-medicamentos
      padreMedicamentos.innerHTML = "";

      if (!isNaN(cantidad) && cantidad > 0) {
        for (let i = 1; i <= cantidad; i++) {
          const contenedorMedicamento = document.createElement("section");
          contenedorMedicamento.className = "medicamentos-abilisco scrall";

          // Agregar el contenido específico para cada contenedor
          contenedorMedicamento.innerHTML = `
          <div class="mauso">
            <p>Nombre del medicamento ${i}</p>
            <div>Escriba en este espacio el nombre completo del medicamento que hay en formula</div>
            <input type="text" name="Medicamento${i}" id="NombreMedicamento${i}" placeholder="Nombre del medicamento" class="mauso-texto">
            <section id="medicamento${i}" class="mauso-resultados scrall fored">
             
            </section>
          </div>
          <!-- Relleno de input mediamos -->
          <section class="flex-mauso">
            <section class="mauso-boom">
              <div class="mauso">
                <p>Codigo del medicamento</p>
                <!-- <div>Es posible que el codigo no aparezca en su formula, no rellene esta opción entonces</div> -->
                <input type="text" name="codigo${i}" id="codigoMedicamento${i}" placeholder="Codigo basico" class="mauso-texto">
              </div>
            </section>
            <section class="mauso-boom">
              <div class="mauso">
                <p>Cantidad establecida</p>
                <input type="text" name="cantidad${i}" id="" placeholder="Cantidad en numeros" class="mauso-texto encojer" accept=".png, .jpg,">
              </div>
            </section>
          </section>
          <!-- Final del contenedor con input madianos -->

          <!-- Relleno de input mediamos -->
          <section class="flex-mauso">
            <section class="mauso-boom">
              <div class="mauso">
                <p>Concentración</p>
                <!-- <div>Es posible que el codigo no aparezca en su formula, no rellene esta opción entonces</div> -->
                <input type="text" name="concentracion${i}" id="" placeholder="Concentracion del medicamento" class="mauso-texto">
              </div>
            </section>
            <section class="mauso-boom">
              <div class="mauso">
                <p>Via del medicamento</p>
                <input type="text" name="via${i}" id="" placeholder="Via" class="mauso-texto encojer" accept=".png, .jpg,">
              </div>
            </section>
          </section>
          <!-- Final del contenedor con input madianos -->

          <div class="mauso">
            <p>Posologia</p>
            <textarea name="posologia${i}" id="" cols="30" rows="10" class="mauso-texto rezine-none" placeholder="Cada cuanto debe tomar el medicamento"></textarea>
          </div>
        `;

          padreMedicamentos.appendChild(contenedorMedicamento);
        }

        for (let i = 1; i <= cantidad; i++) {
          $(document).ready(function () {
            const nombreMedicamentoInput = document.getElementById(
              `NombreMedicamento${i}`
            );
            const codigoMedicamentoInput = document.getElementById(
              `codigoMedicamento${i}`
            );
            const ventanaMedicamentos = document.getElementById(
              `medicamento${i}`
            );

            $(nombreMedicamentoInput).on("input", function () {
              var query = $(this).val();

              if (query === "") {
                // Si el input está vacío, oculta el elemento resultados
                ventanaMedicamentos.classList.remove("agg");
                $(ventanaMedicamentos).html("");
                return;
              }

              $.ajax({
                type: "POST",
                url: "../controllers/nombreMedicamentos.php",
                data: { query: query },
                success: function (data) {
                  // console.log(ventanaMedicamentos);
                  ventanaMedicamentos.classList.add("agg");
                  $(ventanaMedicamentos).html(data);

                  //Al dar click en el contenedor de resultados, el valor pasa al contenedor ""  para enviar a la base de datos
                  $(".mauso-diagnee").on("click", function () {
                    var valor = $(this).data("codigo");
                    var nombre = $(this).data("nombre");
                    var id = $(this).data("ids");

                    $("#CodeDiag").val(id);
                    $("#CodigoDiagnostico").val(valor + " //  " + nombre);
                    document
                      .getElementById("resultados")
                      .classList.remove("agg");
                  });


                  
                },
              });
            });
          });
        }
      }
    }
  });
  //Final de addEvenListener para agregar dinamicamente los contenedores
});



// funciones para cargar las formulas



document.addEventListener("DOMContentLoaded", function () {
  var Medicamentos = document.querySelector("#MedicamentosAdd"); // Usar querySelector para seleccionar un elemento por su ID
 

  Medicamentos.addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(Medicamentos); // Cambiar 'formData' a 'FormData'

    fetch("../controllers/registroFormulas.php", {
      method: "POST", // Especificar el método POST para enviar datos al servidor
      body: formData, // Enviar los datos del formulario
    })
    .then((response) => {
      if (!response.ok) {
        throw new Error("La solicitud no pudo completarse correctamente.");
      }
      return response.json();
    })
      .then((data) => {
    
          console.log("registro exitoso");// Corregir "existoso" a "exitoso"
          CloseWindows();
          cargarContenido()
         
       
      })
      .catch((error) => {
        console.log("error en la solicitud", error);
      });
  });
});




function cargarContenido() {
  fetch("../controllers/cargar.php", {
      method: "GET",
  })
  .then(response => {
      if (!response.ok) {
          throw new Error("La solicitud no pudo completarse correctamente.");
      }
      return response.text();
  })
  .then(data => {
      document.getElementById("LLEGARFR").innerHTML = data;
  })
  .catch(error => {
      console.error("Error al cargar el contenido:", error);
      alert("Error al cargar el contenido.");
  });
}

function EliminarFormula(){


  
}





$(document).ready(function () {
  cargarContenido();
});
