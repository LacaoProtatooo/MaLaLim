$(document).ready(function() {
    $('#userregisterForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: '#passwordregister'
            },
            fname: {
                required: true,
                minlength: 2
            },
            lname: {
                required: true,
                minlength: 2
            },
            address: {
                required: true,
                minlength: 2
            },
            phone_number: {
                required: true,
                minlength: 11,
                maxlength: 11, // Ensure exact length
                digits: true // Use digits rule for phone number
            },
            birthdate: {
                required: true,
                date: true // Validate the date format
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please confirm your password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Passwords do not match"
            },
            fname: {
                required: "Please enter your first name",
                minlength: "Your first name must be at least 2 characters long"
            },
            lname: {
                required: "Please enter your last name",
                minlength: "Your last name must be at least 2 characters long"
            },
            address: {
                required: "Please enter your address",
                minlength: "Your address must be at least 2 characters long"
            },
            phone_number: {
                required: "Please enter your phone number",
                minlength: "Your phone number must be exactly 11 digits long",
                maxlength: "Your phone number must be exactly 11 digits long",
                digits: "Phone number must be exactly 11 digits"
            },
            birthdate: {
                required: "Please enter your birthdate",
                date: "Please enter a valid date"
            }
        },
        submitHandler: function(form) {
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
                    sessionStorage.setItem('auth_token', user.token);
                    showModal("Registration Successful", "You have been successfully registered.");
                    
                    document.getElementById('registeruserModal').close();
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        showModal("Error", "Invalid credentials");
                    } else {
                        console.error('Error:', xhr);
                    }
                }
            });
        }
    });

    function showModal(title, message) {
        const modal = document.getElementById('my_modal_2');
        const modalMessage = document.getElementById('modalMessage');
        const modalTitle = modal.querySelector('h3');

        if (modal && modalMessage && modalTitle) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            modal.showModal();
        } else {
            console.error('Modal elements not found.');
        }
    }

    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('my_modal_2');
        if (modal) {
            modal.close();
        }
    });
});
