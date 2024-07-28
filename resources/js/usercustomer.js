function previewImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
    function showModal(message, isSuccess = true) {
        // Set the message in the modal
        document.getElementById('modalMessage').textContent = message;
        
        // Change modal appearance based on success or error
        const modal = document.getElementById('my_modal_2');
        if (modal) {
            modal.showModal(); // Show the modal
            
            // Optionally, you can customize the modal's appearance
            const modalBox = modal.querySelector('.modal-box');
            if (isSuccess) {
                modalBox.classList.add('bg-green-100', 'text-green-700');
                modalBox.classList.remove('bg-red-100', 'text-red-700');
            } else {
                modalBox.classList.add('bg-red-100', 'text-red-700');
                modalBox.classList.remove('bg-green-100', 'text-green-700');
            }
        } else {
            console.error("Modal element not found.");
        }
    }

    $.ajax({
        type: 'GET',
        url: '/api/userprofile',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
        },
        dataType: "json",

        success: function (data) {
            $('#userfullname').text(data.fname + ' ' + data.lname)
            $('#fname').val(data.fname)
            $('#lname').val(data.lname)
            $('#address').val(data.address)
            $('#phone_number').val(data.phone_number)
            $('#birthdate').val(data.birthdate)
            $('#email').val(data.email)
            $('#imagePreview').attr('src', data.imagePreview);
        },
        error: function (error) {
            console.error('Error fetching user profile:', error);
        }
    });


    $('#updateuserForm').validate({
        rules: {
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
                minlength: 5
            },
            phone_number: {
                required: true,
                minlength: 11
            },
            new_password: {
                minlength: 8
            },
            confirm_new_password: {
                equalTo: "#new_password"
            }
        },
        messages: {
            fname: {
                required: "Please enter your first name",
                minlength: "Your first name must consist of at least 2 characters"
            },
            lname: {
                required: "Please enter your last name",
                minlength: "Your last name must consist of at least 2 characters"
            },
            address: {
                required: "Please enter your address",
                minlength: "Your address must consist of at least 5 characters"
            },
            phone_number: {
                required: "Please enter your phone number",
                minlength: "Your phone number must be at least 11 digits long"
            },
            new_password: {
                minlength: "Your password must be at least 8 characters long"
            },
            confirm_new_password: {
                equalTo: "Your passwords do not match"
            }
        },
        submitHandler: function(form) {

            var formData = new FormData($(form)[0]);
            // for (var pair of formData.entries()) {
            //     if (pair[1] instanceof File) {
            //         console.log(pair[0] + ': [File] ' + pair[1].name);
            //     } else {
            //         console.log(pair[0] + ': ' + pair[1]);
            //     }
            // }

            $.ajax({
                type: 'POST',
                url: '/api/updateProfile',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + sessionStorage.getItem('auth_token'),
                },
                success: function(response) {
                    
                    console.log('Profile Updated Successfully');
                    $('#userfullname').text(response.fname + ' ' + response.lname);
                    $('#fname').val(response.fname);
                    $('#lname').val(response.lname);
                    $('#address').val(response.address);
                    $('#phone_number').val(response.phone_number);
                    $('#birthdate').val(response.birthdate);
                    
                    if (response.image_path) {
                        $('#imagePreview').attr('src', response.image_path);
                    }
                    
                    showModal('Profile updated successfully!', true);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error('Error updating profile:', error);
                }
            });
        }
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('my_modal_2');
        if (modal) {
            modal.close();
        }
    });

    // Deactivate User
    $('#deactivateAccount').on('click', function(e) {
        e.preventDefault(); 

        if (confirm('Are you sure you want to deactivate your account?')) {
            $.ajax({
                type: 'POST',
                url: '/api/user/deactivate',
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    // 'Authorization': 'Bearer ' + $('meta[name="auth-token"]').attr('content') // Add your token here if using Bearer Authentication
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Your account has been deactivated successfully.');
                        window.location.href = '/login'; 
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(error) {
                    console.error('Error deactivating account:', error);
                    alert('An error occurred while trying to deactivate your account. Please try again later.');
                }
            });
        }
    });


});

