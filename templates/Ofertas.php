<!DOCTYPE html>
<html lang="en">
    <div class="Modal-Ofertas">
        <div class="productos-container">
            <div class="opciones-vol-busc">
                <i class="bx bx-chevron-left bx-x" onclick="closeModalOfertas()"></i>
                <input type="text" id="filtroNombre" placeholder="Filtrar por nombre o código">
            </div>
            <div class="scroll-inventario">
                <div class="articles-inventario">
        <div class="contenedor">
            <div class="product">
                <section class="imagen">
                    <img class="img" src="https://example.com/img/descarga__3_-removebg-preview.png" alt="">
                </section>
                <h2>Acetaminofen</h2>
                <p>Precio Original: <span class="original-price">$10000</span></p>
                <label for="discount">Descuento (%):</label>
                <input type="text" id="discount" class="discount-input">
                <button class="buton" onclick="applyDiscount()">
                    <span>Descuento</span>
                </button>
                <p>Precio con Descuento: <span class="discounted-price">$10000</span></p>
            </div>
        </div>
    
        <script>
            function applyDiscount() {
                var originalPrice = 10000;
                var discountPercentage = parseFloat(document.getElementById('discount').value);
    
                if (!isNaN(discountPercentage) && discountPercentage >= 0 && discountPercentage <= 100) {
                    var discountedPrice = originalPrice - (originalPrice * (discountPercentage / 100));
                    document.querySelector('.discounted-price').textContent = '$' + discountedPrice.toFixed(2);
                } else {
                    alert('Por favor, ingresa un descuento válido (entre 0 y 100).');
                }
            }
        </script>
    </div>
            </div></div></div>
</html>