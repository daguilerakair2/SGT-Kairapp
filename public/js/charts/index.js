
// Obtener referencias a los elementos del DOM
let chartContainer = document.getElementById('chartContainer');
let ctx = document.getElementById('myChart');
let chartHTML = document.getElementById('chart');
let spinner = document.getElementById('spinner');
console.log('aaaa');

let chart = null;

// Función para generar el gráfico según la selección del <select>
function generateChart() {
    // console.log(selectedValue);
    // Eliminar el gráfico existente si lo hay
    // console.log(chart);
    if (chart) {
        chart.destroy();
        chartHTML.hidden = true;
    }

    // Generar el nuevo gráfico según el valor seleccionado
    // Crea el gráfico de barras
    const labels = Utils.months({count: 7});
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'My First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                borderWidth: 1,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
// Generar el gráfico inicialmente
generateChart();
