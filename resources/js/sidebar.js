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
            // console.log("Promo response contains: ", data);
            
            // $('#promono').val(data.id);
        },
        error: function(error) {
            console.log(error);
        }
    });
});