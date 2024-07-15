import $ from 'jquery';
import 'datatables.net-dt';

// CREATE
$(document).ready(function() {
    // DATATABLE
    $('#usersTable').DataTable();

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
                document.getElementById('createusermodal').close();
                $('#usersTable').DataTable().row.add([
                    user.lname,
                    user.fname,
                    user.email,
                    user.phone_number,
                    '<button class="btn btn-primary user-details" data-id="' + user.id + '">Details</button> ' +
                    '<button class="btn btn-secondary user-edit" data-id="' + user.id + '">Edit</button> ' +
                    '<button class="btn btn-danger user-delete" data-id="' + user.id + '">Deactivate</button>'
                ]).draw(false);
            },
            error: function(error) {
                console.log(error);

            }
        });
    });

    // DETAILS
    $(document).on('click', '.user-details', function() {
        var userId = $(this).data('id');
        console.log('Details Button : user ID:', userId);
        // Add your logic to handle the Details button click
    });

    // EDIT
    $(document).on('click', '.user-edit', function() {
        var userId = $(this).data('id');
        console.log('Edit button : user ID:', userId);
        // Add your logic to handle the Edit button click
    });

    // DELETE
    $(document).on('click', '.user-delete', function() {
        var userId = $(this).data('id');
        console.log('Delete button : user ID:', userId);
        // Add your logic to handle the Delete button click
    });

});
