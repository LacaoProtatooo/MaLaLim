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
    createChart('line', "/api/chart-line", 'lineChart', 'Line Chart');

    // Pie Chart
    createChart('pie', "/api/chart-pie", 'pieChart', 'Pie Chart', { scales: {} });

    // Bar Chart
    createChart('bar', "/api/chart-bar", 'barChart', 'Bar Chart');
});
