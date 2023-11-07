$(document).ready(function() {
  $('a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    
    var target = this.hash;

    $('html, body').animate({
      scrollTop: $(target).offset().top
    }, 1000);
  });
});

const detailsElements = document.querySelectorAll('.divhes .contenido details');

detailsElements.forEach((details) => {
    details.addEventListener('click', () => {
        detailsElements.forEach((otherDetails) => {
            if (otherDetails !== details) {
                otherDetails.removeAttribute('open'); // Cierra los otros detalles
            }
        });
    });
});
