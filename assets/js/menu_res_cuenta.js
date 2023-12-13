var nav_menu = document.querySelector("#menu");
var contenido = document.querySelector("#contenido");
var nav_menu_respo = document.querySelector(".menu-respon");

if (window.innerWidth <= 850) {
    menu_responsi();
}else{
    menu_responsi_total();
}

function menu_responsi(){
    nav_menu.style.display = "none";
    contenido.style.marginLeft = "3rem";
    nav_menu_respo.style.diplay = "flex";
    nav_menu_respo.classList.add("menu-respon-active");
}

function menu_responsi_total(){
    if (window.innerWidth <= 850) {
        
    }else{
        nav_menu.style.display = "flex";
        contenido.style.marginLeft = "0";
        nav_menu_respo.classList.remove("menu-respon-active");
    }
}

window.addEventListener("resize", function () {
    if (window.innerWidth <= 850) {
        menu_responsi();
    }else{
        menu_responsi_total();
    }
});