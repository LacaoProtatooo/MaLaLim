
$(document).ready(function(){
    e.preventDefault();
    var data = $('#registerForm')[0];
    let formData = new FormData(data);

    $.ajax({
        type: 'POST',
            url: '/api/user',
            data: formData,
            processData: false,
            contentType: false, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",

            // UNDER CONSTRUCTION

            
    });

})