$(document).ready(function() {
    $.ajax({
        url: "/api/sidebar",
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
        },
        dataType: "json",
        success: function(data) {
            // console.log("data contains: ", data);
            $('#promoCount').text(data.promocount);
            $('#pendingJewelry').text(data.pendingjewelry);
        },
        error: function(error) {
            console.log(error);
        }
    });
});