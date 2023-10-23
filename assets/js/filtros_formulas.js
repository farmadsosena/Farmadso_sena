document.addEventListener('DOMContentLoaded', function() {
    const contenedores = document.getElementsByClassName('doctor');
    const divInteriores = document.getElementsByClassName('img');

    for (let i = 0; i < contenedores.length; i++) {
        contenedores[i].addEventListener('click', function() {
            divInteriores[i].classList.toggle("rotate");
        });
    }
});
