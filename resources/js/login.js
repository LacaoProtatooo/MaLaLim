$(document).ready(function(){
 
});

$('#loginForm').on('submit', function (e){
    window.authToken = null;
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

                sessionStorage.removeItem('auth_token');
                sessionStorage.setItem('auth_token', response.auth_token);
                console.log("Login Success:", response.auth_token);

                showSuccess("Login successful! Redirecting...");

                // Redirect based on role
                setTimeout(() => {
                    if (response.isAdmin) {
                        window.location.href = adminHomeUrl;
                    } else {
                        window.location.href = userHomeUrl;
                    }
                }, 2000);
            } else {
                showError("Username or Password Incorrect. Please Check");
            }
        },
        error: function(xhr) {
            // Add Window Here
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

function logout() {
    $.ajax({
        type: 'POST',
        url: '/api/user/logout',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token')
        },
        success: function(response) {
            console.log('Logged out successfully : ', sessionStorage.getItem('auth_token'));
            sessionStorage.removeItem('auth_token');

            window.location.href = '/login';
        },
        error: function(xhr) {
            console.error('Logout failed:', xhr);
        }
    });
}

$(document).on('click', '.Urders', function() {
    window.location.href = '/orderhistory';
});

function showSuccess(message) {
    document.getElementById('modalMessage').textContent = message;
    const modal = document.getElementById('my_modal_2');
    if (modal) {
        modal.showModal();
    } else {
        console.error("Modal element not found.");
    }
}

function showError(message) {
    document.getElementById('modalMessage').textContent = message;
    
    const modal = document.getElementById('my_modal_2');
    if (modal) {
        modal.showModal();
    } else {
        console.error("Modal element not found.");
    }
}


document.getElementById('closeModal').addEventListener('click', function() {
    const modal = document.getElementById('my_modal_2');
    modal.close();
});
