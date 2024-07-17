
$(document).ready(function(){
    $('#loginForm').on('submit', function (e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '/api/user/login',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: data,
            success: function(response) {
                console.log(response);
                if (response.message === 'Login successful') {
                    console.log("Login Success");
                } else {
                    showError("Username or Password Incorrect. Please Check");
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    showError("Invalid credentials");
                } else {
                    console.error("Error:", xhr);
                }
            }
        });
    });
});

function login() {
    
}

function showError(message) {
    $("#err").hide().html(message).fadeIn('slow');
}

