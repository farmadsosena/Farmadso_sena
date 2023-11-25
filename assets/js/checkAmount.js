function consultarMonto(callback) {
    fetch('../models/amount.php')
        .then((response) => response.json())
        .then(data => {
            if (data.state === false) {
                window.location.href = "index.php";
            } else if (data.state === true) {
                const monto = data.amount;
    
                convertirPesosADolares(monto, function (pesoFinal) {
                    paypal.Buttons({
                        style: {
                            color: 'gold',
                            shape: 'pill',
                            label: 'pay'
                        },
                        createOrder: function (data, actions) {

                           
                            
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: pesoFinal // Monto de compra
                                    }
                                }]
                                
                            });

                           

                        },
                        onApprove: function (data, actions) {
                            actions.order.capture().then(function (detalles) {
                                document.getElementById('modalCargar').style.display ='flex';
                                fetch('../controllers/procesarCompra.php', {
                                    method: "POST",
                                    headers: {
                                        'Content-Type': 'application/json' // Corregido 'aplication' a 'application'
                                    },
                                    body: JSON.stringify({
                                        detalles: detalles
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success === true) {
                                        document.getElementById('modalCargar').style.display ='none';
                                        toastr.success('Compra realizada correctamente');
                                    }
                                })
                                .catch(error => {
                                    console.error('Hubo un error:', error);
                                });
                            });
                        },
                        onCancel: function (data) {
                            toastr.warning("Pago cancelado");
                            document.getElementById('modalCargar').style.display ='none';
                        }
                    }).render('#paypal-button-container');
                });
            }
        })
        .catch(error => {
            console.error('Hubo un error:', error);
        });
}


consultarMonto();

function convertirPesosADolares(cantidad, callback) {
    // Utilizamos una API para obtener la tasa de cambio actual del dólar
    $.ajax({
        url: 'https://api.exchangerate-api.com/v4/latest/USD',
        type: 'GET',
        success: function (data) {
            // Obtenemos la tasa de cambio actual
            var tasaCambio = data.rates.COP;

            // Realizamos la conversión
            var resultado = cantidad / tasaCambio;

            resultadoFinal = resultado.toFixed(2);

            // Llamamos a la devolución de llamada con el resultado
            callback(resultadoFinal);
        },
        error: function () {
            alert('No se pudo obtener la tasa de cambio actual.');
        }
    });
}


