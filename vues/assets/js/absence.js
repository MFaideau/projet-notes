function loadAbsenceChart() {
    var ctx = document.getElementById("absgraph").getContext('2d');
    var donnees = {
        labels: ["14sept", "21sept", "28sept", "5oct", "12oct", "19oct", "26oct","2nov","9nov","16nov","23nov","30nov","7dec","14dec","21dec","28dec","4janv","11janv","18janv","25janv","1fev","8fev","15fev","22fev","29fev","7mars","14mars","21mars","28mars","4avr","11avr","18avr","25avr","2mai","9mai","16mai","23mai","30mai","6juin","13juin"],
        datasets: [
            {
                label : "",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#b62224",
                borderColor: "#b62224",
                borderCapStyle: 'square',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'round',
                pointBorderColor: "#b62224",

                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "#b62224",
                pointHoverBorderColor: "#b62224",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 10,
                data: [0, 0, 0, 0, 0, 0, 0,0,1.75,0,0,0,0,0,0,0,0,0,0,12.75,0,0,0,0,0,0,0,4.5,0,0,0,0,0,0,0,12,0,0,0,0]
            }
        ]
    };
    Chart.defaults.global.legend.display = false;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: donnees,
        responsive: true,
        options: {
            title: {
                display: true,
                text: 'Evolution des absences'
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Nombres d'heures"
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Semaines"
                    }
                }],
                ticks: {
                    beginAtZero:true
                    }
                }
            }
    });
}