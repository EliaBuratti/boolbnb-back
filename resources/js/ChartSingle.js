const ctx = document.getElementById('singleApartmentViews');
const views = JSON.parse(ctx.getAttribute('data-set'));
console.log(views);
import Chart from "chart.js/auto";


/* new Chart(ctx, {
    type: 'bar',
    data: {
        labels: views.map(apartment => apartment[0]),
        datasets: [{
            data: views.map(apartment => apartment[1]),
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                ticks: {
                    stepSize: 1,
                    beginAtZero: true,
                },
            }
        },
        plugins: {
            legend: {
                display: false // Imposta a false per nascondere completamente la legenda
            }
        }
    }
}); */


// Funzione per ottenere il conteggio delle visualizzazioni mese per mese
function getMontlyViews(views) {
    const month = [
        'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
        'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
    ];

    const MonthViews = {};
    console.log(views);
    views.forEach((elemento) => {
        const data = new Date(elemento.created_at);
        const meseAnno = `${month[data.getMonth()]} ${data.getFullYear()}`;

        if (!MonthViews[meseAnno]) {
            MonthViews[meseAnno] = 0;
        }
        MonthViews[meseAnno]++;
    });

    return MonthViews;
}

const visualizzazioniMesePerMese = getMontlyViews(views);

// Estrai i mesi e le visualizzazioni dai views aggregati
const mesi = Object.keys(visualizzazioniMesePerMese);
const viewsVisualizzazioni = mesi.map((mese) => visualizzazioniMesePerMese[mese]);

// Configura e disegna il grafico a linee utilizzando Chart.js
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: mesi,
        datasets: [{
            label: 'Visualizzazioni per Mese',
            data: viewsVisualizzazioni,
            fill: false,
            borderColor: 'rgba(75, 192, 192, 1)', // Colore della linea
            borderWidth: 2,
            pointBackgroundColor: 'rgba(75, 192, 192, 1)', // Colore dei punti
            pointRadius: 5,
            pointHoverRadius: 7,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    precision: 0,
                }
            }
        }
    }
});
