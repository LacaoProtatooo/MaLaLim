$(document).ready(function() {
    const authToken = sessionStorage.getItem('auth_token');

    // Check if the auth token is available
    if (!authToken) {
        console.error('Auth token not available. Please log in first.');
        return;
    }

    $.ajax({
        url: "/api/sidebar",
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + authToken,
        },
        dataType: "json",
        success: function(data) {
            $('#promoCount').text(data.promocount);
            $('#pendingJewelry').text(data.pendingjewelry);
        },
        error: function(error) {
            console.log(error);
            if (error.status === 401) {
                console.error('Unauthorized access. Please check your credentials.');
            }
        }
    });
});
