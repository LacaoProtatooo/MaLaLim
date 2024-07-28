$(document).ready(function(){
    
});

$('#loginForm').on('submit', function (e){
    e.preventDefault();
    var data = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: '/api/user/login',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function(response) {
            console.log(response);
            if (response.message === 'Login successful') {
                sessionStorage.setItem('auth_token', response.token);
                console.log("Login Success");
                
                // Redirect based on role
                if (response.isAdmin) {
                    window.location.href = adminHomeUrl; // Admin redirect
                } else {
                    window.location.href = userHomeUrl; // Regular user redirect
                }
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

$(document).on('click', '.Urders', function() {
    window.location.href = '/orderhistory';
});

function logout() {
    $.ajax({
        type: 'POST',
        url: '/api/user/logout',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token')
        },
        success: function(response) {
            console.log('Logged out successfully');
            sessionStorage.removeItem('auth_token');
            window.location.href = '/login';
        },
        error: function(xhr) {
            console.error('Logout failed:', xhr);
        }
    });
}

function showError(message) {
    $("#err").hide().html(message).fadeIn('slow');
}
