function loadAbsenceChart() {
    var ctx = document.getElementById("absgraph").getContext('2d');
    var donnees = {
        labels: ["1", "2", "3", "4", "5", "6", "7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52"],
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
                data: [5, 2, 6, 9, 9, 0, 3,10,17]
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