function loadBar() {
    var ctx = document.getElementById("myChart").getContext('2d');
    var BigData = {
        labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20"],
        dataSets: [{
            label: "GrapheBarres",
            backgroundColor: "rgba(255,99,132,0.2",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 1,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: [0, 0, 0, 0, 0, 10, 10, 10, 10, 10, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0],
        }]
    }
    var BarChart = new Chart(ctx, {
        type: 'bar',
        data: BigData
    });
}