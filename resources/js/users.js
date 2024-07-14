import $ from 'jquery';
import 'datatables.net-dt';

$(function() {
    $('#usersTable').DataTable();
});


// CREATE
$(document).ready(function() {
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var data = $('#userForm')[0];
        let formData = new FormData(data);

        $.ajax({
            type: 'POST',
            url: '/api/user',
            data: formData,
            data: {
                lname: $('#lname').val(),
                fname: $('#fname').val(),
                email: $('#email').val(),
                phone_number: $('#phone_number').val(),
                password: $('#password').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
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

            }
        });
    });

});
