$(document).ready(function() {
    function createChart(chartType, apiUrl, canvasId, titleText, additionalOptions = {}) {
        $.ajax({
            url: apiUrl,
            method: 'GET',
            success: function(data) {
                var ctx = document.getElementById(canvasId).getContext('2d');
                var chart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: data.labels,
                        datasets: data.datasets
                    },
                    options: Object.assign({
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                enabled: true,
                            },
                            title: {
                                display: true,
                                text: titleText,
                                font: {
                                    size: 18
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }, additionalOptions)
                });
            },
            error: function(error) {
                console.error('Error fetching data for ' + chartType + ' chart:', error);
            }
        });
    }

    // Line Chart
    createChart('line', 'http://localhost:8000/api/chart-line', 'lineChart', 'NIGGA Chart');

    // Pie Chart
    createChart('pie', 'http://localhost:8000/api/chart-pie', 'pieChart', 'Cutie Pie Chart', { scales: {} });

    // Bar Chart
    createChart('bar', 'http://localhost:8000/api/chart-bar', 'barChart', 'Barsss Chart');
});
