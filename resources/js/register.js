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
                pattern: /^[0-9]{11}$/
            },
            birthdate: {
                required: false
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
                minlength: "Your address must be at least 5 characters long"
            },
            phone_number: {
                required: "Please enter your phone number",
                minlength: "Your phone number must be exactly 11 digits long",
                pattern: "Phone number must be 11 digits"
            },
            birthdate: {
                required: "Please enter your birthdate"
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
                    console.log("Registration Successful: ", user);
                    document.getElementById('registeruserModal').close();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});
