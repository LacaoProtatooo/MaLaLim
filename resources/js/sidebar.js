$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: '/api/sidebar',
        data: formData,
        processData: false,
        contentType: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: "json",
        success: function(data) {
            $('#promoCount').text(response.promocount);
            $('#pendingJewelry').text(response.pendingjewelry);
            
        },
        error: function(error) {
            console.log(error);
        }
    });
});