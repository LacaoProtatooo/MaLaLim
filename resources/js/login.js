
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
                    localStorage.setItem('auth_token', response.token);
                    window.location.href = '/item';
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

    $('#logoutLink').on('click', function(e) {
        e.preventDefault();
        logout();
    });

});

function logout() {
    $.ajax({
        type: 'POST',
        url: '/api/user/logout',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + localStorage.getItem('auth_token'),
        },
        success: function(response) {
            console.log('Logged out successfully');
            localStorage.removeItem('auth_token');
            window.location.href = '/item';
        },
        error: function(xhr) {
            console.error('Logout failed:', xhr);
        }
    });
}

function showError(message) {
    $("#err").hide().html(message).fadeIn('slow');
}


