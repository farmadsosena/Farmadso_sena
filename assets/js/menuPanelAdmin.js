
function mostrarContenido(id, element){
    pages = document.querySelectorAll('.page');
    items = document.querySelectorAll('.item');

    pages.forEach(page =>{
        page.classList.remove('visiblePage')
    })
    items.forEach(item =>{
        item.classList.remove('activeItem')
    })

    document.getElementById(id).classList.add('visiblePage')
    element.classList.add('activeItem')
}