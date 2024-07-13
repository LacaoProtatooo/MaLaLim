import $ from 'jquery';
import 'datatables.net-dt';

$(function() {
    $('#usersTable').DataTable();
});

$(document).ready(function() {
    $('#userForm').on('click', function (e) {
        e.preventDefault();
        var data = $('#userForm')[0];
        console.log(data);
        let formData = new FormData(data);
        console.log(formData);
        for (var pair of formData.entries()) {
            console.log(pair[0] + ', ' + pair[1]);
        }

        $.ajax({
            type: 'POST',
            url: '/api/admin/user/store',
            data: formData,
            // data: {
            //     lname: $('#lname').val(),
            //     fname: $('#fname').val(),
            //     email: $('#email').val(),
            //     phone_number: $('#phone_number').val(),
            //     password: $('#password').val(),
            //     password_confirmation: $('#floating_repeat_password').val()
            // },
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            
            success: function(user) {
                $('#createusermodal').close();
                $('#usersTable').DataTable().row.add([
                    user.lname,
                    user.fname,
                    user.email,
                    user.phone_number,
                    '<button class="btn btn-primary editUser" data-id="' + user.id + '">Edit</button> <button class="btn btn-danger deleteUser" data-id="' + user.id + '">Delete</button>'
                ]).draw(false);
            },
            error: function(error) {
                console.log(error);
                // console.log(xhr.responseJSON); // Log the entire responseJSON object

                // if (xhr.responseJSON && xhr.responseJSON.errors) {
                //     var errors = xhr.responseJSON.errors;
                //     for (var field in errors) {
                //         alert(errors[field][0]);
                //     }
                // } else {
                //     alert('An unexpected error occurred.');
                // }
            }
        });
    });

});
