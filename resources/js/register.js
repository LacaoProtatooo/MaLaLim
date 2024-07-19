
$(document).ready(function(){
    $('#userregisterForm').on('submit', function (e) {
        e.preventDefault();
        var data = $('#userregisterForm')[0];
        let formData = new FormData(data);

        $.ajax({
            type: 'POST',
            url: '/api/user',
            data: formData,
            processData: false,
            contentType: false, 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",

            success: function(user) {
                console.log("Registration Successful Please Login User: ",user);
                document.getElementById('registeruserModal').close();
                // window.location.href = '/login';
            },
            error: function(error) {
                console.log(error);

            }
        });
    });

})