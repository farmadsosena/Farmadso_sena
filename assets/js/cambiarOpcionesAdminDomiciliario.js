    var icons = document.querySelectorAll(".navAdminProfile span");
    var mainContent = document.getElementById("mainContent");
    var sectionMainContent = document.getElementById("sectionMain");
    var sectionIcon2Content = document.getElementById("sectionIcon2");
    var sectionIcon3Content = document.getElementById("sectionIcon3");

    // Manejador de clic para cada icono
    icons.forEach(function (icon) {
        icon.addEventListener("click", function () {
            // Resalta el icono seleccionado y desresalta los demás
            icons.forEach(function (otherIcon) {
                otherIcon.classList.remove("selected");
            });
            icon.classList.add("selected");

            // Cambia el contenido en el área principal según el icono clicado
            switch (icon.id) {
                case "icon1":
                    changeMainContent(sectionMainContent.innerHTML);
                    break;
                case "icon2":
                    changeMainContent(sectionIcon2Content.innerHTML);
                    break;
                case "icon3":
                    changeMainContent(sectionIcon3Content.innerHTML);
                    break;
            }
        });
    });

    // Función para cambiar el contenido en el área principal
    function changeMainContent(content) {
        mainContent.innerHTML = content;
    }

