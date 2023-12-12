var dataVentasMensualesBar = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
    datasets: [{
        label: 'Ventas Mensuales',
        data: [1200, 1500, 1300, 1400, 1600],
        backgroundColor: 'rgba(75, 192, 192, 0.6)'
    }]
};

var opcionesVentasMensualesBar = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Ventas'
            }
        },
        x: {
            title: {
                display: true,
                text: 'Mes'
            }
        }
    }
};

var ctxVentasMensualesBar = document.getElementById('ventasMensualesBarChart').getContext('2d');
var chartVentasMensualesBar = new Chart(ctxVentasMensualesBar, {
    type: 'bar',
    data: dataVentasMensualesBar,
    options: opcionesVentasMensualesBar
});


var dataIngresosAnualesLine = {
    labels: ['2020', '2021', '2022', '2023'],
    datasets: [{
        label: 'Ingresos Anuales',
        data: [15000, 18000, 22000, 25000],
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 2,
        pointBackgroundColor: 'rgba(75, 192, 192, 1)'
    }]
};

var opcionesIngresosAnualesLine = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Ingresos Anuales'
            }
        },
        x: {
            title: {
                display: true,
                text: 'Año'
            }
        }
    }
};

var ctxIngresosAnualesLine = document.getElementById('ingresosAnualesLineChart').getContext('2d');
var chartIngresosAnualesLine = new Chart(ctxIngresosAnualesLine, {
    type: 'line',
    data: dataIngresosAnualesLine,
    options: opcionesIngresosAnualesLine
});


// Graficas generales
document.addEventListener("DOMContentLoaded", function () {

    function drawChart(ctx, labels, data, backgroundColor, borderColor, totalGeneral) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.concat('Total'),
                datasets: [{
                    label: 'Cantidad Vendida',
                    data: data.map(entry => entry.total_vendido),
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
                    borderWidth: 1
                }, {
                    label: 'Precio Unitario',
                    data: data.map(entry => entry.precio_unitario).concat(0),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    hidden: true // Ocultar por defecto
                }, {
                    label: 'Subtotal',
                    data: data.map(entry => entry.subtotal).concat(0),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1,
                    hidden: true // Ocultar por defecto
                }, {
                    label: 'Total Ganancias',
                    data: Array(labels.length).fill(0).concat(totalGeneral),
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                    borderColor: 'rgba(0, 128, 0, 1)',
                    borderWidth: 1,
                    hidden: true // Ocultar por defecto
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                onClick: function(e) {
                    var activePoints = this.getElementsAtEvent(e);
                    if (activePoints.length > 0) {
                        var clickedDatasetIndex = activePoints[0].datasetIndex;
                        this.data.datasets.forEach(function(dataset, index) {
                            if (index === clickedDatasetIndex) {
                                dataset.hidden = false;
                            } else {
                                dataset.hidden = true;
                            }
                        });
                        this.update();
                    }
                }
            }
        });
    }

    fetch('../controllers/consultaGrafica.php')
        .then(response => response.json())
        .then(dataFromServer => {
            drawChart(
                document.getElementById('chartSemanal').getContext('2d'),
                dataFromServer.semanal.map(entry => entry.nombre_medicamento),
                dataFromServer.semanal,
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 1)',
                dataFromServer.total_general_semanal
            );

            drawChart(
                document.getElementById('chartMensual').getContext('2d'),
                dataFromServer.mensual.map(entry => entry.nombre_medicamento),
                dataFromServer.mensual,
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 1)',
                dataFromServer.total_general_mensual
            );
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
});
