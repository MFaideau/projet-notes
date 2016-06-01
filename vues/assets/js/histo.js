function loadBar(varTab) {
    var donnees = JSON.parse(varTab);
    var ctx = document.getElementById("myChart").getContext('2d');
    var barChartData = {
        labels: ["0", "0.5", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5", "5.5", "6", "6.5", "7", "7.5", "8", "8.5", "9", "9.5", "10", "10.5", "11", "11.5", "12", "12.5", "13", "13.5", "14", "14.5", "15", "15.5", "16", "16.5", "17", "17.5", "18", "18.5", "19", "19.5", "20"],
        datasets: [{
            backgroundColor: "#b62224",
            strokeColor: "black",
            data:donnees
        }]
    };

    var barChartDemo = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        responsive: true,
        barValueSpacing: 2,
        options: {
            title: {
                display: true,
                text: 'Diagramme de notes'
            },
            legend: {
                display: false
            }
        }
    });
}