const rasterElements = document.querySelectorAll('.scroll2 .raster');
const producElement = document.querySelector('.img-oferta .produc img');

rasterElements.forEach((raster) => {
  raster.addEventListener('click', () => {
    const imageUrl = raster.querySelector('img').getAttribute('src');
    producElement.setAttribute('src', imageUrl);
  });
});
