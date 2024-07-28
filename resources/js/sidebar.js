$(document).ready(function() {
    var token = sessionStorage.getItem('auth_token');
    console.log("token: ",token);
    
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
        error: function(error) {
            console.log(error);
            if (error.status === 401) {
                console.error('Unauthorized access. Please check your credentials.');
            }
        }
    });
});
