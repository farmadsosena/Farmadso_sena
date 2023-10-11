function procesoCompra() {

    paypal.Buttons({
        style: {
            color: 'gold',
            shape: 'pill',
            label: 'pay'
        },
        createOrder: function (data, actions) {
        
            consultarMonto();
            return actions.order.create({
           
                purchase_units: [{
                    amount: {
                        value:   monto //Monto de compra
                    }
                }]
            })
        },
        onApprove: function (data, actions) {
            actions.order.capture().then(function (detalles) {
                console.log(JSON.stringify(detalles))


                return fetch('controllers/procesarCompra.php', {

                    method: "POST",
                    headers: {
                        'content-type': 'aplication/json'
                    }, body: JSON.stringify({
                        detalles: detalles
                    })
                })
            });
        },
        onCancel: function (data) {
            alert("Pago cancelado")
        }

    }).render('#paypal-button-container');
}

procesoCompra(); 