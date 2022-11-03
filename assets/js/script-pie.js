// initialized pie chart
$(document).ready(function () {
    let ctx = document.getElementById('pie').getContext('2d');
    var chartExist = Chart.getChart('pie');
    if (chartExist != undefined) chartExist.destroy();
    let myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100, 200, 20],
                backgroundColor: [
                    'rgb(219, 239, 255)',
                    'rgb(143, 198, 242)',
                    'rgb(106, 180, 238)',
                    'rgb(68, 161, 233)',
                ],
                hoverOffset: 0

            }]
        },
        backgroundColor: [
            'rgb(219, 239, 255)',
            'rgb(143, 198, 242)',
            'rgb(106, 180, 238)',
            'rgb(68, 161, 233)',
        ],
    });
});
