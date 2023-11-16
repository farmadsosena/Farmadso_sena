const menus = document.querySelectorAll('.categoriasmenu');
const contenido = document.querySelector('.contenido-desplegable');
const linea = document.getElementById('linea');

menus.forEach((menu) => {
    menu.addEventListener('mouseover', () => {
        contenido.style.display = 'block';
        const randomColor = getRandomColor();
        linea.style.backgroundColor = randomColor;
    });
    
});

contenido.addEventListener('mouseover', () => {
    contenido.style.display = 'block';
});

contenido.addEventListener('mouseout', () => {
    contenido.style.display = 'none';
});

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}