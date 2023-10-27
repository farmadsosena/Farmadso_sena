document.getElementById('deliverySelector').addEventListener('change', function() {
    var selectedOption = this.value;
    
    // Oculta todos los elementos por defecto
    document.querySelectorAll('.headerDelivery, .mainDelivery, .footerDelivery').forEach(function(el) {
      el.style.display = 'none';
    });
    
    // Muestra/oculta los elementos según la opción seleccionada
    if (selectedOption === 'usuario') {
      // Muestra los elementos relacionados con usuario
    } else if (selectedOption === 'domiciliario') {
      // Muestra los elementos relacionados con domiciliario
      document.querySelectorAll('.headerDelivery, .mainDelivery, .footerDelivery').forEach(function(el) {
        el.style.display = 'flex';
      });
    }
  });