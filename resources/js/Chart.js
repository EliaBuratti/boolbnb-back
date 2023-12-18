const ctx = document.getElementById('chartViews');
const views = JSON.parse(ctx.getAttribute('data-set'));
console.log(views);
import Chart from "chart.js/auto";

let maxYval = [];
for (let i = 0; i < views.length; i++) {
    const view = views[i][1];
    //console.log(view);
    maxYval.push(view);
}
console.log(maxYval);

maxYval = Math.max(...maxYval);

console.log(maxYval);

maxYval = maxYval + 10;

console.log(maxYval);


new Chart(ctx, {
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
                max: maxYval
            }
        },
        plugins: {
            legend: {
                display: false // Imposta a false per nascondere completamente la legenda
            }
        }
    }
});
