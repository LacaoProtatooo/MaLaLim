// $(document).ready(function() {
//     function createChart(chartType, apiUrl, canvasId, titleText, additionalOptions = {}) {
//         $.ajax({
//             url: apiUrl,
//             method: 'GET',
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
//                 'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
//             },
//             success: function(data) {
//                 try {
//                     var ctx = document.getElementById(canvasId).getContext('2d');
//                     var chart = new Chart(ctx, {
//                         type: chartType,
//                         data: {
//                             labels: data.labels,
//                             datasets: data.datasets
//                         },
//                         options: Object.assign({
//                             responsive: true,
//                             plugins: {
//                                 legend: {
//                                     position: 'top',
//                                 },
//                                 tooltip: {
//                                     enabled: true,
//                                 },
//                                 title: {
//                                     display: true,
//                                     text: titleText,
//                                     font: {
//                                         size: 18
//                                     }
//                                 }
//                             },
//                             scales: {
//                                 y: {
//                                     beginAtZero: true
//                                 }
//                             }
//                         }, additionalOptions)
//                     });
//                 } catch (e) {
//                     console.error('Error creating ' + chartType + ' chart:', e);
//                 }
//             },
//             error: function(xhr) {
//                 console.error('Error fetching data for ' + chartType + ' chart:', xhr.responseText);
//             }
//         });
//     }


//     // Bar Chart
//     createChart('bar', "/api/chart-bar", 'barChart', 'Bar Chart');
//     // Pie Chart
//     createChart('pie', "/api/chart-pie", 'pieChart', 'Pie Chart', { scales: {} });
//     // Line Chart
//     createChart('line', "/api/chart-line", 'lineChart', 'Line Chart');
// });

$(document).ready(function() {
    // Function to create charts
    function createChart(chartType, apiUrl, canvasId, titleText, additionalOptions = {}) {
        const token = sessionStorage.getItem('auth_token');
        if (!token) {
            console.error('No auth token found in sessionStorage');
            return;
        }

        $.ajax({
            url: apiUrl,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token,
            },
            success: function(data) {
                console.log(data);
                try {
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
                } catch (e) {
                    console.error('Error creating ' + chartType + ' chart:', e);
                }
            },
            error: function(xhr) {
                console.error('Error fetching data for ' + chartType + ' chart:', xhr.responseText);
            }
        });
    }

    // Wait for the token to be set before creating charts
    function initializeCharts() {
        const token = sessionStorage.getItem('auth_token');
        if (token) {
            // Create charts after ensuring token is available
            createChart('bar', "/api/chart-bar", 'barChart', 'Classification Analysis');
            createChart('pie', "/api/chart-pie", 'pieChart', 'Courier Earnings', { scales: {} });
            createChart('line', "/api/chart-line", 'lineChart', 'Line Chart');
        } else {
            console.error('Auth token not available. Please log in first.');
        }
    }

    // Initialize charts after ensuring the document is ready
    $(document).ready(initializeCharts);
});

