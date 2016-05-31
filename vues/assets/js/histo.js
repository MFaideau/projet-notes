function loadBar(varTab) {
    var ctx = document.getElementById("myChart").getContext('2d');
    
    var barChartData = {
        labels: ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"],
        datasets: [{
            backgroundColor: "#b62224",
            strokeColor: "black",
            data:varTab
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