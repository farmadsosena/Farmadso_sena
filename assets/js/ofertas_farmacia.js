document.querySelector(".valordescuento").addEventListener("input",function(){
    var valor = this.value;

    var numeroValor = parseFloat(valor);

    if (numeroValor > 100) {
        this.value = "100";
    }
});