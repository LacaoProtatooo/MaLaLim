import { showLoadingModal, hideLoadingModal  } from './exportable.js';

import 'datatables.net-dt';

$(document).ready(function() {
    // DATATABLE and Structure
    var userTable = $('#usersTable').DataTable({
        ajax: {
            url: '/api/users', // Your endpoint to fetch user data
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'lname' },
            { data: 'fname' },
            { data: 'email' },
            { data: 'phone_number' },
            {
                data: 'actions',
                render: function(data) {
                    return data;
                }
            }
        ]
    });

    // Validation for Create Form
    $('#userForm').validate({
        rules: {
            fname: {
                required: true,
                maxlength: 255
            },
            lname: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            phone_number: {
                required: true,
                maxlength: 20
            }
        },
        messages: {
            fname: {
                required: "Please enter the first name",
                maxlength: "First name can not be longer than 255 characters"
            },
            lname: {
                required: "Please enter the last name",
                maxlength: "Last name can not be longer than 255 characters"
            },
            email: {
                required: "Please enter the email",
                email: "Please enter a valid email address",
                maxlength: "Email can not be longer than 255 characters"
            },
            phone_number: {
                required: "Please enter the phone number",
                maxlength: "Phone number can not be longer than 20 characters"
            }
        },
        submitHandler: function(form) {

            var data = $('#userForm')[0];
            let formData = new FormData(data);
            showLoadingModal();
            $.ajax({
                type: 'POST',
                url: '/api/user',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",

                success: function(user) {
                    console.log("user response contains: ", user);
                    document.getElementById('createusermodal').close();
                    userTable.row.add({
                        'id': user.id,
                        'lname': user.lname,
                        'fname': user.fname,
                        'email': user.email,
                        'address': user.address,
                        'phone_number': user.phone_number,
                        'actions': '<button class="btn btn-primary user-edit" data-id="' + user.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary user-delete" data-id="' + user.id + '">Deactivate</button>'
                    }).draw(false);
                    hideLoadingModal();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.user-edit', function(e) {
        e.preventDefault();
        showLoadingModal();

        var userId = $(this).data('id');
        // console.log('Edit button : user ID:', userId);

        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `/api/user/${userId}/edit`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#userno').val(data.id);
                $('#emailedit').val(data.email);
                $('#addressedit').val(data.address);
                $('#createdatedit').val(data.created_at);
                $('#fnameedit').val(data.fname);
                $('#lnameedit').val(data.lname);
                $('#phone_numberedit').val(data.phone_number);
                $('#birthdateedit').val(data.birthdate);
                $('#image_pathedit').val(data.image_path);
                $('#titleedit').val(data.title);

                var imageUrl = data.image_path ? `http://localhost:8000/${data.image_path}` : 'https://www.svgrepo.com/show/530585/user.svg';
                $('#imagePreview').attr('src', imageUrl);

                document.getElementById('editusermodal').showModal();
                hideLoadingModal();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    // Validation for Update Form
    $('#usereditForm').validate({
        rules: {
            fname: {
                required: true,
                maxlength: 255
            },
            lname: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            phone_number: {
                required: true,
                maxlength: 20
            }
        },
        messages: {
            fname: {
                required: "Please enter the first name",
                maxlength: "First name can not be longer than 255 characters"
            },
            lname: {
                required: "Please enter the last name",
                maxlength: "Last name can not be longer than 255 characters"
            },
            email: {
                required: "Please enter the email",
                email: "Please enter a valid email address",
                maxlength: "Email can not be longer than 255 characters"
            },
            phone_number: {
                required: "Please enter the phone number",
                maxlength: "Phone number can not be longer than 20 characters"
            }
        },
        submitHandler: function(form) {
            var userId = $('#userno').val();
            var data = $('#usereditForm')[0];
            let formData = new FormData(data);
            formData.append("_method", "PUT");

            console.log("User id: " + userId);
            console.log("Formdata:", formData);

            $.ajax({
                type: 'POST',
                url: `/api/user/${userId}`,
                data: formData,
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success: function(response) {
                    console.log("Response:", response);
                    document.getElementById('editusermodal').close();
                    userTable.ajax.reload();
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        }
    });

    // DEACTIVATE
    $(document).on('click', '.user-delete', function() {
        var userId = $(this).data('id');
        console.log('Delete button : user ID:', userId);

        // Confirm deletion
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                type: 'DELETE',
                url: `/api/user/${userId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    userTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Delete error:", error);
                }
            });
        }
    });

    // ACTIVATE
    $(document).on('click', '.user-activate', function() {
        var userId = $(this).data('id');
        console.log('Activate button : user ID:', userId);

        // Confirm activation
        if (confirm("Activate this user?")) {
            $.ajax({
                type: 'POST',
                url: `/api/user/activate/${userId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    userTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Activation error:", error);
                }
            });
        }
    });

    // PERMANENT DELETION
    $(document).on('click', '.user-permadelete', function() {
        var userId = $(this).data('id');
        console.log('Permanent Deletion button : user ID:', userId);

        // Confirm permanent deletion
        if (confirm("Permanently Delete this user?")) {
            $.ajax({
                type: 'POST',
                url: `/api/user/permadelete/${userId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    userTable.ajax.reload();
                },
                error: function(error) {
                    console.error("Permanent Deletion error:", error);
                }
            });
        }
    });
    // Promote
    $(document).on('click', '.user-promote', function() {
        var userId = $(this).data('id');


        // Confirm activation
        if (confirm("Promote this user?")) {
            $.ajax({
                type: 'POST',
                url: `/api/user/promote/${userId}`,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    console.log(response.message);
                    // Reload Table
                    userTable.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error Thrown:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Full Error Object:', xhr);
                }
            });
        }
    });

});
