import 'datatables.net-dt';

// CREATE
$(document).ready(function() {
    var userTable = $('#couriersTable').DataTable({
        ajax: {
            url: 'http://localhost:8000/api/couriers',
            dataSrc: ""
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'rate' },
            {
                data: 'id',
                render: function(data) {
                    return '<button class="btn btn-primary courier-edit" data-id="' + data + '">Details</button> ' +
                           '<button class="btn btn-secondary courier-delete" data-id="' + data + '">Delete</button>';
                }
            }
        ]
    });

    
    // CREATE
    $('#courierForm').validate({
        rules: {
            name: {
                required: true,
                maxlength: 255
            },
            rate: {
                required: true,
                number: true,
                min: 0
            }
        },
        messages: {
            name: {
                required: "Please enter the courier name",
                maxlength: "Name can not be longer than 255 characters"
            },
            rate: {
                required: "Please enter the rate",
                number: "Please enter a valid number",
                min: "Rate must be a positive number"
            }
        },
        submitHandler: function(form) {
            // Form is valid, proceed with AJAX submission
            var data = $('#courierForm')[0];
            let formData = new FormData(data);

            $.ajax({
                type: 'POST',
                url: '/api/courier',
                data: formData,
                processData: false,
                contentType: false, 
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                dataType: "json",
                success: function(data) {
                    console.log("Courier response contains: ", data);
                    document.getElementById('createcouriermodal').close();
                    userTable.row.add({
                        'id': data.id,
                        'name': data.name,
                        'rate': data.rate,
                        'actions': '<button class="btn btn-primary user-edit" data-id="' + data.id + '">Details</button> ' +
                                   '<button class="btn btn-secondary user-delete" data-id="' + data.id + '">Deactivate</button>'
                    }).draw(false);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    // DETAILS
    $(document).on('click', '.courier-edit', function(e) {
        e.preventDefault();

        var courierid = $(this).data('id');
        console.log(courierid);
        
        // OPENING DETAILS MODAL
        $.ajax({
            type: "GET",
            url: `http://localhost:8000/api/courier/${courierid}`,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",
            success: function (data) {
                console.log(data);

                $('#courierno').val(data.id)
                $('#nameedit').val(data.name)
                $('#rateedit').val(data.rate)
                $('#createdatedit').val(data.created_at)

                document.getElementById('editcouriermodal').showModal();
            },
            error: function (error) {
                console.log(error);
            }
        });       
    });

    // UPDATE 
    $(document).on('submit', '#couriereditForm', function (e) {
        e.preventDefault();
    
        var courierId = $('#courierno').val();
        var data = $('#couriereditForm')[0];
        let formData = new FormData(data);
        formData.append("_method", "PUT");
    
        $.ajax({
            type: 'POST',
            url: `http://localhost:8000/api/courier/${courierId}`,
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: "json",

            success: function(response) {
                console.log("Response:", response);
                document.getElementById('editcouriermodal').close();
                userTable.ajax.reload();
            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    });
    
    // DELETE
    $(document).on('click', '.courier-delete', function() {
        var courierId = $(this).data('id');
        console.log('Delete button : courier ID:', courierId);
        
        // Confirm deletion
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                type: 'DELETE',
                url: `http://localhost:8000/api/courier/${courierId}`,
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