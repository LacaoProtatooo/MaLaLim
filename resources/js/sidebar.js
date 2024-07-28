$(document).ready(function() {
    var token = sessionStorage.getItem('auth_token');
    console.log("Retrieved token: ", token);

    if (!token) {
        console.error('No token found in sessionStorage.');
        showError('No authentication token found. Please log in again.');
        return; 
    }

    $.ajax({
        url: "/api/sidebar",
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + token,
        },
        dataType: "json",
        success: function(data) {
            $('#promoCount').text(data.promocount);
            $('#pendingJewelry').text(data.pendingjewelry);
        },
        error: function(xhr) {
            console.log(xhr);
            console.log(xhr.responseJSON); // Use responseJSON for detailed error message
            if (xhr.status === 401) {
                console.error('Unauthorized access. Please check your credentials.');
                showError('Unauthorized access. Please check your credentials or log in again.');
            } else {
                showError('An error occurred while fetching sidebar data.');
            }
        }
    });
});
