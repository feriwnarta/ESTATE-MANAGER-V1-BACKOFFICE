// initialized pie chart
$(document).ready(function () {
    let ctx = document.getElementById('pie').getContext('2d');
    var chartExist = Chart.getChart('pie');
    let fillColorChart = 'rgba(35, 240, 9, 0.1)';
    let borderColorChart = 'rgb(240, 68, 56)';
    if (chartExist != undefined) chartExist.destroy();
    let myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100, 200],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 0

            }]
        },
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
    });
});
