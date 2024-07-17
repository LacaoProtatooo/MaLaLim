import $, { ajax } from 'jquery';
import 'datatables.net-dt';

// CREATE
$(document).ready(function() {
    // DATATABLE and Structure
    var userTable = $('#usersTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/users', // Your endpoint to fetch user data
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'lname' },
            { data: 'fname' },
            { data: 'email' },
            { data: 'phone_number' },
            {
                data: 'id',
                render: function(data) {
                    return '<button class="btn btn-primary user-edit" data-id="' + data + '">Edit</button> ' +
                           '<button class="btn btn-secondary user-delete" data-id="' + data + '">Deactivate</button>';
                }
            }
        ]
    });

    
    // CREATE
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var data = $('#userForm')[0];
        let formData = new FormData(data);

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
                console.log("user response contains: ",user);
                document.getElementById('createusermodal').close();
                userTable.row.add({
                    'id': user.id,
                    'lname': user.lname,
                    'fname': user.fname,
                    'email': user.email,
                    'phone_number': user.phone_number,
                    'actions': '<button class="btn btn-primary user-edit" data-id="' + user.id + '">Edit</button> ' +
                               '<button class="btn btn-secondary user-delete" data-id="' + user.id + '">Deactivate</button>'
                }).draw(false);
            },
            error: function(error) {
                console.log(error);

            }
        });
    });

    // DETAILS
    $(document).on('click', '.user-edit', function(e) {
        e.preventDefault();

        var userId = $(this).data('id');
        // console.log('Edit button : user ID:', userId);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/user/${userId}/edit`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#userno').val(data.id)
                $('#emailedit').val(data.email)
                $('#createdatedit').val(data.created_at)
                $('#fnameedit').val(data.fname)
                $('#lnameedit').val(data.lname)
                $('#phone_numberedit').val(data.phone_number)
                $('#birthdateedit').val(data.birthdate)

                document.getElementById('editusermodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $(document).on('submit', '#usereditForm', function (e) {
        e.preventDefault();
    
        var userId = $('#userno').val();
        var data = $('#usereditForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");
        
        console.log("User id: " + userId);
        console.log("Formdata:", formData);
    
        $.ajax({
            type: 'POST',
            url: `http://localhost:8000/api/user/${userId}`,
            data: formData,
            processData: false,
            contentType: false, 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    
            success: function(response) {
                // console.log("User ID:", userId)
                console.log("Response:", response);
                document.getElementById('editusermodal').close();
                userTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });
    

    // DELETE
    $(document).on('click', '.user-delete', function() {
        var userId = $(this).data('id');
        console.log('Delete button : user ID:', userId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                type: 'DELETE',
                url: `http://localhost:8000/api/user/${userId}`,
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


});
