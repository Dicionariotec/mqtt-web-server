import Chart from 'chart.js/auto';

window.make_chart = function make_chart(id, labels, temperature, humidity) {
    var ctx = document.getElementById(id).getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'temperatura',
                    data: temperature,
                    borderColor: 'rgba(255, 0, 0, 1)',
                    backgroundColor: 'rgba(255, 102, 102, 1)',
                },
                {
                    label: 'umidade',
                    data: humidity,
                    borderColor: 'rgba(0, 0, 255, 1)',
                    backgroundColor: 'rgba(102, 102, 255, 1)',
                }
            ]
        },
        options: {}
    });
};