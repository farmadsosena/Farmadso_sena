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